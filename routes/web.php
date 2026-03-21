<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// ============================================
// 협회소개 (정적 페이지)
// ============================================
Route::get('/intro/greeting', fn() => view('intro.greeting'));
Route::get('/intro/about', fn() => view('intro.about'));
Route::get('/intro/members', fn() => view('intro.members'));
Route::get('/intro/departments', fn() => view('intro.departments'));
Route::get('/intro/articles', fn() => view('intro.articles'));
Route::get('/intro/location', fn() => view('intro.location'));
Route::get('/intro/history', fn() => view('intro.history'));
Route::get('/intro/organization', fn() => view('intro.organization'));
Route::get('/intro', fn() => redirect('intro/greeting'));

// ============================================
// 협회업무 (정적 페이지)
// ============================================
Route::get('/business/membership', fn() => view('business.membership'));
Route::get('/business/certification', fn() => view('business.certification'));
Route::get('/business/confirm', fn() => view('business.confirm'));
Route::get('/business/confirm-online', fn() => view('business.confirm-online'));
Route::get('/business/inspection', fn() => view('business.inspection'));
Route::get('/business/education', fn() => view('business.education'));
Route::get('/business/herald', fn() => view('business.herald'));
Route::get('/business/consma', fn() => view('business.consma'));
Route::get('/business', fn() => redirect('business/membership'));

// ============================================
// CM자료방 (DB 연동 게시판)
// ============================================
// CM이란 - 정적 페이지
Route::get('/cmdata/about', fn() => view('cmdata.about'));

// DB 연동 게시판들
$cmdataBoards = [
    'report'    => 'research',
    'law'       => 'cm_law',
    'seminar'   => 'education_seminar',
    've'        => 've',
    'expert'    => 'expert_column',
    'special'   => 'special_feature',
    'etc'       => 'etc_data',
    'press'     => 'press',
    'case'      => 'cm_case',
    'education' => 'education',
];
foreach ($cmdataBoards as $slug => $boardType) {
    Route::get("/cmdata/{$slug}", fn(\Illuminate\Http\Request $r) => app(BoardController::class)->index($r, $boardType, "cmdata.{$slug}"));
}
Route::get('/cmdata', fn() => redirect('cmdata/about'));

// ============================================
// 알림마당 (DB 연동 게시판)
// ============================================
$noticeBoards = [
    'news'        => 'news_domestic',
    'bids'        => 'news_bid',
    'law'         => 'news_law',
    'association' => 'news_association',
    'press'       => 'news_press',
    'member'      => 'member_trend',
    'org'         => 'news_bid',
    'online'      => 'online_news',
    'schedule'    => 'schedule',
];
foreach ($noticeBoards as $slug => $boardType) {
    Route::get("/notice/{$slug}", fn(\Illuminate\Http\Request $r) => app(BoardController::class)->index($r, $boardType, "notice.{$slug}"));
}
Route::get('/notice', fn() => redirect('notice/news'));

// ============================================
// 참여마당 (DB 연동 게시판)
// ============================================
$communityBoards = [
    'faq'        => 'faq',
    'board'      => 'free_board',
    'survey'     => 'survey',
    'bookreview' => 'book_review',
    'wordbook'   => 'wordbook',
    'gallery'    => 'gallery',
    'job-offer'  => 'job_offer',
    'job-seek'   => 'job_seek',
];
foreach ($communityBoards as $slug => $boardType) {
    Route::get("/community/{$slug}", fn(\Illuminate\Http\Request $r) => app(BoardController::class)->index($r, $boardType, "community.{$slug}"));
}
Route::get('/community', fn() => redirect('community/faq'));

// ============================================
// 게시글 상세 보기
// ============================================
Route::get('/board/{boardType}/{id}', [BoardController::class, 'show'])->where('id', '[0-9]+');

// ============================================
// 관련사이트 (정적 페이지)
// ============================================
Route::get('/reference/domestic', fn() => view('reference.domestic'));
Route::get('/reference/overseas', fn() => view('reference.overseas'));
Route::get('/reference/media', fn() => view('reference.media'));
Route::get('/reference/bidding', fn() => view('reference.bidding'));
Route::get('/reference', fn() => redirect('reference/domestic'));

// ============================================
// 기타
// ============================================
Route::get('/privacy', fn() => view('privacy'));

// ============================================
// 관리자 페이지
// ============================================
Route::prefix('admin')->middleware(['admin'])->group(base_path('routes/admin.php'));
