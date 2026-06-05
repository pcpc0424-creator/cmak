#!/usr/bin/env php
<?php
/**
 * news_press 게시판 첨부파일 복구 스크립트
 * FTP 접속 실패로 못 가져온 첨부파일을 로컬 original_site 폴더에서 복사
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use App\Models\Attachment;

$baseUrl = 'http://www.cmak.or.kr';
$listUrl = '/html/notice/nleague1.asp?code=2&GotoPage=';
$detailUrl = '/html/notice/nleague1_r.asp?code=2&no=';
$localUploadRoot = '/var/www/cmak/original_site/upload';
$storageDir = storage_path('app/public/attachments/news_press');

if (!is_dir($storageDir)) mkdir($storageDir, 0755, true);

function fetchRaw(string $url): string
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36',
        CURLOPT_HTTPHEADER => ['Accept-Language: ko-KR,ko;q=0.9'],
    ]);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code !== 200 || !$html) return '';
    return $html;
}

function toUtf8(string $raw): string
{
    return @mb_convert_encoding($raw, 'UTF-8', 'EUC-KR') ?: $raw;
}

// 리스트 페이지에서 go_Edit ID + 제목 수집
function getPostList(string $listUrl, int $page, string $baseUrl): array
{
    $raw = fetchRaw($baseUrl . $listUrl . $page);
    if (!$raw) return [];
    $posts = [];
    preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $raw, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $posts[] = ['orig_id' => (int)$m[1], 'title' => trim(toUtf8($m[2]))];
    }
    return $posts;
}

// 로컬 파일 검색 (대소문자 무관)
function findLocalFile(string $uploadPath, string $root): ?string
{
    $parts = explode('/', $uploadPath);
    $current = $root;
    foreach ($parts as $part) {
        if (!is_dir($current)) break;
        $found = null;
        $entries = scandir($current);
        foreach ($entries as $e) {
            if (strcasecmp($e, $part) === 0) {
                $found = $current . '/' . $e;
                break;
            }
        }
        if (!$found) return null;
        $current = $found;
    }
    return (is_file($current)) ? $current : null;
}

$totalPages = 84;
$totalFixed = 0;
$totalMissing = 0;
$totalPosts = 0;

for ($page = 1; $page <= $totalPages; $page++) {
    $list = getPostList($listUrl, $page, $baseUrl);
    if (empty($list)) continue;

    echo "P{$page}: ".count($list)."건\n";

    foreach ($list as $item) {
        $title = html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8');
        $post = Post::where('board_type', 'news_press')->where('title', $title)->first();
        if (!$post) continue;
        $totalPosts++;

        // 이미 첨부파일 있으면 스킵
        if ($post->attachments()->count() > 0) continue;

        // 상세 페이지 fetch
        $raw = fetchRaw($baseUrl . $detailUrl . $item['orig_id']);
        if (!$raw) continue;

        // 첨부 경로 추출
        $attachments = [];
        if (preg_match_all('/\/upload\/([^\'">\s]+\.\w{2,5})/i', $raw, $files)) {
            $seen = [];
            foreach ($files[1] as $filePath) {
                $fileName = urldecode(basename($filePath));
                if (in_array(strtolower($fileName), ['thumbs.db', 'web.config', 'space.gif'])) continue;
                if (preg_match('/^(img|icon|board)\//i', $filePath)) continue;
                $key = strtolower($filePath);
                if (isset($seen[$key])) continue;
                $seen[$key] = true;
                $attachments[] = ['upload_path' => $filePath, 'file_name' => toUtf8($fileName)];
            }
        }

        foreach ($attachments as $att) {
            $localSrc = findLocalFile($att['upload_path'], $localUploadRoot);
            if (!$localSrc) {
                $totalMissing++;
                continue;
            }

            $safeName = preg_replace('/[\/\\\\]/', '_', $att['file_name']);
            $dst = $storageDir . '/' . $safeName;

            if (!file_exists($dst)) {
                if (!copy($localSrc, $dst)) { $totalMissing++; continue; }
            }

            $post->attachments()->create([
                'file_name' => $att['file_name'],
                'file_path' => 'storage/attachments/news_press/' . $safeName,
                'file_size' => filesize($dst),
                'mime_type' => mime_content_type($dst) ?: 'application/octet-stream',
            ]);
            $totalFixed++;
        }

        usleep(150000);
    }
    usleep(300000);
}

echo "\n========================================\n";
echo "처리 게시글: {$totalPosts} / 첨부복구: {$totalFixed} / 누락: {$totalMissing}\n";
echo "========================================\n";
