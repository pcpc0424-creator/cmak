#!/usr/bin/env php
<?php
/**
 * CMAK 원본 사이트와 DB 동기화 스크립트
 * - 원본 사이트에 있는 글만 남기고 나머지 삭제
 * - 원본에 있는데 DB에 없는 글은 새로 가져옴
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$boards = [
    'news_domestic' => [
        'list_url' => '/html/notice/news.asp?code=0&GotoPage=',
        'detail_url' => '/html/notice/news_r.asp?code=0&no=',
    ],
    'news_association' => [
        'list_url' => '/html/notice/nleague1.asp?code=1&GotoPage=',
        'detail_url' => '/html/notice/nleague1_r.asp?code=1&no=',
    ],
    'news_law' => [
        'list_url' => '/html/notice/nlow.asp?GotoPage=',
        'detail_url' => '/html/notice/nlow_r.asp?no=',
    ],
    'news_org' => [
        'list_url' => '/html/notice/norg.asp?GotoPage=',
        'detail_url' => '/html/notice/norg_r.asp?no=',
    ],
    'news_bid' => [
        'list_url' => '/html/notice/ntrnder.asp?GotoPage=',
        'detail_url' => '/html/notice/ntrnder_r.asp?no=',
    ],
    'member_trend' => [
        'list_url' => '/html/notice/nwind.asp?GotoPage=',
        'detail_url' => '/html/notice/nwind_r.asp?no=',
    ],
    'news_press' => [
        'list_url' => '/html/notice/nleague1.asp?code=2&GotoPage=',
        'detail_url' => '/html/notice/nleague1_r.asp?code=2&no=',
    ],
    'expert_column' => [
        'list_url' => '/html/cmdata/cmexpert.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmexpert_r.asp?no=',
    ],
    'special_feature' => [
        'list_url' => '/html/cmdata/cmspeical.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmspeical_r.asp?no=',
    ],
    'education_seminar' => [
        'list_url' => '/html/cmdata/cmsemina.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmsemina_r.asp?no=',
    ],
    'research' => [
        'list_url' => '/html/cmdata/cmreport.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmreport_r.asp?no=',
    ],
    'etc_data' => [
        'list_url' => '/html/cmdata/cmetc.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmetc_r.asp?no=',
    ],
    'cm_case' => [
        'list_url' => '/html/cmdata/cmexample.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmexample_r.asp?no=',
    ],
    'cm_overseas' => [
        'list_url' => '/html/cmdata/cmglobal.asp?GotoPage=',
        'detail_url' => '/html/cmdata/cmglobal_r.asp?no=',
    ],
    'free_board' => [
        'list_url' => '/html/free/freeboard.asp?GotoPage=',
        'detail_url' => '/html/free/freeboard_r.asp?no=',
    ],
    'book_review' => [
        'list_url' => '/html/free/bookreview.asp?GotoPage=',
        'detail_url' => '/html/free/bookreview_r.asp?no=',
    ],
    'wordbook' => [
        'list_url' => '/html/free/wordbook.asp?GotoPage=',
        'detail_url' => '/html/free/wordbook_r.asp?no=',
    ],
    'faq' => [
        'list_url' => '/html/free/faq.asp?GotoPage=',
        'detail_url' => '/html/free/faq_r.asp?no=',
    ],
    'job_offer' => [
        'list_url' => '/html/free/wanted.asp?GotoPage=',
        'detail_url' => '/html/free/wanted_r.asp?no=',
    ],
    'job_seek' => [
        'list_url' => '/html/free/hunting.asp?GotoPage=',
        'detail_url' => '/html/free/hunting_r.asp?no=',
    ],
    'herald' => [
        'list_url' => '/html/business/bcmhzine.asp?GotoPage=',
        'detail_url' => '/html/business/bcmhzine.asp?no=',
    ],
];

$baseUrl = 'http://www.cmak.or.kr';
$ftpUser = 'cmak1997';
$ftpPass = 'cmak1997@cm1997';
$ftpHost = 'cmak.or.kr';

$targetBoard = $argv[1] ?? null;
$dryRun = in_array('--dry-run', $argv);

if (!$targetBoard || ($targetBoard !== 'all' && !isset($boards[$targetBoard]))) {
    echo "사용법: php scripts/sync_boards.php [board_key|all] [--dry-run]\n";
    exit(1);
}

$boardsToProcess = $targetBoard === 'all' ? $boards : [$targetBoard => $boards[$targetBoard]];

// HTTP 요청
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
        // 406/차단 시 점진적 백오프
        if ($attempt < $retries) sleep(2 * $attempt);
    }
    return '';
}

function toUtf8(string $raw): string
{
    return @mb_convert_encoding($raw, 'UTF-8', 'EUC-KR') ?: $raw;
}

function getTotalCount(string $listUrl): int
{
    global $baseUrl;
    $raw = fetchRaw($baseUrl . $listUrl . '1');
    if (!$raw) return 0;
    if (preg_match('/Total\s*:\s*([\d,]+)/i', $raw, $m)) {
        return (int)str_replace(',', '', $m[1]);
    }
    return 0;
}

// 목록에서 제목 수집
function getAllTitlesFromSite(string $listUrl, int $totalCount): array
{
    global $baseUrl;
    $pageSize = 10;
    $totalPages = $totalCount > 0 ? ceil($totalCount / $pageSize) : 200;
    $titles = [];
    $emptyPages = 0;

    for ($page = 1; $page <= $totalPages; $page++) {
        $raw = fetchRaw($baseUrl . $listUrl . $page);
        if (!$raw) {
            $emptyPages++;
            if ($emptyPages >= 3) break;
            continue;
        }

        $posts = [];
        preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $raw, $matches, PREG_SET_ORDER);
        if (empty($matches)) {
            $emptyPages++;
            if ($emptyPages >= 3) break;
            continue;
        }
        $emptyPages = 0;

        foreach ($matches as $m) {
            $title = html_entity_decode(trim(toUtf8($m[2])), ENT_QUOTES, 'UTF-8');
            $titles[] = $title;
        }
        usleep(1000000);
    }

    return $titles;
}

// FTP 다운로드
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

// 상세 파싱
function parseDetail(string $detailUrl, int $postId): ?array
{
    global $baseUrl;
    $raw = fetchRaw($baseUrl . $detailUrl . $postId);
    if (!$raw) return null;
    $regdateKR = mb_convert_encoding("등록일", "EUC-KR", "UTF-8");
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
    return ['published_at' => $date, 'content' => $content, 'attachments' => $attachments];
}

// 목록에서 ID+제목 수집 (같은 ID가 한 행에 여러 번 나오면 첫 매칭만 - 예: wordbook은 단어+정의 각각 링크)
function getPostListWithIds(string $listUrl, int $page): array
{
    global $baseUrl;
    $raw = fetchRaw($baseUrl . $listUrl . $page);
    if (!$raw) return [];
    $posts = [];
    $seenIds = [];
    preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $raw, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $id = (int)$m[1];
        if (isset($seenIds[$id])) continue;
        $seenIds[$id] = true;
        $posts[] = [
            'id' => $id,
            'title' => html_entity_decode(trim(toUtf8($m[2])), ENT_QUOTES, 'UTF-8'),
        ];
    }
    return $posts;
}

// ============================================
// 메인 루프
// ============================================
$grandTotal = ['kept' => 0, 'deleted' => 0, 'added' => 0];

foreach ($boardsToProcess as $boardKey => $config) {
    $boardName = config('boards.' . $boardKey . '.name') ?? $boardKey;
    echo "\n========================================\n";
    echo "[{$boardName}] ({$boardKey})\n";
    echo "========================================\n";

    $totalCount = getTotalCount($config['list_url']);
    $dbCount = Post::where('board_type', $boardKey)->count();
    echo "원본: {$totalCount}건 / DB: {$dbCount}건\n";

    if ($totalCount === 0) {
        echo "  → 원본 접근 불가, 스킵\n";
        continue;
    }

    // 1단계: 원본 사이트에서 전체 제목+ID 수집 (중복 제목 포함)
    echo "  [1] 원본 사이트 제목 수집 중...\n";
    $pageSize = 10;
    $totalPages = ceil($totalCount / $pageSize);
    $sitePostList = []; // [{title, id}, ...] 순서 유지
    $siteTitleCount = []; // title => 원본에서 등장 횟수
    $emptyPages = 0;

    for ($page = 1; $page <= $totalPages; $page++) {
        $posts = getPostListWithIds($config['list_url'], $page);
        if (empty($posts)) {
            $emptyPages++;
            if ($emptyPages >= 3) break;
            continue;
        }
        $emptyPages = 0;
        foreach ($posts as $p) {
            $sitePostList[] = $p;
            $siteTitleCount[$p['title']] = ($siteTitleCount[$p['title']] ?? 0) + 1;
        }
        usleep(1000000);
    }
    echo "    수집 완료: " . count($sitePostList) . "건 (고유 제목 " . count($siteTitleCount) . "개)\n";

    // 2단계: DB에서 원본에 없는 글 삭제, 중복 제목은 원본 개수만큼 유지
    echo "  [2] DB 정리 중...\n";
    $dbPosts = Post::where('board_type', $boardKey)->orderBy('id')->get(['id', 'title']);
    $keepIds = [];
    $deleteIds = [];
    $matchedCount = []; // title => 매칭된 횟수

    foreach ($dbPosts as $post) {
        $matched = $matchedCount[$post->title] ?? 0;
        $allowed = $siteTitleCount[$post->title] ?? 0;
        if ($matched < $allowed) {
            $keepIds[] = $post->id;
            $matchedCount[$post->title] = $matched + 1;
        } else {
            $deleteIds[] = $post->id;
        }
    }

    if (!empty($deleteIds)) {
        if ($dryRun) {
            echo "    [DRY] 삭제 예정: " . count($deleteIds) . "건\n";
        } else {
            // 배치로 삭제 (대량 삭제 시)
            foreach (array_chunk($deleteIds, 500) as $chunk) {
                \DB::table('attachments')
                    ->where('attachable_type', 'App\\Models\\Post')
                    ->whereIn('attachable_id', $chunk)
                    ->delete();
                Post::whereIn('id', $chunk)->delete();
            }
            echo "    삭제: " . count($deleteIds) . "건\n";
        }
    }

    $kept = count($keepIds);
    echo "    유지: {$kept}건\n";

    // 3단계: 원본에 있는데 DB에 없는 글 추가 (중복 제목 고려)
    $missingPosts = [];
    foreach ($siteTitleCount as $title => $needed) {
        $have = $matchedCount[$title] ?? 0;
        $missing = $needed - $have;
        if ($missing > 0) {
            // 원본 목록에서 이 제목의 ID들을 가져옴
            $idsForTitle = [];
            foreach ($sitePostList as $sp) {
                if ($sp['title'] === $title) {
                    $idsForTitle[] = $sp['id'];
                }
            }
            // 부족한 개수만큼 뒤에서부터 추가
            $toAdd = array_slice($idsForTitle, -$missing);
            foreach ($toAdd as $origId) {
                $missingPosts[] = ['title' => $title, 'id' => $origId];
            }
        }
    }
    $addCount = 0;

    if (!empty($missingPosts)) {
        echo "  [3] 누락 글 " . count($missingPosts) . "건 가져오는 중...\n";
        foreach ($missingPosts as $mp) {
            $title = $mp['title'];
            $origId = $mp['id'];
            $detail = parseDetail($config['detail_url'], $origId);
            if (!$detail) {
                echo "    오류: #{$origId} {$title}\n";
                continue;
            }

            if ($dryRun) {
                echo "    [DRY] 추가: #{$origId} {$title}\n";
                $addCount++;
                continue;
            }

            $post = Post::create([
                'board_type' => $boardKey,
                'title' => $title,
                'content' => $detail['content'] ?: '',
                'author' => '',
                'is_published' => true,
                'published_at' => $detail['published_at'],
                'view_count' => 0,
            ]);

            foreach ($detail['attachments'] as $att) {
                $localDir = storage_path('app/public/attachments/' . $boardKey);
                $safeName = preg_replace('/[\/\\\\]/', '_', $att['file_name']);
                $localPath = $localDir . '/' . $safeName;
                if (downloadFtpFile($att['remote_path'], $localPath)) {
                    $post->attachments()->create([
                        'file_name' => $att['file_name'],
                        'file_path' => 'storage/attachments/' . $boardKey . '/' . $safeName,
                        'file_size' => filesize($localPath),
                        'mime_type' => mime_content_type($localPath) ?: 'application/octet-stream',
                    ]);
                }
            }
            $addCount++;
            usleep(1000000);
        }
    }

    $finalCount = Post::where('board_type', $boardKey)->count();
    echo "  결과: 유지 {$kept} / 삭제 " . count($deleteIds) . " / 추가 {$addCount} → 최종 {$finalCount}건 (원본 {$totalCount}건)\n";

    $grandTotal['kept'] += $kept;
    $grandTotal['deleted'] += count($deleteIds);
    $grandTotal['added'] += $addCount;
}

echo "\n========================================\n";
echo "전체 결과: 유지 {$grandTotal['kept']} / 삭제 {$grandTotal['deleted']} / 추가 {$grandTotal['added']}\n";
echo "========================================\n";
