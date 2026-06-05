#!/usr/bin/env php
<?php
/**
 * 원본 사이트와 DB의 게시판별 게시글 수 비교 (빠른 점검용)
 * 각 게시판 1페이지만 가져와 Total 값을 추출하고 DB 카운트와 비교
 */

require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Post;

$boards = [
    'news_domestic'      => '/html/notice/news.asp?code=0&GotoPage=1',
    'news_association'   => '/html/notice/nleague1.asp?code=1&GotoPage=1',
    'news_law'           => '/html/notice/nlow.asp?GotoPage=1',
    'news_org'           => '/html/notice/norg.asp?GotoPage=1',
    'news_bid'           => '/html/notice/ntrnder.asp?GotoPage=1',
    'member_trend'       => '/html/notice/nwind.asp?GotoPage=1',
    'news_press'         => '/html/notice/nleague1.asp?code=2&GotoPage=1',
    'expert_column'      => '/html/cmdata/cmexpert.asp?GotoPage=1',
    'special_feature'    => '/html/cmdata/cmspeical.asp?GotoPage=1',
    'education_seminar'  => '/html/cmdata/cmsemina.asp?GotoPage=1',
    'research'           => '/html/cmdata/cmreport.asp?GotoPage=1',
    'etc_data'           => '/html/cmdata/cmetc.asp?GotoPage=1',
    'cm_case'            => '/html/cmdata/cmexample.asp?GotoPage=1',
    'cm_overseas'        => '/html/cmdata/cmglobal.asp?GotoPage=1',
    'free_board'         => '/html/free/freeboard.asp?GotoPage=1',
    'book_review'        => '/html/free/bookreview.asp?GotoPage=1',
    'wordbook'           => '/html/free/wordbook.asp?GotoPage=1',
    'faq'                => '/html/free/faq.asp?GotoPage=1',
    'job_offer'          => '/html/free/wanted.asp?GotoPage=1',
    'job_seek'           => '/html/free/hunting.asp?GotoPage=1',
    'herald'             => '/html/business/bcmhzine.asp?GotoPage=1',
];

$baseUrl = 'http://www.cmak.or.kr';

function fetchRaw(string $url): string
{
    $ch = curl_init();
    curl_setopt_array($ch, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 20,
        CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
        CURLOPT_HTTPHEADER => ['Accept-Language: ko-KR,ko;q=0.9'],
    ]);
    $html = curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    if ($code !== 200 || !$html) return '';
    return $html;
}

function extractTotal(string $html): ?int
{
    if (preg_match('/Total\s*:\s*([\d,]+)/i', $html, $m)) {
        return (int)str_replace(',', '', $m[1]);
    }
    // EUC-KR 페이지에서 "전체:1234" 등 다른 표기 탐색
    $utf = @mb_convert_encoding($html, 'UTF-8', 'EUC-KR') ?: $html;
    if (preg_match('/(?:전체|Total)\s*[:：]?\s*([\d,]+)/iu', $utf, $m)) {
        return (int)str_replace(',', '', $m[1]);
    }
    return null;
}

printf("%-20s %12s %12s %12s %s\n", 'board_type', '원본', 'DB', '차이', '상태');
echo str_repeat('-', 75) . "\n";

$totalOrig = 0; $totalDb = 0;
foreach ($boards as $key => $path) {
    $html = fetchRaw($baseUrl . $path);
    $orig = $html ? extractTotal($html) : null;
    $db   = Post::where('board_type', $key)->count();

    if ($orig === null) {
        printf("%-20s %12s %12d %12s  %s\n", $key, '접근불가', $db, '-', '?');
    } else {
        $diff = $db - $orig;
        $mark = $diff === 0 ? '✓ 일치' : ($diff > 0 ? '+ DB과다' : '- 누락');
        printf("%-20s %12d %12d %12d  %s\n", $key, $orig, $db, $diff, $mark);
        $totalOrig += $orig;
    }
    $totalDb += $db;
    usleep(150000);
}
echo str_repeat('-', 75) . "\n";
printf("%-20s %12d %12d %12d\n", 'TOTAL (확인분)', $totalOrig, $totalDb, $totalDb - $totalOrig);
