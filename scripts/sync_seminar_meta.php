<?php
/**
 * 교육 및 세미나사례(education_seminar) 강사/소속 동기화 스크립트
 *
 * 원본 목록 페이지(cmsemina.asp)에는 강사(width=100)/소속(width=150) 컬럼이 있으나
 * 과거 크롤 시 수집하지 않아 DB의 author/metadata.affiliation이 비어 있음.
 *
 * 1단계: 원본 목록 전체 크롤 → (원본ID, 제목, 강사, 소속) 수집 → JSON 저장
 * 2단계: DB 게시글과 제목 순서 기반 매칭 → author/metadata.affiliation 갱신
 * 3단계: 원본에만 있는 누락 게시글 신규 추가 (본문 + 첨부 다운로드)
 *
 * 사용법:
 *   php scripts/sync_seminar_meta.php crawl    # 1단계 (목록 크롤, ~1분)
 *   php scripts/sync_seminar_meta.php apply    # 2~3단계 (DB 반영)
 *   php scripts/sync_seminar_meta.php apply --dry-run
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$listUrl = '/html/cmdata/cmsemina.asp?GotoPage=';
$detailUrl = '/html/cmdata/cmsemina_r.asp?no=';
$jsonPath = __DIR__ . '/seminar_list.json';
$ftpUser = 'cmak1997';
$ftpPass = 'cmak1997@cm1997';
$ftpHost = 'cmak.or.kr';

$mode = $argv[1] ?? '';
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

function cleanText(string $raw): string
{
    $t = html_entity_decode(toUtf8($raw), ENT_QUOTES, 'UTF-8');
    $t = str_replace("\xc2\xa0", ' ', $t); // &nbsp;
    return trim($t);
}

// 목록 1페이지 파싱: 행 구조 = 제목(go_Edit) → 강사 td(width=100) → 소속 td(width=150) → 첨부 td(width=58)
function parseListPage(string $raw): array
{
    $rows = [];
    $pattern = '/go_Edit\(\'(\d+)\'\)">([^<]*)<\/a>(.*?)<td[^>]*width="100"[^>]*>(.*?)<\/td>.*?<td[^>]*width="150"[^>]*>(.*?)<\/td>.*?<td[^>]*width="58"[^>]*>(.*?)<\/td>/s';
    if (preg_match_all($pattern, $raw, $m, PREG_SET_ORDER)) {
        foreach ($m as $r) {
            // 첨부 td에서 원본 업로드 경로 추출 (MM_openBrWindow('/upload/...'))
            $attachPath = null;
            if (preg_match('/\/upload\/([^\'"<>]+?\.\w{2,5})/i', $r[6], $am)) {
                $attachPath = 'upload/' . toUtf8($am[1]);
            }
            $rows[] = [
                'orig_id' => (int)$r[1],
                'title' => cleanText($r[2]),
                'lecturer' => cleanText(strip_tags($r[4])),
                'affiliation' => cleanText(strip_tags($r[5])),
                'attach' => $attachPath,
            ];
        }
    }
    return $rows;
}

// 상세 파싱 (sync_boards.php 기반 + 첨부 정규식 공백 버그 수정판)
function parseDetail(string $detailUrlFull): ?array
{
    $raw = fetchRaw($detailUrlFull);
    if (!$raw) return null;
    $regdateKR = mb_convert_encoding('등록일', 'EUC-KR', 'UTF-8');
    $date = null;
    if (preg_match('/' . preg_quote($regdateKR, '/') . '\s*:\s*([\d\/\-\.]+)/', $raw, $d)) {
        $date = str_replace(['/', '.'], '-', $d[1]);
    }
    $content = '';
    if (preg_match('/<td[^>]*class=low[^>]*>(.*?)<\/td>/si', $raw, $body)) {
        $content = toUtf8(trim($body[1]));
        $content = preg_replace('/<img[^>]*space\.gif[^>]*>/i', '', $content);
        $content = trim($content);
    }
    $attachments = [];
    // 닫는 따옴표 직전의 확장자까지 탐욕적으로 캡처 — "31.Norbert_xxx.pdf"처럼 파일명에 점이 여러 개 있어도 안전
    if (preg_match_all('/\/upload\/([^\'"<>]+\.\w{2,5})\s*[\'"]/iU', $raw, $files)) {
        $seen = [];
        foreach ($files[1] as $filePath) {
            $fileName = urldecode(basename($filePath));
            if (in_array(strtolower($fileName), ['thumbs.db', 'web.config', 'space.gif'])) continue;
            if (preg_match('/^(img|icon|board)\//i', $filePath)) continue;
            $key = strtolower($filePath);
            if (isset($seen[$key])) continue;
            $seen[$key] = true;
            $attachments[] = [
                'remote_path' => 'upload/' . toUtf8($filePath),
                'file_name' => toUtf8($fileName),
            ];
        }
    }
    return ['published_at' => $date, 'content' => $content, 'attachments' => $attachments];
}

function downloadFtpFile(string $remotePath, string $localPath): bool
{
    global $ftpUser, $ftpPass, $ftpHost;
    $dir = dirname($localPath);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $encoded = implode('/', array_map('rawurlencode', explode('/', $remotePath)));
    $url = 'ftp://' . $ftpUser . ':' . rawurlencode($ftpPass) . '@' . $ftpHost . '/' . $encoded;
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

function saveAttachments(Post $post, array $attachments): void
{
    foreach ($attachments as $att) {
        $localDir = storage_path('app/public/attachments/education_seminar');
        $safeName = preg_replace('/[\/\\\\]/', '_', $att['file_name']);
        $localPath = $localDir . '/' . $safeName;
        if (file_exists($localPath) || downloadFtpFile($att['remote_path'], $localPath) || downloadHttpFile($att['remote_path'], $localPath)) {
            $post->attachments()->create([
                'file_name' => $att['file_name'],
                'file_path' => 'storage/attachments/education_seminar/' . $safeName,
                'file_size' => filesize($localPath),
                'mime_type' => mime_content_type($localPath) ?: 'application/octet-stream',
            ]);
            echo "      첨부 ✓ {$att['file_name']}\n";
        } else {
            echo "      첨부 ✗ 다운로드 실패: {$att['remote_path']}\n";
        }
    }
}

// ============================================
// 1단계: 목록 크롤
// ============================================
if ($mode === 'crawl') {
    $raw = fetchRaw($baseUrl . $listUrl . '1');
    if (!$raw) { echo "원본 접근 불가\n"; exit(1); }
    $total = 0;
    if (preg_match('/Total\s*:\s*([\d,]+)/i', $raw, $m)) {
        $total = (int)str_replace(',', '', $m[1]);
    }
    $totalPages = $total > 0 ? (int)ceil($total / 10) : 60;
    echo "원본 총 {$total}건, {$totalPages}페이지 크롤 시작\n";

    $all = [];
    $seen = [];
    for ($page = 1; $page <= $totalPages; $page++) {
        $raw = ($page === 1) ? $raw : fetchRaw($baseUrl . $listUrl . $page);
        $rows = parseListPage($raw);
        foreach ($rows as $r) {
            if (isset($seen[$r['orig_id']])) continue;
            $seen[$r['orig_id']] = true;
            $all[] = $r;
        }
        echo "  p{$page}: " . count($rows) . "건 (누적 " . count($all) . ")\n";
        usleep(1100000);
    }
    file_put_contents($jsonPath, json_encode($all, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    echo "저장 완료: {$jsonPath} (" . count($all) . "건)\n";
    exit(0);
}

// ============================================
// 2~3단계: DB 반영
// ============================================
if ($mode === 'apply') {
    if (!file_exists($jsonPath)) { echo "먼저 crawl을 실행하세요\n"; exit(1); }
    $siteList = json_decode(file_get_contents($jsonPath), true); // 최신순
    echo "원본 목록 " . count($siteList) . "건 로드\n";

    // DB도 최신순 정렬 (원본 목록 순서와 정합)
    $dbPosts = Post::where('board_type', 'education_seminar')
        ->orderByDesc('published_at')->orderByDesc('id')
        ->get();
    echo "DB " . $dbPosts->count() . "건\n";

    // 제목별 큐 구성 (중복 제목은 최신순 순서대로 매칭)
    $dbByTitle = [];
    foreach ($dbPosts as $p) {
        $dbByTitle[trim($p->title)][] = $p;
    }

    $updated = 0; $added = 0; $unmatched = [];
    foreach ($siteList as $row) {
        $title = trim($row['title']);
        $post = null;
        if (!empty($dbByTitle[$title])) {
            $post = array_shift($dbByTitle[$title]);
        }

        if ($post) {
            $newAuthor = $row['lecturer'] !== '' ? $row['lecturer'] : $post->author;
            $meta = $post->metadata ?? [];
            if ($row['affiliation'] !== '') $meta['affiliation'] = $row['affiliation'];
            $dirty = ($post->author !== $newAuthor) || (($post->metadata ?? []) !== $meta);
            if ($dirty) {
                if ($dryRun) {
                    echo "[DRY] #{$post->id} {$title} → 강사='{$newAuthor}' 소속='" . ($meta['affiliation'] ?? '') . "'\n";
                } else {
                    $post->author = $newAuthor;
                    $post->metadata = $meta;
                    $post->save();
                }
                $updated++;
            }

            // 첨부 누락 보수: 원본엔 첨부가 있는데 DB엔 없는 글
            $needAttach = !empty($row['attach']) && $post->attachments()->count() === 0;
            // 본문 깨짐 보수: <body>가 닫히지 않은 채 잘린 글
            $needContent = stripos($post->content ?? '', '<body') !== false
                && stripos($post->content ?? '', '</body>') === false;
            if ($needAttach || $needContent) {
                if ($dryRun) {
                    echo "[DRY] #{$post->id} {$title} → " . ($needAttach ? '첨부보수 ' : '') . ($needContent ? '본문재수집' : '') . "\n";
                } else {
                    echo "  보수: #{$post->id} {$title}" . ($needAttach ? ' [첨부]' : '') . ($needContent ? ' [본문]' : '') . "\n";
                    $detail = parseDetail($baseUrl . $detailUrl . $row['orig_id']);
                    if ($detail) {
                        if ($needContent && $detail['content']) {
                            $post->content = $detail['content'];
                            $post->save();
                        }
                        if ($needAttach) {
                            saveAttachments($post, $detail['attachments']);
                        }
                    } else {
                        echo "      ✗ 상세 파싱 실패\n";
                    }
                    usleep(1100000);
                }
            }
        } else {
            // 원본에만 있는 글 → 신규 추가
            if ($dryRun) {
                echo "[DRY] 신규 추가: 원본#{$row['orig_id']} {$title} (강사={$row['lecturer']} / 소속={$row['affiliation']})\n";
                $added++;
                continue;
            }
            echo "  신규: 원본#{$row['orig_id']} {$title}\n";
            $detail = parseDetail($baseUrl . $detailUrl . $row['orig_id']);
            if (!$detail) { echo "      ✗ 상세 파싱 실패\n"; $unmatched[] = $row; continue; }
            $meta = [];
            if ($row['affiliation'] !== '') $meta['affiliation'] = $row['affiliation'];
            $post = Post::create([
                'board_type' => 'education_seminar',
                'title' => $title,
                'content' => $detail['content'] ?: '',
                'author' => $row['lecturer'],
                'metadata' => $meta ?: null,
                'is_published' => true,
                'published_at' => $detail['published_at'],
                'view_count' => 0,
            ]);
            saveAttachments($post, $detail['attachments']);
            $added++;
            usleep(1100000);
        }
    }

    // DB에 남은(원본에 없는) 글
    $leftover = [];
    foreach ($dbByTitle as $t => $arr) {
        foreach ($arr as $p) $leftover[] = "#{$p->id} {$t}";
    }

    echo "\n결과: 갱신 {$updated} / 신규 {$added}\n";
    if ($leftover) {
        echo "원본에 없는 DB 글 " . count($leftover) . "건 (삭제하지 않음):\n";
        foreach ($leftover as $l) echo "  {$l}\n";
    }
    if ($unmatched) {
        echo "상세 파싱 실패 " . count($unmatched) . "건\n";
    }
    exit(0);
}

echo "사용법: php scripts/sync_seminar_meta.php [crawl|apply] [--dry-run]\n";
exit(1);
