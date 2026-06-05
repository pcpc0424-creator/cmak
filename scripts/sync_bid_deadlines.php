#!/usr/bin/env php
<?php
/**
 * 입찰소식(news_bid) 마감일 동기화 스크립트
 * 원본 사이트 목록 페이지(ntrnder.asp)에서 발주처/공고일/마감일을 수집해
 * DB의 metadata.deadline_date를 채운다 (제목+공고일 매칭).
 *
 * 사용법: php scripts/sync_bid_deadlines.php [--dry-run] [--pages=N]
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$baseUrl = 'http://www.cmak.or.kr';
$listUrl = '/html/notice/ntrnder.asp?GotoPage=';

$dryRun = in_array('--dry-run', $argv);
$maxPages = null;
foreach ($argv as $arg) {
    if (preg_match('/^--pages=(\d+)$/', $arg, $m)) $maxPages = (int)$m[1];
}

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

    if ($code !== 200 || !$html || strpos($html, 'WAF') !== false) return '';
    return $html;
}

function toUtf8(string $raw): string
{
    return @mb_convert_encoding($raw, 'UTF-8', 'EUC-KR') ?: $raw;
}

// 양끝 공백/nbsp 제거 (trim 문자목록은 바이트 단위라 한글 마지막 바이트를 깨뜨림 → 정규식 사용)
function utrim(string $s): string
{
    return preg_replace('/^[\s\x{00A0}]+|[\s\x{00A0}]+$/u', '', $s) ?? trim($s);
}

// "26.06.04" → "2026-06-04" (빈 값이면 null)
function parseDate(string $s): ?string
{
    $s = utrim(html_entity_decode($s, ENT_QUOTES, 'UTF-8'));
    if (!preg_match('/^(\d{2})\.(\d{2})\.(\d{2})$/', $s, $m)) return null;
    $year = ((int)$m[1] >= 90 ? '19' : '20') . $m[1];
    return "{$year}-{$m[2]}-{$m[3]}";
}

function normalizeTitle(string $s): string
{
    $s = html_entity_decode($s, ENT_QUOTES, 'UTF-8');
    $s = preg_replace('/[\s\x{00A0}]+/u', '', $s);
    return trim($s);
}

function cleanText(string $s): string
{
    $s = html_entity_decode($s, ENT_QUOTES, 'UTF-8');
    $s = preg_replace('/[\s\x{00A0}]+/u', ' ', $s);
    return utrim($s);
}

// 목록 페이지 한 장 파싱 → [['no','title','office','announce','deadline'], ...]
function parseListPage(string $html): array
{
    $rows = [];
    preg_match_all(
        '/go_Edit\(\'(\d+)\'\)">(.*?)<\/a>.*?<td height="45" width="150">(.*?)<\/td>.*?width="61" align="center">(.*?)<\/td>.*?width="61" align="center">(.*?)<\/td>/s',
        $html, $matches, PREG_SET_ORDER
    );
    foreach ($matches as $m) {
        $rows[] = [
            'no'       => (int)$m[1],
            'title'    => cleanText($m[2]),
            'office'   => cleanText($m[3]),
            'announce' => parseDate($m[4]),
            'deadline' => parseDate($m[5]),
        ];
    }
    return $rows;
}

// ============================================
// 1. DB 게시글 인덱스 구성 (제목+공고일 → post, 제목 → posts)
// ============================================
$dbPosts = Post::where('board_type', 'news_bid')->get(['id', 'title', 'metadata']);
echo "DB 게시글: {$dbPosts->count()}건\n";

$byTitleDate = [];
$byTitle = [];
$byDate = [];
foreach ($dbPosts as $p) {
    $nt = normalizeTitle($p->title);
    $meta = is_array($p->metadata) ? $p->metadata : [];
    $announce = $meta['announcement_date'] ?? '';
    $byTitleDate[$nt . '|' . $announce][] = $p;
    $byTitle[$nt][] = $p;
    $byDate[$announce][] = [$nt, $p];
}

// ============================================
// 2. 원본 목록 페이지 순회
// ============================================
$first = fetchRaw($baseUrl . $listUrl . '1');
if (!$first) { echo "ERROR: 첫 페이지 요청 실패\n"; exit(1); }
$firstRows = parseListPage(toUtf8($first));
if (!$firstRows) { echo "ERROR: 첫 페이지 파싱 실패\n"; exit(1); }

// 첫 행의 글번호(연번)로 총 페이지 수 추산 (페이지당 행 수 기준)
$perPage = count($firstRows);
$totalPages = 999;
if (preg_match('/<td height="45" width="31" align="center">(\d+)<\/td>/', toUtf8($first), $tm)) {
    $totalPages = (int)ceil((int)$tm[1] / $perPage);
}
if ($maxPages) $totalPages = min($totalPages, $maxPages);
echo "페이지당 {$perPage}행, 총 약 {$totalPages}페이지 처리 예정" . ($dryRun ? ' [DRY-RUN]' : '') . "\n";

$stats = ['rows' => 0, 'updated' => 0, 'already' => 0, 'no_deadline' => 0, 'unmatched' => 0, 'ambiguous' => 0];
$unmatchedSamples = [];

for ($page = 1; $page <= $totalPages; $page++) {
    $html = $page === 1 ? toUtf8($first) : toUtf8(fetchRaw($baseUrl . $listUrl . $page));
    if (!$html) { echo "WARN: 페이지 {$page} 요청 실패, 재시도\n"; sleep(2); $html = toUtf8(fetchRaw($baseUrl . $listUrl . $page)); }
    if (!$html) { echo "WARN: 페이지 {$page} 건너뜀\n"; continue; }

    $rows = parseListPage($html);
    if (!$rows) break; // 마지막 페이지 이후

    foreach ($rows as $row) {
        $stats['rows']++;
        if (!$row['deadline']) { $stats['no_deadline']++; continue; }

        $nt = normalizeTitle($row['title']);
        $candidates = $byTitleDate[$nt . '|' . $row['announce']] ?? $byTitle[$nt] ?? [];

        // 폴백 1: 원본 목록 제목이 잘린 경우 → 같은 공고일 내에서 접두사 매칭
        // (멀티바이트 중간에서 잘려 깨진 마지막 글자 제거)
        $ntClean = rtrim($nt, "?\u{FFFD}");
        if (count($candidates) === 0 && mb_strlen($ntClean) >= 20) {
            foreach ($byDate[$row['announce']] ?? [] as [$dbNt, $dbPost]) {
                if (str_starts_with($dbNt, $ntClean)) $candidates[] = $dbPost;
            }
        }

        // 폴백 2: 공고일이 어긋난 경우 → 전체에서 접두사 매칭 (유일할 때만)
        if (count($candidates) === 0 && mb_strlen($ntClean) >= 25) {
            foreach ($byTitle as $dbNt => $dbPostList) {
                if (str_starts_with($dbNt, $ntClean)) {
                    foreach ($dbPostList as $dbPost) $candidates[] = $dbPost;
                    if (count($candidates) > 1) break;
                }
            }
        }

        if (count($candidates) === 0) {
            $stats['unmatched']++;
            // DB 보유 구간(4/17 이전)의 미매칭이 진짜 문제 → 우선 수집
            if ($row['announce'] <= '2026-04-17' && count($unmatchedSamples) < 30) {
                $unmatchedSamples[] = "no={$row['no']} {$row['announce']} {$row['title']}";
            }
            continue;
        }
        if (count($candidates) > 1) { $stats['ambiguous']++; continue; }

        $post = $candidates[0];
        $meta = is_array($post->metadata) ? $post->metadata : [];
        if (($meta['deadline_date'] ?? '') === $row['deadline']) { $stats['already']++; continue; }

        $meta['deadline_date'] = $row['deadline'];
        if (empty($meta['ordering_office']) && $row['office']) $meta['ordering_office'] = $row['office'];
        if (empty($meta['announcement_date']) && $row['announce']) $meta['announcement_date'] = $row['announce'];

        if (!$dryRun) {
            $post->metadata = $meta;
            $post->saveQuietly();
        }
        $stats['updated']++;
    }

    if ($page % 10 === 0 || $page === $totalPages) {
        echo "페이지 {$page}/{$totalPages} | 처리 {$stats['rows']}행 | 갱신 {$stats['updated']} | 기존일치 {$stats['already']} | 마감일없음 {$stats['no_deadline']} | 미매칭 {$stats['unmatched']} | 중복모호 {$stats['ambiguous']}\n";
    }
    usleep(300000); // 0.3초 간격
}

echo "\n=== 완료 ===\n";
foreach ($stats as $k => $v) echo "  {$k}: {$v}\n";
if ($unmatchedSamples) {
    echo "\n미매칭 샘플 (최대 20건):\n";
    foreach ($unmatchedSamples as $s) echo "  - {$s}\n";
}
