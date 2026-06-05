#!/usr/bin/env php
<?php
/**
 * research(논문 및 연구보고서) 게시판 첨부파일 누락 복구
 * - 과거 크롤러가 공백 포함 파일명 / "\DA" 경로를 파싱하지 못해 누락된 첨부 13건 복구
 * - 원본 HTTP에서 다운로드 (URL은 EUC-KR percent-encoding)
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

// DB post id => 원본 첨부 경로 (UTF-8, "\DA"는 IIS에서 "DA"와 동일)
$targets = [
    44449 => 'upload/DA/김대현.doc',
    44450 => 'upload/DA/이재섭.hwp',
    44451 => 'upload/DA/김창학.hwp',
    44452 => 'upload/DA/정병진.doc',
    44453 => 'upload/DA/김병수.hwp',
    44454 => 'upload/DA/임학춘.HWP',
    44455 => 'upload/DA/송병관.hwp',
    44456 => 'upload/DA/엄신조.hwp',
    44457 => 'upload/DA/윤석헌.hwp',
    44442 => 'upload/DA/The Ninth Annual Owners Survey (2008).pdf',
    44434 => 'upload/DA/2009-12-08-01.jpg', // 이미 존재 — 스킵됨
    44418 => 'upload/DA/Business Value of BIM for Construction in Global Markets SMR (2014).pdf',
    44413 => 'upload/DA/250820_ENR 순위로 본 미국 건설산업 동향과 국내 CM 발전방향.pdf',
];

function fetchFile(string $path, string $out): bool
{
    $euc = mb_convert_encoding($path, 'EUC-KR', 'UTF-8');
    $enc = implode('/', array_map('rawurlencode', explode('/', $euc)));
    $url = 'http://www.cmak.or.kr/' . $enc;
    $ch = curl_init();
    $fp = fopen($out, 'w');
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_FILE => $fp,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 180,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        CURLOPT_HTTPHEADER => [
            'Accept: */*',
            'Accept-Language: ko-KR,ko;q=0.9',
            'Referer: http://www.cmak.or.kr/html/cmdata/cmreport.asp',
        ],
    ]);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $type = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
    curl_close($ch);
    fclose($fp);
    // WAF가 HTML 차단 페이지를 줄 수 있으므로 content-type 검사
    if ($code !== 200 || !file_exists($out) || filesize($out) === 0 || stripos($type ?? '', 'text/html') !== false) {
        @unlink($out);
        echo "    다운로드 실패: $path (HTTP $code, $type)\n";
        return false;
    }
    return true;
}

$localDir = storage_path('app/public/attachments/research');
if (!is_dir($localDir)) mkdir($localDir, 0755, true);

foreach ($targets as $postId => $remotePath) {
    $post = Post::find($postId);
    if (!$post) { echo "post $postId 없음, 스킵\n"; continue; }

    $fileName = basename($remotePath);
    $exists = $post->attachments()->where('file_name', $fileName)->exists();
    if ($exists) {
        echo "[$postId] {$post->title} → 이미 첨부 있음 ({$fileName}), 스킵\n";
        continue;
    }

    $safeName = preg_replace('/[\/\\\\]/', '_', $fileName);
    $localPath = $localDir . '/' . $safeName;

    if (!file_exists($localPath) || filesize($localPath) === 0) {
        if (!fetchFile($remotePath, $localPath)) continue;
    }

    $post->attachments()->create([
        'file_name' => $fileName,
        'file_path' => 'storage/attachments/research/' . $safeName,
        'file_size' => filesize($localPath),
        'mime_type' => mime_content_type($localPath) ?: 'application/octet-stream',
    ]);
    echo "[$postId] {$post->title} → 첨부 등록: {$fileName} (" . number_format(filesize($localPath) / 1024, 1) . " KB)\n";
    usleep(1000000);
}

echo "\n완료\n";
