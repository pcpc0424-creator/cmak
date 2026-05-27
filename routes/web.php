<?php

use App\Http\Controllers\BoardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/login', fn() => view('login'));

// ============================================
// 통합 검색 - 게시글 title/content 검색
// ============================================
Route::get('/search', function (\Illuminate\Http\Request $r) {
    $q = trim((string) $r->get('q', ''));
    $results = collect();
    if ($q !== '') {
        $results = \App\Models\Post::where('is_published', 1)
            ->whereNull('deleted_at')
            ->where(function ($w) use ($q) {
                $w->where('title', 'like', "%{$q}%")
                  ->orWhere('content', 'like', "%{$q}%");
            })
            ->orderByDesc('published_at')
            ->paginate(20)
            ->withQueryString();
    }
    return view('search.index', ['q' => $q, 'results' => $results]);
});

// ============================================
// 협회소개 (정적 페이지)
// ============================================
Route::get('/intro/greeting', fn() => view('intro.greeting'));
Route::get('/intro/about', fn() => view('intro.about'));
Route::get('/intro/members', function(\Illuminate\Http\Request $r) {
    $q = \App\Models\MemberCompany::query()->active();

    $search = trim($r->get('q', ''));
    $searchType = $r->get('search_type', '');
    $initial = $r->get('initial', '');

    if ($searchType === '용역' && $search !== '') {
        $q->where('company_type', '용역')->where('company_name', 'like', "%{$search}%");
    } elseif ($searchType === '시공' && $search !== '') {
        $q->where('company_type', '시공')->where('company_name', 'like', "%{$search}%");
    } elseif ($searchType === '회사명' && $search !== '') {
        $q->where('company_name', 'like', "%{$search}%");
    } elseif ($searchType === '주소' && $search !== '') {
        $q->where('address', 'like', "%{$search}%");
    } elseif ($search !== '') {
        $q->where('company_name', 'like', "%{$search}%");
    }

    if ($initial !== '') {
        $cho = ['ㄱ','ㄲ','ㄴ','ㄷ','ㄸ','ㄹ','ㅁ','ㅂ','ㅃ','ㅅ','ㅆ','ㅇ','ㅈ','ㅉ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ'];
        $matchedIds = [];
        foreach ($q->clone()->select('id', 'company_name')->cursor() as $row) {
            // ㈜, (주), 주식회사 등 회사 형태 표기 제거
            $name = preg_replace('/^[\s\(\)\[\]㈜주\.\-_]+/u', '', $row->company_name);
            $name = preg_replace('/^주식회사\s*/u', '', $name);
            $first = mb_substr($name, 0, 1, 'UTF-8');
            $code = mb_ord($first, 'UTF-8');
            if ($code >= 0xAC00 && $code <= 0xD7A3) {
                $choIdx = (int)(($code - 0xAC00) / 588);
                if (isset($cho[$choIdx]) && $cho[$choIdx] === $initial) {
                    $matchedIds[] = $row->id;
                }
            }
        }
        $q->whereIn('id', $matchedIds ?: [0]);
    }

    $members = $q->orderBy('company_name')->paginate(30)->withQueryString();

    return view('intro.members', [
        'members' => $members,
        'search' => $search,
        'searchType' => $searchType,
        'selectedInitial' => $initial,
    ]);
});
Route::get('/intro/departments', fn() => view('intro.departments'));
Route::get('/intro/articles', fn() => view('intro.articles'));
Route::get('/intro/location', fn() => view('intro.location'));
Route::get('/intro/history', fn() => view('intro.history'));
Route::get('/intro/organization', fn() => view('intro.organization'));
Route::get('/intro/presidents', fn() => view('intro.presidents'));
Route::get('/intro/plan', fn() => view('intro.plan'));
Route::get('/intro', fn() => redirect('intro/greeting'));

// ============================================
// 협회업무 (정적 페이지)
// ============================================
Route::get('/business/membership', fn() => view('business.membership'));
Route::get('/business/certification', fn() => view('business.certification'));
Route::get('/business/confirm', fn() => view('business.confirm'));
// CM 실적 관리 페이지 통합: 기존 confirm-online → confirm 으로 리다이렉트
Route::get('/business/confirm-online', fn() => redirect('/cmak/business/confirm'));
Route::get('/business/inspection', fn() => view('business.inspection'));
Route::get('/business/education', fn() => view('business.education'));
Route::get('/business/herald', fn() => view('business.herald'));
Route::get('/business/consma', fn() => view('business.consma'));
Route::get('/business/slogan', fn() => view('business.slogan'));
Route::get('/business/cm-forms', fn(\Illuminate\Http\Request $r) => app(BoardController::class)->index($r, 'cm_forms', 'business.cm-forms'));
Route::get('/business', fn() => redirect('business/membership'));

// ============================================
// CM자료방 (DB 연동 게시판)
// ============================================
// CM이란 - 정적 페이지
Route::get('/cmdata/about', fn() => view('cmdata.about'));
Route::get('/cmdata/procedure', fn() => view('cmdata.procedure'));
Route::get('/cmdata/task-spec', fn() => view('cmdata.task-spec'));
Route::get('/cmdata/contract', fn() => view('cmdata.contract'));

// 법령정보 조회 - 국가법령정보센터 안내 정적 페이지
Route::get('/cmdata/law', fn() => view('cmdata.law'));

// DB 연동 게시판들
$cmdataBoards = [
    'report'    => 'research',
    'overseas'  => 'cm_overseas',
    'case'      => 'cm_case',
    'seminar'   => 'education_seminar',
    'expert'    => 'expert_column',
    'special'   => 'special_feature',
    'etc'       => 'etc_data',
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
    'index'       => 'news_association',
    'association' => 'news_association',
    'press'       => 'news_press',
    'member'      => 'member_trend',
    'org'         => 'news_org',
    'personnel'   => 'news_personnel',
    'wordbook'    => 'wordbook',
    'bookreview'  => 'book_review',
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
Route::get('/reference/domestic', fn() => view('reference.domestic', ['sites' => \App\Models\RelatedSite::active()->ofType('domestic')->orderBy('sort_order')->get()]));
Route::get('/reference/overseas', fn() => view('reference.overseas', ['sites' => \App\Models\RelatedSite::active()->ofType('international')->orderBy('sort_order')->get()]));
Route::get('/reference/media', fn() => view('reference.media', ['sites' => \App\Models\RelatedSite::active()->ofType('media')->orderBy('sort_order')->get()]));
Route::get('/reference/bidding', fn() => view('reference.bidding', ['sites' => \App\Models\RelatedSite::active()->ofType('government')->orderBy('sort_order')->get()]));
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
    Route::get('/about/qna',          fn() => view('eng.about.qna'));
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
