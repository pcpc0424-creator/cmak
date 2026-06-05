#!/usr/bin/env php
<?php
/**
 * 게시판 첨부파일 누락 복구 (범용)
 * - 원본 사이트 상세 페이지의 첨부를 파싱해 DB에 없는 첨부를 추가
 * - 파일명 공백 버그로 과거 크롤 때 누락된 첨부 복구용
 * 사용법: php scripts/fix_board_attachments.php <board_key> [--dry-run]
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

// sync_boards.php와 동일한 보드 → URL 매핑
$boards = [
    'news_domestic' => ['list_url' => '/html/notice/news.asp?code=0&GotoPage=', 'detail_url' => '/html/notice/news_r.asp?code=0&no='],
    'news_association' => ['list_url' => '/html/notice/nleague1.asp?code=1&GotoPage=', 'detail_url' => '/html/notice/nleague1_r.asp?code=1&no='],
    'news_law' => ['list_url' => '/html/notice/nlow.asp?GotoPage=', 'detail_url' => '/html/notice/nlow_r.asp?no='],
    'news_org' => ['list_url' => '/html/notice/norg.asp?GotoPage=', 'detail_url' => '/html/notice/norg_r.asp?no='],
    'news_bid' => ['list_url' => '/html/notice/ntrnder.asp?GotoPage=', 'detail_url' => '/html/notice/ntrnder_r.asp?no='],
    'member_trend' => ['list_url' => '/html/notice/nwind.asp?GotoPage=', 'detail_url' => '/html/notice/nwind_r.asp?no='],
    'news_press' => ['list_url' => '/html/notice/nleague1.asp?code=2&GotoPage=', 'detail_url' => '/html/notice/nleague1_r.asp?code=2&no='],
    'expert_column' => ['list_url' => '/html/cmdata/cmexpert.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmexpert_r.asp?no='],
    'special_feature' => ['list_url' => '/html/cmdata/cmspeical.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmspeical_r.asp?no='],
    'education_seminar' => ['list_url' => '/html/cmdata/cmsemina.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmsemina_r.asp?no='],
    'research' => ['list_url' => '/html/cmdata/cmreport.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmreport_r.asp?no='],
    'etc_data' => ['list_url' => '/html/cmdata/cmetc.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmetc_r.asp?no='],
    'cm_case' => ['list_url' => '/html/cmdata/cmexample.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmexample_r.asp?no='],
    'cm_overseas' => ['list_url' => '/html/cmdata/cmglobal.asp?GotoPage=', 'detail_url' => '/html/cmdata/cmglobal_r.asp?no='],
    'free_board' => ['list_url' => '/html/free/freeboard.asp?GotoPage=', 'detail_url' => '/html/free/freeboard_r.asp?no='],
    'book_review' => ['list_url' => '/html/free/bookreview.asp?GotoPage=', 'detail_url' => '/html/free/bookreview_r.asp?no='],
    'wordbook' => ['list_url' => '/html/free/wordbook.asp?GotoPage=', 'detail_url' => '/html/free/wordbook_r.asp?no='],
    'faq' => ['list_url' => '/html/free/faq.asp?GotoPage=', 'detail_url' => '/html/free/faq_r.asp?no='],
    'job_offer' => ['list_url' => '/html/free/wanted.asp?GotoPage=', 'detail_url' => '/html/free/wanted_r.asp?no='],
    'job_seek' => ['list_url' => '/html/free/wanted2.asp?GotoPage=', 'detail_url' => '/html/free/wanted2_r.asp?no='],
];

$baseUrl = 'http://www.cmak.or.kr';
$ftpUser = 'cmak1997';
$ftpPass = 'cmak1997@cm1997';
$ftpHost = 'cmak.or.kr';

$boardKey = $argv[1] ?? null;
$dryRun = in_array('--dry-run', $argv);

if (!$boardKey || !isset($boards[$boardKey])) {
    echo "사용법: php scripts/fix_board_attachments.php <board_key> [--dry-run]\n";
    echo "보드: " . implode(', ', array_keys($boards)) . "\n";
    exit(1);
}
$config = $boards[$boardKey];

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

function downloadFtpFile(string $remotePath, string $localPath): bool
{
    global $ftpUser, $ftpPass, $ftpHost;
    $dir = dirname($localPath);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $encoded = implode('/', array_map('rawurlencode', explode('/', $remotePath)));
    $encodedPass = rawurlencode($ftpPass);
    $url = "ftp://{$ftpUser}:{$encodedPass}@{$ftpHost}/{$encoded}";
    $ch = curl_init();
    $fp = fopen($localPath, 'w');
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_FILE => $fp,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_FTPPORT => '-',
    ]);
    $result = curl_exec($ch);
    curl_close($ch);
    fclose($fp);
    if (!$result || !file_exists($localPath) || filesize($localPath) === 0) {
        @unlink($localPath);
        return false;
    }
    return true;
}

function downloadHttpFile(string $remotePath, string $localPath): bool
{
    global $baseUrl;
    $dir = dirname($localPath);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $encoded = implode('/', array_map('rawurlencode', explode('/', $remotePath)));
    $ch = curl_init();
    $fp = fopen($localPath, 'w');
    curl_setopt_array($ch, [
        CURLOPT_URL => $baseUrl . '/' . $encoded,
        CURLOPT_FILE => $fp,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 300,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        CURLOPT_HTTPHEADER => ['Referer: http://www.cmak.or.kr/'],
    ]);
    $result = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    fclose($fp);
    if (!$result || $code !== 200 || !file_exists($localPath) || filesize($localPath) === 0) {
        @unlink($localPath);
        return false;
    }
    return true;
}

function parseAttachments(string $raw): array
{
    $attachments = [];
    // 파일명에 공백이 포함될 수 있으므로 따옴표/괄호 전까지 매칭 (예: "Bangladesh CM_2020.pdf")
    if (preg_match_all('/\/upload\/([^\'"<>(),]+?\.\w{2,5})/i', $raw, $files)) {
        $seen = [];
        foreach ($files[1] as $filePath) {
            $fileName = urldecode(basename($filePath));
            if (in_array(strtolower($fileName), ['thumbs.db', 'web.config', 'space.gif'])) continue;
            if (preg_match('/^(img|icon|board)\//i', $filePath)) continue;
            $key = strtolower($filePath);
            if (isset($seen[$key])) continue;
            $seen[$key] = true;
            $attachments[] = [
                'remote_path' => 'upload/' . $filePath,
                'file_name' => toUtf8($fileName),
            ];
        }
    }
    return $attachments;
}

// 1) 원본 목록 전체에서 (제목 → 원본ID 큐) 수집
echo "[1] 원본 목록 수집...\n";
$siteQueue = []; // title => [origId, ...] 목록 순서(최신순)
$emptyPages = 0;
for ($page = 1; $page <= 500; $page++) {
    $raw = fetchRaw($baseUrl . $config['list_url'] . $page);
    if (!$raw) { if (++$emptyPages >= 3) break; continue; }
    $u = toUtf8($raw);
    preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $u, $matches, PREG_SET_ORDER);
    if (empty($matches)) { if (++$emptyPages >= 3) break; continue; }
    $emptyPages = 0;
    $seenIds = [];
    foreach ($matches as $m) {
        if (isset($seenIds[$m[1]])) continue; // 한 행 다중 링크 dedup
        $seenIds[$m[1]] = true;
        $title = html_entity_decode(trim($m[2]), ENT_QUOTES, 'UTF-8'); // $u가 이미 UTF-8
        $siteQueue[$title][] = $m[1];
    }
    usleep(1000000);
}
$total = array_sum(array_map('count', $siteQueue));
echo "  수집: {$total}건\n";

// 2) DB 글 순회 (목록과 같은 최신순) — 원본 첨부와 대조해 누락분 추가
echo "[2] 첨부 대조...\n";
$posts = Post::where('board_type', $boardKey)
    ->orderBy('published_at', 'desc')->orderBy('id')->get();
$added = 0; $failed = 0; $unmatched = 0;
foreach ($posts as $post) {
    if (empty($siteQueue[$post->title])) {
        echo "  ! 원본 매칭 실패: #{$post->id} {$post->title}\n";
        $unmatched++;
        continue;
    }
    $origId = array_shift($siteQueue[$post->title]);
    $detailRaw = fetchRaw($baseUrl . $config['detail_url'] . $origId);
    if (!$detailRaw) {
        echo "  ! 상세 접근 실패: #{$post->id} (원본 #{$origId})\n";
        $failed++;
        continue;
    }
    $siteAtts = parseAttachments($detailRaw);
    $dbNames = $post->attachments->pluck('file_name')->map(fn($n) => mb_strtolower($n))->all();
    foreach ($siteAtts as $att) {
        if (in_array(mb_strtolower($att['file_name']), $dbNames)) continue;
        echo "  [누락] #{$post->id} {$post->title} ← {$att['file_name']}\n";
        if ($dryRun) { $added++; continue; }
        $localDir = storage_path('app/public/attachments/' . $boardKey);
        $safeName = preg_replace('/[\/\\\\]/', '_', $att['file_name']);
        $localPath = $localDir . '/' . $safeName;
        if (file_exists($localPath) || downloadFtpFile($att['remote_path'], $localPath) || downloadHttpFile($att['remote_path'], $localPath)) {
            $post->attachments()->create([
                'file_name' => $att['file_name'],
                'file_path' => 'storage/attachments/' . $boardKey . '/' . $safeName,
                'file_size' => filesize($localPath),
                'mime_type' => mime_content_type($localPath) ?: 'application/octet-stream',
            ]);
            echo "    ✓ 다운로드 완료 (" . number_format(filesize($localPath)) . " bytes)\n";
            $added++;
        } else {
            echo "    ✗ 다운로드 실패: {$att['remote_path']}\n";
            $failed++;
        }
    }
    usleep(1000000);
}
echo "\n완료: 추가 {$added}건 / 실패 {$failed}건 / 매칭 실패 {$unmatched}건\n";
