#!/usr/bin/env php
<?php
/**
 * 전문가칼럼(expert_column) 글쓴이 누락 복구
 * 원본 목록 페이지의 글쓴이 컬럼을 수집해 DB posts.author 업데이트
 * 사용법: php scripts/fix_expert_authors.php [--dry-run]
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$listUrl = '/html/cmdata/cmexpert.asp?GotoPage=';
$dryRun = in_array('--dry-run', $argv);

function fetchRaw(string $url, int $retries = 3): string
{
    for ($attempt = 1; $attempt <= $retries; $attempt++) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
            CURLOPT_HTTPHEADER => [
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: ko-KR,ko;q=0.9,en-US;q=0.8,en;q=0.7',
                'Referer: http://www.cmak.or.kr/',
            ],
        ]);
        $html = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if ($code === 200 && $html && strpos($html, 'WAF') === false) {
            return $html;
        }
        if ($attempt < $retries) sleep(2 * $attempt);
    }
    return '';
}

function toUtf8(string $raw): string
{
    return @mb_convert_encoding($raw, 'UTF-8', 'EUC-KR') ?: $raw;
}

// 1) 원본 목록 전체 페이지에서 (제목, 글쓴이) 수집 — 목록 순서(최신순) 유지
echo "[1] 원본 목록 수집...\n";
$siteList = []; // [{title, author}]
$emptyPages = 0;
for ($page = 1; $page <= 20; $page++) {
    $raw = fetchRaw($GLOBALS['baseUrl'] . $GLOBALS['listUrl'] . $page);
    if (!$raw) { if (++$emptyPages >= 3) break; continue; }
    $u = toUtf8($raw);
    // 행: go_Edit('no')">제목</a> ... <td height="45" width="200">&nbsp;글쓴이</td>
    preg_match_all('/go_Edit\(\'(\d+)\'\)">([^<]+)<\/a>.*?width="200">(?:&nbsp;|\s)*([^<]*)<\/td>/si', $u, $rows, PREG_SET_ORDER);
    if (empty($rows)) { if (++$emptyPages >= 3) break; continue; }
    $emptyPages = 0;
    foreach ($rows as $r) {
        $title = html_entity_decode(trim($r[2]), ENT_QUOTES, 'UTF-8');
        $author = html_entity_decode(trim(preg_replace('/\s+/', ' ', $r[3])), ENT_QUOTES, 'UTF-8');
        $siteList[] = ['title' => $title, 'author' => $author];
    }
    usleep(1000000);
}
echo "  수집: " . count($siteList) . "건\n";

// 2) 제목별 글쓴이 큐 구성 (중복 제목은 목록 순서대로)
$authorQueue = []; // title => [author, ...]
foreach ($siteList as $s) {
    $authorQueue[$s['title']][] = $s['author'];
}

// 3) DB 글에 글쓴이 채우기 — 목록과 같은 최신순으로 순회
echo "[2] DB 업데이트...\n";
$posts = Post::where('board_type', 'expert_column')
    ->orderBy('published_at', 'desc')->orderBy('id')->get();
$updated = 0; $unmatched = 0;
foreach ($posts as $post) {
    if (!empty($authorQueue[$post->title])) {
        $author = array_shift($authorQueue[$post->title]);
    } else {
        echo "  ! 매칭 실패: #{$post->id} {$post->title}\n";
        $unmatched++;
        continue;
    }
    if ($post->author === $author) continue;
    if ($dryRun) {
        echo "  [DRY] #{$post->id} [{$author}] {$post->title}\n";
    } else {
        $post->update(['author' => $author]);
    }
    $updated++;
}
echo "완료: 업데이트 {$updated}건 / 매칭 실패 {$unmatched}건\n";
