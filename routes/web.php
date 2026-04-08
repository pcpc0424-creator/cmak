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
// English pages
// ============================================
Route::prefix('eng')->group(function () {
    Route::get('/', fn() => view('eng.home'));

    // About CMAK
    Route::get('/about/greeting',     fn() => view('eng.about.greeting'));
    Route::get('/about/purpose',      fn() => view('eng.about.purpose'));
    Route::get('/about/history',      fn() => view('eng.about.history'));
    Route::get('/about/organization', fn() => view('eng.about.organization'));
    Route::get('/about/scheme',       fn() => view('eng.about.scheme'));
    Route::get('/about/contact',      fn() => view('eng.about.contact'));
    Route::get('/about',              fn() => redirect('eng/about/greeting'));

    // International CM Day
    Route::get('/cmday/introduction', fn() => view('eng.cmday.introduction'));
    Route::get('/cmday/members',      fn() => view('eng.cmday.members'));
    Route::get('/cmday/celebrations', fn() => view('eng.cmday.celebrations'));
    Route::get('/cmday/registration', fn() => view('eng.cmday.registration'));
    Route::get('/cmday',              fn() => redirect('eng/cmday/introduction'));

    // IPMA Korea
    Route::get('/ipma/about',         fn() => view('eng.ipma.about'));
    Route::get('/ipma/certification', fn() => view('eng.ipma.certification'));
    Route::get('/ipma/education',     fn() => view('eng.ipma.education'));
    Route::get('/ipma/news',          fn() => view('eng.ipma.news'));
    Route::get('/ipma/membership',    fn() => view('eng.ipma.membership'));
    Route::get('/ipma/resources',     fn() => view('eng.ipma.resources'));
    Route::get('/ipma',               fn() => redirect('eng/ipma/about'));

    // CMAK News
    Route::get('/news/publications', fn() => view('eng.news.publications'));
    Route::get('/news/seminars',     fn() => view('eng.news.seminars'));
    Route::get('/news/conferences',  fn() => view('eng.news.conferences'));
    Route::get('/news',              fn() => redirect('eng/news/publications'));

    // Membership
    Route::get('/membership', fn() => view('eng.membership'));
});

// ============================================
// 관리자 페이지
// ============================================
Route::prefix('admin')->middleware(['admin'])->group(base_path('routes/admin.php'));
