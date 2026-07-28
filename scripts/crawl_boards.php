#!/usr/bin/env php
<?php
/**
 * CMAK 원본 사이트 게시글 + 첨부파일 크롤링 스크립트
 * 사용법: php scripts/crawl_boards.php [board_key] [--dry-run]
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;
use App\Models\Attachment;

// ============================================
// 게시판 설정
// ============================================
$boards = [
    'news_domestic' => [
        'list_url' => '/html/notice/news.asp?code=0&GotoPage=',
        'detail_url' => '/html/notice/news_r.asp?code=0&no=',
    ],
    'news_association' => [
        'list_url' => '/html/notice/nleague1.asp?GotoPage=',
        'detail_url' => '/html/notice/nleague1_r.asp?no=',
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

// 인자 처리
$targetBoard = $argv[1] ?? null;
$dryRun = in_array('--dry-run', $argv);
// 최신 N페이지만 크롤(테스트용 최근글 빠른 적재). 예: php crawl_boards.php news_bid 5
$maxPages = null;
foreach (array_slice($argv, 2) as $a) {
    if (is_numeric($a)) { $maxPages = (int) $a; break; }
}

if (!$targetBoard || ($targetBoard !== 'all' && !isset($boards[$targetBoard]))) {
    echo "사용법: php scripts/crawl_boards.php [board_key|all] [--dry-run]\n\n";
    echo "게시판 목록:\n";
    foreach (array_keys($boards) as $k) {
        $name = config('boards.' . $k . '.name') ?? $k;
        $count = Post::where('board_type', $k)->count();
        echo "  {$k} ({$name}) - 현재 {$count}건\n";
    }
    echo "  all - 전체 크롤링\n";
    exit(1);
}

$boardsToProcess = $targetBoard === 'all' ? $boards : [$targetBoard => $boards[$targetBoard]];

// ============================================
// HTTP 요청 - raw EUC-KR 반환
// ============================================
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

// ============================================
// FTP 다운로드
// ============================================
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

// ============================================
// 목록 페이지에서 ID + 제목 추출
// ============================================
function getPostList(string $listUrl, int $page): array
{
    global $baseUrl;
    $raw = fetchRaw($baseUrl . $listUrl . $page);
    if (!$raw) return [];

    $posts = [];
    // go_Edit('ID')">제목</a> 패턴 (EUC-KR raw)
    preg_match_all("/go_Edit\('(\d+)'\)\">([^<]+)/", $raw, $matches, PREG_SET_ORDER);
    foreach ($matches as $m) {
        $posts[] = [
            'id' => (int)$m[1],
            'title' => trim(toUtf8($m[2])),
        ];
    }
    return $posts;
}

// ============================================
// 총 건수 추출
// ============================================
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

// ============================================
// 상세 페이지 파싱 (raw EUC-KR)
// ============================================
function parseDetail(string $detailUrl, int $postId): ?array
{
    global $baseUrl;
    $raw = fetchRaw($baseUrl . $detailUrl . $postId);
    if (!$raw) return null;

    // 등록일 (EUC-KR 바이트 패턴)
    $regdateKR = mb_convert_encoding("등록일", "EUC-KR", "UTF-8");
    $date = null;
    if (preg_match('/' . preg_quote($regdateKR, '/') . '\s*:\s*([\d\/\-\.]+)/', $raw, $d)) {
        $date = str_replace(['/', '.'], '-', $d[1]);
    }

    // 본문 - class=low 태그 안
    $content = '';
    if (preg_match('/<td[^>]*class=low[^>]*>(.*?)<\/td>/si', $raw, $body)) {
        $content = toUtf8(trim($body[1]));
        $content = preg_replace('/<img[^>]*space\.gif[^>]*>/i', '', $content);
        $content = trim($content);
    }

    // 첨부파일
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
            $attachments[] = [
                'remote_path' => 'upload/' . $filePath,
                'file_name' => toUtf8($fileName),
            ];
        }
    }

    return [
        'published_at' => $date,
        'content' => $content,
        'attachments' => $attachments,
    ];
}

// ============================================
// 중복 체크
// ============================================
function isDuplicate(string $boardType, string $title, ?string $date): bool
{
    $query = Post::where('board_type', $boardType)->where('title', $title);
    if ($date) {
        $query->whereDate('published_at', $date);
    }
    return $query->exists();
}

// ============================================
// 메인 루프
// ============================================
$grandTotal = ['new' => 0, 'skip' => 0, 'error' => 0];

foreach ($boardsToProcess as $boardKey => $config) {
    $boardName = config('boards.' . $boardKey . '.name') ?? $boardKey;
    echo "\n========================================\n";
    echo "[{$boardName}] ({$boardKey})\n";
    echo "========================================\n";

    $totalCount = getTotalCount($config['list_url']);
    $pageSize = 10;
    $totalPages = $totalCount > 0 ? ceil($totalCount / $pageSize) : 200;
    if ($maxPages) { $totalPages = min($totalPages, $maxPages); }
    $existingCount = Post::where('board_type', $boardKey)->count();
    echo "원본: {$totalCount}건 / 현재DB: {$existingCount}건 / 크롤 페이지: {$totalPages}" . ($maxPages ? " (최신 {$maxPages}p 제한)" : "") . "\n";

    $newCount = 0;
    $skipCount = 0;
    $errorCount = 0;
    $emptyPages = 0;

    for ($page = 1; $page <= $totalPages; $page++) {
        $postList = getPostList($config['list_url'], $page);

        if (empty($postList)) {
            $emptyPages++;
            if ($emptyPages >= 3) break;
            continue;
        }
        $emptyPages = 0;

        echo "  P{$page}: " . count($postList) . "건";

        $pageNew = 0;
        $pageSkip = 0;
        foreach ($postList as $item) {
            $title = html_entity_decode($item['title'], ENT_QUOTES, 'UTF-8');

            // 중복 체크 - 제목으로
            if (Post::where('board_type', $boardKey)->where('title', $title)->exists()) {
                $pageSkip++;
                $skipCount++;
                continue;
            }

            // 상세 페이지 파싱
            $detail = parseDetail($config['detail_url'], $item['id']);
            if (!$detail) {
                $errorCount++;
                continue;
            }

            // 날짜로도 중복 재확인
            if ($detail['published_at'] && isDuplicate($boardKey, $title, $detail['published_at'])) {
                $pageSkip++;
                $skipCount++;
                continue;
            }

            if ($dryRun) {
                echo "\n    [DRY] #{$item['id']} {$title} ({$detail['published_at']}) 첨부:" . count($detail['attachments']) . "개";
                $pageNew++;
                $newCount++;
                continue;
            }

            // DB 저장
            $post = Post::create([
                'board_type' => $boardKey,
                'title' => $title,
                'content' => $detail['content'] ?: '',
                'author' => '',
                'is_published' => true,
                'published_at' => $detail['published_at'],
                'view_count' => 0,
            ]);

            // 첨부파일 FTP 다운로드
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

            $pageNew++;
            $newCount++;
            usleep(200000); // 0.2초
        }

        echo " → 새글:{$pageNew} 중복:{$pageSkip}\n";

        // 한 페이지 전부 중복이면 이후 페이지도 중복일 가능성 높음
        if ($pageSkip === count($postList) && $pageNew === 0) {
            $emptyPages++;
            if ($emptyPages >= 5) {
                echo "  [연속 5페이지 전부 중복 - 종료]\n";
                break;
            }
        } else {
            $emptyPages = 0;
        }

        usleep(300000); // 0.3초
    }

    echo "\n  결과: 새글 {$newCount} / 중복 {$skipCount} / 오류 {$errorCount}\n";
    $grandTotal['new'] += $newCount;
    $grandTotal['skip'] += $skipCount;
    $grandTotal['error'] += $errorCount;
}

echo "\n========================================\n";
echo "전체 결과: 새글 {$grandTotal['new']} / 중복 {$grandTotal['skip']} / 오류 {$grandTotal['error']}\n";
echo "========================================\n";
