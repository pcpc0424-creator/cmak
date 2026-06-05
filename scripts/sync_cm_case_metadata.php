<?php
/**
 * CM수행사례(cm_case) 발주자/건설사업관리자 메타데이터 동기화
 * 원본: http://www.cmak.or.kr/html/cmdata/cmexample.asp (목록에 발주자/건설사업관리자 컬럼 존재)
 * 사용법: php scripts/sync_cm_case_metadata.php [--dry-run]
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
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
                'Cache-Control: no-cache',
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

// 제목 정규화 (공백/특수문자 차이 흡수)
function normalizeTitle(string $t): string
{
    $t = html_entity_decode($t, ENT_QUOTES, 'UTF-8');
    $t = strip_tags($t);
    $t = str_replace(['’', '‘', '“', '”', '&nbsp;'], ["'", "'", '"', '"', ' '], $t);
    $t = preg_replace('/\s+/u', '', $t);
    return mb_strtolower(trim($t));
}

// 1. 원본 목록 전체 페이지 크롤링
$rows = [];
for ($page = 1; $page <= 30; $page++) {
    $raw = fetchRaw($baseUrl . '/html/cmdata/cmexample.asp?GotoPage=' . $page);
    if (!$raw) {
        echo "[오류] {$page}페이지 요청 실패\n";
        break;
    }
    $html = toUtf8($raw);

    // 행 구조: go_Edit('no') 제목 → 발주자 td(width=120) → 건설사업관리자 td(width=150)
    preg_match_all(
        '/go_Edit\(\'(\d+)\'\)">(.*?)<\/a>.*?<td height="45" width="120">(.*?)<\/td>.*?<td height="45" width="150">(.*?)<\/td>/s',
        $html,
        $m,
        PREG_SET_ORDER
    );

    if (empty($m)) break; // 마지막 페이지 이후

    $newCount = 0;
    foreach ($m as $row) {
        $no = $row[1];
        if (isset($rows[$no])) continue;
        $rows[$no] = [
            'title' => trim(html_entity_decode($row[2], ENT_QUOTES, 'UTF-8')),
            'orderer' => trim(strip_tags(html_entity_decode($row[3], ENT_QUOTES, 'UTF-8'))),
            'cm_manager' => trim(strip_tags(html_entity_decode($row[4], ENT_QUOTES, 'UTF-8'))),
        ];
        $newCount++;
    }
    echo "{$page}페이지: " . count($m) . "건 파싱 (신규 {$newCount})\n";
    if ($newCount === 0) break;
    usleep(500000);
}

echo "원본 총 " . count($rows) . "건 수집\n\n";

// 2. 로컬 게시글과 제목 매칭 후 metadata 갱신
$siteByTitle = [];
foreach ($rows as $r) {
    $siteByTitle[normalizeTitle($r['title'])] = $r;
}

$posts = Post::withoutGlobalScopes()->where('board_type', 'cm_case')->get();
$updated = $skipped = $unmatched = 0;

foreach ($posts as $post) {
    $key = normalizeTitle($post->title);
    if (!isset($siteByTitle[$key])) {
        echo "[미매칭] #{$post->id} {$post->title}\n";
        $unmatched++;
        continue;
    }
    $r = $siteByTitle[$key];
    $meta = $post->metadata ?? [];
    $newMeta = array_merge($meta, [
        'orderer' => $r['orderer'],
        'cm_manager' => $r['cm_manager'],
    ]);
    if ($meta == $newMeta) {
        $skipped++;
        continue;
    }
    echo "[갱신] #{$post->id} {$post->title}\n";
    echo "       발주자: '{$r['orderer']}' / 건설사업관리자: '{$r['cm_manager']}'\n";
    if (!$dryRun) {
        $post->metadata = $newMeta;
        $post->saveQuietly();
    }
    $updated++;
}

echo "\n완료: 갱신 {$updated}건, 변경없음 {$skipped}건, 미매칭 {$unmatched}건" . ($dryRun ? ' (dry-run)' : '') . "\n";
