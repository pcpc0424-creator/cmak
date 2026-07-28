<?php

use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\BusinessPageController;
use App\Http\Controllers\Auth\AccountRecoveryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HeraldController;
use App\Http\Controllers\MemberPostController;
use App\Http\Controllers\MypageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// 에디터 단독 업로드 첨부 공개 다운로드 (원본 한글 파일명 유지)
Route::get('/file/{attachment}/download', [FileUploadController::class, 'download'])->name('file.download');

// 회원 로그인 / 회원가입 (공개)
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/register/check-username', [RegisterController::class, 'checkUsername']);

// 아이디 찾기 / 비밀번호 재설정 (공개)
Route::get('/find-username', [AccountRecoveryController::class, 'showFindUsername'])->name('find-username');
Route::post('/find-username', [AccountRecoveryController::class, 'findUsername']);
Route::get('/reset-password', [AccountRecoveryController::class, 'showResetPassword'])->name('reset-password');
Route::post('/reset-password', [AccountRecoveryController::class, 'resetPassword']);

// 마이페이지 & 회원 글쓰기 (로그인 필요)
Route::middleware('auth')->group(function () {
    // 마이페이지
    Route::get('/mypage', [MypageController::class, 'index'])->name('mypage');
    Route::get('/mypage/profile', [MypageController::class, 'editProfile'])->name('mypage.profile');
    Route::put('/mypage/profile', [MypageController::class, 'updateProfile']);
    Route::get('/mypage/password', [MypageController::class, 'editPassword'])->name('mypage.password');
    Route::put('/mypage/password', [MypageController::class, 'updatePassword']);
    Route::get('/mypage/posts', [MypageController::class, 'myPosts'])->name('mypage.posts');
    Route::get('/mypage/withdraw', [MypageController::class, 'editWithdraw'])->name('mypage.withdraw');
    Route::delete('/mypage/withdraw', [MypageController::class, 'withdraw']);

    // 회원 글쓰기 (구인/구직)
    Route::get('/community/{slug}/write', [MemberPostController::class, 'create'])
        ->whereIn('slug', ['job-offer', 'job-seek'])->name('member.post.create');
    Route::post('/community/{slug}/write', [MemberPostController::class, 'store'])
        ->whereIn('slug', ['job-offer', 'job-seek']);
    Route::get('/board/{boardType}/{post}/edit', [MemberPostController::class, 'edit'])
        ->whereIn('boardType', ['job_offer', 'job_seek'])->name('member.post.edit');
    Route::put('/board/{boardType}/{post}', [MemberPostController::class, 'update'])
        ->whereIn('boardType', ['job_offer', 'job_seek']);
    Route::delete('/board/{boardType}/{post}', [MemberPostController::class, 'destroy'])
        ->whereIn('boardType', ['job_offer', 'job_seek']);
    Route::delete('/board/{boardType}/{post}/attachments/{attachment}', [MemberPostController::class, 'destroyAttachment'])
        ->whereIn('boardType', ['job_offer', 'job_seek']);
});

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
Route::get('/intro/greeting', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('greeting'));
Route::get('/intro/about', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('about'));
Route::get('/intro/members', function(\Illuminate\Http\Request $r) {
    $q = \App\Models\MemberCompany::query()->active();

    $search = trim($r->get('q', ''));
    $searchType = $r->get('search_type', '');
    $initial = $r->get('initial', '');

    if ($searchType === '용역') {
        // 구분(용역)만으로도 필터 — 검색어는 있으면 회사명 추가 조건
        $q->where('company_type', '용역');
        if ($search !== '') $q->where('company_name', 'like', "%{$search}%");
    } elseif ($searchType === '시공') {
        $q->where('company_type', '시공');
        if ($search !== '') $q->where('company_name', 'like', "%{$search}%");
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
Route::get('/intro/departments', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('departments'));
Route::get('/intro/articles', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('articles'));
Route::get('/intro/location', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('location'));
Route::get('/intro/history', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('history'));
Route::get('/intro/organization', [\App\Http\Controllers\OrganizationPageController::class, 'show']);
Route::get('/intro/organization/{tab}', [\App\Http\Controllers\OrganizationPageController::class, 'show'])
    ->whereIn('tab', ['chart', 'executives', 'branches', 'committees']);
Route::get('/intro/presidents', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('presidents'));
Route::get('/intro/plan', fn() => app(\App\Http\Controllers\IntroPageController::class)->show('plan'));
Route::get('/intro', fn() => redirect('intro/greeting'));

// ============================================
// 협회업무 (DB 편집형 페이지 - page_contents / 관리자에서 수정)
//   내용이 없으면 기존 정적 블레이드로 자동 폴백 (BusinessPageController)
// ============================================
Route::get('/business/membership', [BusinessPageController::class, 'show'])->defaults('slug', 'membership');
Route::get('/business/certification', [BusinessPageController::class, 'show'])->defaults('slug', 'certification');
Route::get('/business/confirm', [BusinessPageController::class, 'show'])->defaults('slug', 'confirm');
// CM 실적 관리 페이지 통합: 기존 confirm-online → confirm 으로 리다이렉트
Route::get('/business/confirm-online', fn() => redirect('/cmak/business/confirm'));
Route::get('/business/inspection', [BusinessPageController::class, 'show'])->defaults('slug', 'inspection');
Route::get('/business/education', [BusinessPageController::class, 'show'])->defaults('slug', 'education');
// CM Herald — 로그인 회원만 열람 (책장형 표지 + 웹진보기)
Route::get('/business/herald', [HeraldController::class, 'index'])->middleware('auth');
Route::get('/business/consma', [\App\Http\Controllers\ConsmaController::class, 'index']);
Route::get('/business/consma/{year}', [\App\Http\Controllers\ConsmaController::class, 'show'])->where('year', '[0-9]{4}');
Route::get('/business/slogan', [BusinessPageController::class, 'show'])->defaults('slug', 'slogan');
Route::get('/business/cm-forms', fn(\Illuminate\Http\Request $r) => app(BoardController::class)->index($r, 'cm_forms', 'business.cm-forms'));
Route::get('/business', fn() => redirect('business/membership'));

// 윈도우형 팝업 전용 창(window.open 대상)
Route::get('/popup/{popup}/window', function (\App\Models\Popup $popup) {
    abort_unless($popup->is_active, 404);
    return view('popup-window', compact('popup'));
})->whereNumber('popup');

// ============================================
// 온라인 접수 (행사 신청) — 전용 상단 메뉴
// ============================================
Route::get('/reception', [\App\Http\Controllers\ReceptionController::class, 'index']);
Route::get('/reception/{slug}', [\App\Http\Controllers\ReceptionController::class, 'show']);
Route::post('/reception/{slug}', [\App\Http\Controllers\ReceptionController::class, 'store']);

// ============================================
// CM30년 (완전 별도 독립 게시판) — 상단 POPUP 'CM30년' 전용, 타 메뉴 미연결
// ============================================
Route::get('/cm30', fn(\Illuminate\Http\Request $r) => app(BoardController::class)->index($r, 'cm30', 'cm30.index'));

// ============================================
// CM자료방 (DB 연동 게시판)
// ============================================
// CM이란 - 정적 페이지
Route::get('/cmdata/about', fn() => app(\App\Http\Controllers\CmDataPageController::class)->show('about'));
Route::get('/cmdata/procedure', fn() => app(\App\Http\Controllers\CmDataPageController::class)->show('procedure'));
Route::get('/cmdata/task-spec', fn() => app(\App\Http\Controllers\CmDataPageController::class)->show('task-spec'));
Route::get('/cmdata/contract', fn() => app(\App\Http\Controllers\CmDataPageController::class)->show('contract'));

// 법령정보 조회 - 국가법령정보센터 안내 정적 페이지
Route::get('/cmdata/law', fn() => app(\App\Http\Controllers\CmDataPageController::class)->show('law'));

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
Route::get('/privacy', function () {
    $page = \App\Models\PageContent::bySlug('privacy');
    return $page ? view('privacy-dynamic', compact('page')) : view('privacy');
});

// ============================================
// English pages
// ============================================
Route::prefix('eng')->group(function () {
    Route::get('/', fn() => view('eng.home'));

    // About CMAK
    Route::get('/about/greeting',     fn() => app(\App\Http\Controllers\EngPageController::class)->show('about', 'greeting'));
    Route::get('/about/purpose',      fn() => app(\App\Http\Controllers\EngPageController::class)->show('about', 'purpose'));
    Route::get('/about/history',      fn() => app(\App\Http\Controllers\EngPageController::class)->show('about', 'history'));
    Route::get('/about/organization', fn() => app(\App\Http\Controllers\EngPageController::class)->show('about', 'organization'));
    Route::get('/about/scheme',       fn() => app(\App\Http\Controllers\EngPageController::class)->show('about', 'scheme'));
    Route::get('/about/contact',      fn() => app(\App\Http\Controllers\EngPageController::class)->show('about', 'contact'));
    Route::get('/about/qna',          fn() => view('eng.about.qna'));
    Route::get('/about',              fn() => redirect('eng/about/greeting'));

    // International CM Day
    Route::get('/cmday/introduction', fn() => app(\App\Http\Controllers\EngPageController::class)->show('cmday', 'introduction'));
    Route::get('/cmday/members',      fn() => app(\App\Http\Controllers\EngPageController::class)->show('cmday', 'members'));
    Route::get('/cmday/celebrations', fn() => view('eng.cmday.celebrations'));
    Route::get('/cmday/registration', fn() => app(\App\Http\Controllers\EngPageController::class)->show('cmday', 'registration'));
    Route::get('/cmday',              fn() => redirect('eng/cmday/introduction'));

    // IPMA Korea
    Route::get('/ipma/about',         fn() => app(\App\Http\Controllers\EngPageController::class)->show('ipma', 'about'));
    Route::get('/ipma/certification', fn() => app(\App\Http\Controllers\EngPageController::class)->show('ipma', 'certification'));
    Route::get('/ipma/education',     fn() => app(\App\Http\Controllers\EngPageController::class)->show('ipma', 'education'));
    Route::get('/ipma/news',          fn() => view('eng.ipma.news'));
    Route::get('/ipma/membership',    fn() => app(\App\Http\Controllers\EngPageController::class)->show('ipma', 'membership'));
    Route::get('/ipma/resources',     fn() => app(\App\Http\Controllers\EngPageController::class)->show('ipma', 'resources'));
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
