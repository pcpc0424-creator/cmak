<?php
// Book Review 게시판 - 원본 사이트에서 저자/출판사 메타데이터 동기화
// 사용법: php scripts/sync_book_meta.php [--dry-run]

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$dryRun = in_array('--dry-run', $argv);

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

function normTitle(string $t): string
{
    $t = html_entity_decode($t, ENT_QUOTES, 'UTF-8');
    return preg_replace('/\s+/u', '', trim($t));
}

// 1. 목록 페이지에서 no => 제목 수집
$listItems = []; // no => title
for ($page = 1; $page <= 30; $page++) {
    $html = toUtf8(fetchRaw($baseUrl . '/html/free/bookreview.asp?GotoPage=' . $page));
    if (!$html) break;
    preg_match_all('/go_Edit\(\'(\d+)\'\)">([^<]+)</u', $html, $m, PREG_SET_ORDER);
    $found = 0;
    foreach ($m as $row) {
        $no = (int)$row[1];
        if (!isset($listItems[$no])) {
            $listItems[$no] = trim($row[2]);
            $found++;
        }
    }
    if ($found === 0) break;
    usleep(300000);
}
echo "원본 목록 수집: " . count($listItems) . "건\n";

// 2. 상세 페이지에서 책제목/저자/출판사 파싱
function parseDetail(string $baseUrl, int $no): ?array
{
    $html = toUtf8(fetchRaw($baseUrl . '/html/free/bookreview_r.asp?no=' . $no));
    if (!$html) return null;

    // 책 이미지 (/upload/book/...)
    $image = null;
    if (preg_match('/<img[^>]+src=["\']?(\/upload\/book\/[^"\'\s>]+)/i', $html, $m)) {
        $image = $m[1];
    }

    // 태그 제거 후 라벨 다음 줄 추출
    $text = preg_replace('/<[^>]+>/', "\n", $html);
    $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
    $lines = array_values(array_filter(array_map('trim', explode("\n", $text)), fn($l) => $l !== ''));

    $fields = ['책제목' => null, '저자' => null, '출판사' => null];
    foreach ($lines as $i => $line) {
        $label = preg_replace('/[\s\x{00A0}]+/u', '', $line);
        if (array_key_exists($label, $fields) && $fields[$label] === null && isset($lines[$i + 1])) {
            $fields[$label] = trim($lines[$i + 1]);
        }
    }

    return [
        'book_title' => $fields['책제목'],
        'book_author' => $fields['저자'],
        'publisher' => $fields['출판사'],
        'image' => $image,
    ];
}

// 3. DB 게시글과 제목 매칭 후 메타데이터 갱신
$posts = Post::where('board_type', 'book_review')->orderByDesc('id')->get();
echo "DB 게시글: " . $posts->count() . "건\n\n";

// 제목 → no 매핑 (중복 제목은 no 내림차순 큐로 보관)
$titleMap = [];
krsort($listItems);
foreach ($listItems as $no => $title) {
    $titleMap[normTitle($title)][] = $no;
}

// 책이미지 다운로드 후 첨부 생성 (이미지 첨부가 없는 글만)
function attachBookImage(Post $post, string $imagePath, string $baseUrl, bool $dryRun): void
{
    $hasImage = $post->attachments->contains(fn($a) => str_starts_with($a->mime_type ?? '', 'image/'));
    if ($hasImage) return;

    $fileName = basename($imagePath);
    $localDir = storage_path('app/public/attachments/book_review');
    $localPath = $localDir . '/' . $fileName;
    echo ($dryRun ? '  [DRY] ' : '  ') . "책이미지 다운로드: {$imagePath} → attachments/book_review/{$fileName}\n";
    if ($dryRun) return;

    if (!file_exists($localPath)) {
        $data = fetchRaw($baseUrl . $imagePath);
        if (!$data) {
            echo "  [실패] 이미지 다운로드 실패: {$imagePath}\n";
            return;
        }
        file_put_contents($localPath, $data);
        @chown($localPath, 'www-data');
        @chgrp($localPath, 'www-data');
        @chmod($localPath, 0644);
    }

    $mime = mime_content_type($localPath) ?: 'image/jpeg';
    $post->attachments()->create([
        'file_name' => $fileName,
        'file_path' => 'storage/attachments/book_review/' . $fileName,
        'file_size' => filesize($localPath),
        'mime_type' => $mime,
    ]);
}

$updated = $skipped = $unmatched = 0;
foreach ($posts as $post) {
    $key = normTitle($post->title);
    if (empty($titleMap[$key])) {
        echo "[매칭실패] {$post->id} {$post->title}\n";
        $unmatched++;
        continue;
    }
    $no = array_shift($titleMap[$key]);

    $meta = $post->metadata ?? [];
    $hasImage = $post->attachments->contains(fn($a) => str_starts_with($a->mime_type ?? '', 'image/'));
    if (!empty($meta['book_author']) && !empty($meta['publisher']) && $hasImage) {
        $skipped++;
        continue;
    }

    $detail = parseDetail($baseUrl, $no);
    usleep(300000);
    if (!$detail || (!$detail['book_author'] && !$detail['publisher'])) {
        echo "[파싱실패] {$post->id} (no={$no}) {$post->title}\n";
        continue;
    }

    $new = $meta;
    $new['book_title'] = $meta['book_title'] ?? $detail['book_title'] ?? $post->title;
    if ($detail['book_author']) $new['book_author'] = $detail['book_author'];
    if ($detail['publisher']) $new['publisher'] = $detail['publisher'];

    echo ($dryRun ? '[DRY] ' : '[갱신] ') . "{$post->id} (no={$no}) {$post->title} | 저자: " . ($detail['book_author'] ?? '-') . " | 출판사: " . ($detail['publisher'] ?? '-') . "\n";
    if (!$dryRun) {
        $post->update(['metadata' => $new]);
    }
    if ($detail['image']) {
        attachBookImage($post, $detail['image'], $baseUrl, $dryRun);
    }
    $updated++;
}

echo "\n완료: 갱신 {$updated}건, 기존보유 {$skipped}건, 매칭실패 {$unmatched}건\n";

// 4. 원본에만 있는 글 (DB 누락) 리포트
$dbTitles = $posts->map(fn($p) => normTitle($p->title))->flip();
$missing = [];
foreach ($listItems as $no => $title) {
    if (!isset($dbTitles[normTitle($title)])) $missing[$no] = $title;
}
if ($missing) {
    echo "\n[원본에만 있는 글 - DB 누락 " . count($missing) . "건]\n";
    foreach ($missing as $no => $title) echo "  no={$no} {$title}\n";
}
