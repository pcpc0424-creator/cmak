<?php
/**
 * cmak.or.kr 이미지 다운로드 + 본문 경로 치환 스크립트
 */
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$basePath = '/cmak';
$publicDir = __DIR__ . '/../public';
$downloadDir = $publicDir . '/uploads/cmak_images';

if (!is_dir($downloadDir)) {
    mkdir($downloadDir, 0755, true);
}

// 1. 모든 cmak.or.kr URL 추출
echo "=== cmak.or.kr URL 추출 중... ===\n";
$posts = DB::table('posts')->where('content', 'like', '%cmak.or.kr%')->get(['id', 'content']);

$urlMap = []; // url => local_path
$postUrls = []; // post_id => [urls]

foreach ($posts as $post) {
    preg_match_all('/https?:\/\/(?:www\.)?cmak\.or\.kr\/([^\"\'\s<>]+)/', $post->content, $matches);
    if (!empty($matches[0])) {
        $postUrls[$post->id] = array_unique($matches[0]);
        foreach ($matches[0] as $i => $fullUrl) {
            $urlMap[$fullUrl] = $matches[1][$i]; // relative path
        }
    }
}

$uniqueUrls = array_unique(array_keys($urlMap));
echo "고유 URL: " . count($uniqueUrls) . "개\n";
echo "관련 게시글: " . count($postUrls) . "개\n\n";

// 2. 이미지 다운로드
echo "=== 다운로드 시작 ===\n";
$downloaded = 0;
$failed = 0;
$skipped = 0;

foreach ($uniqueUrls as $url) {
    $relativePath = $urlMap[$url];
    $localPath = $downloadDir . '/' . $relativePath;
    $localDir = dirname($localPath);

    // 이미 다운로드된 파일 건너뛰기
    if (file_exists($localPath)) {
        $skipped++;
        continue;
    }

    if (!is_dir($localDir)) {
        mkdir($localDir, 0755, true);
    }

    // 다운로드 시도
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_CONNECTTIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (compatible; CMAK Migration/1.0)',
    ]);

    $data = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && $data !== false && strlen($data) > 0) {
        file_put_contents($localPath, $data);
        $downloaded++;
        if ($downloaded % 100 === 0) {
            echo "  다운로드: {$downloaded}개 완료...\n";
        }
    } else {
        $failed++;
    }
}

echo "\n다운로드 완료: {$downloaded}개\n";
echo "건너뜀(이미존재): {$skipped}개\n";
echo "실패: {$failed}개\n\n";

// 3. 본문 경로 치환
echo "=== 본문 경로 치환 시작 ===\n";
$updated = 0;

foreach ($postUrls as $postId => $urls) {
    $content = DB::table('posts')->where('id', $postId)->value('content');
    $newContent = $content;

    foreach ($urls as $url) {
        $relativePath = $urlMap[$url];
        $localFile = $downloadDir . '/' . $relativePath;

        if (file_exists($localFile)) {
            // 로컬 경로로 치환
            $localUrl = $basePath . '/uploads/cmak_images/' . $relativePath;
            $newContent = str_replace($url, $localUrl, $newContent);
        }
        // 파일이 없으면 원본 URL 유지
    }

    if ($newContent !== $content) {
        DB::table('posts')->where('id', $postId)->update(['content' => $newContent]);
        $updated++;
    }
}

echo "치환 완료: {$updated}개 게시글\n";

// 4. 남은 cmak.or.kr 참조 확인
$remaining = DB::table('posts')->where('content', 'like', '%cmak.or.kr%')->count();
echo "\n남은 cmak.or.kr 참조 게시글: {$remaining}개\n";
echo "\n=== 완료 ===\n";
