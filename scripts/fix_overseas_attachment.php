#!/usr/bin/env php
<?php
/**
 * cm_overseas 게시판에서 첨부가 누락된 글의 첨부파일을 원본 사이트에서 가져와 복구
 * 사용법: php scripts/fix_overseas_attachment.php
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$ftpUser = 'cmak1997';
$ftpPass = 'cmak1997@cm1997';
$ftpHost = 'cmak.or.kr';

$boardKey = 'cm_overseas';
$listUrl = '/html/cmdata/cmglobal.asp?GotoPage=';
$detailUrl = '/html/cmdata/cmglobal_r.asp?no=';

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

function downloadFtpFile(string $remotePath, string $localPath): bool
{
    global $ftpUser, $ftpPass, $ftpHost;
    $dir = dirname($localPath);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $parts = explode('/', $remotePath);
    $encoded = implode('/', array_map('rawurlencode', $parts));
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

// HTTP 다운로드 (FTP 실패 시 폴백)
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

// 1) 원본 목록에서 제목 → 원본 글번호 매핑
echo "[1] 원본 목록 수집...\n";
$raw = fetchRaw($baseUrl . $listUrl . '1');
if (!$raw) { echo "원본 목록 접근 실패\n"; exit(1); }
preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $raw, $matches, PREG_SET_ORDER);
$siteMap = []; // title => origId
foreach ($matches as $m) {
    $title = html_entity_decode(trim(toUtf8($m[2])), ENT_QUOTES, 'UTF-8');
    $siteMap[$title] = $m[1];
}
// 2페이지도 (총 14건 = 2페이지)
$raw2 = fetchRaw($baseUrl . $listUrl . '2');
if ($raw2) {
    preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $raw2, $m2, PREG_SET_ORDER);
    foreach ($m2 as $m) {
        $title = html_entity_decode(trim(toUtf8($m[2])), ENT_QUOTES, 'UTF-8');
        $siteMap[$title] = $m[1];
    }
}
echo "  수집: " . count($siteMap) . "건\n";

// 2) 첨부 0건인 DB 글 찾아서 복구
$posts = Post::where('board_type', $boardKey)->get();
foreach ($posts as $post) {
    if ($post->attachments()->count() > 0) continue;
    echo "\n[복구 대상] #{$post->id} {$post->title}\n";

    if (!isset($siteMap[$post->title])) {
        echo "  → 원본 목록에서 제목 매칭 실패, 스킵\n";
        continue;
    }
    $origId = $siteMap[$post->title];
    $detailRaw = fetchRaw($baseUrl . $detailUrl . $origId);
    if (!$detailRaw) {
        echo "  → 원본 상세 접근 실패\n";
        continue;
    }
    $attachments = parseAttachments($detailRaw);
    echo "  원본 첨부: " . count($attachments) . "건\n";

    foreach ($attachments as $att) {
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
            echo "  ✓ {$att['file_name']} (" . number_format(filesize($localPath)) . " bytes)\n";
        } else {
            echo "  ✗ FTP 다운로드 실패: {$att['remote_path']}\n";
        }
    }
    sleep(1);
}

echo "\n완료\n";
