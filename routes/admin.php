<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\MemberCompanyController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\RelatedSiteController;
use App\Http\Controllers\Admin\OnlineApplicationController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\EnglishContentController;
use App\Http\Controllers\Admin\EnglishItemController;
use App\Http\Controllers\Admin\PageContentController;
use App\Http\Controllers\Admin\HeroSlideController;
use App\Http\Controllers\Admin\TopPopupItemController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\HeraldIssueController;
use App\Http\Controllers\Admin\HomeCardController;

// Auth (no admin middleware)
Route::withoutMiddleware('admin')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login'])->name('admin.login.post');
});
Route::post('logout', [AuthController::class, 'logout'])->name('admin.logout');

// Dashboard
Route::get('/', fn() => redirect()->route('admin.dashboard'));
Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

// Posts (board_type parameter)
Route::get('posts/{boardType}', [PostController::class, 'index'])->name('admin.posts.index');
Route::get('posts/{boardType}/create', [PostController::class, 'create'])->name('admin.posts.create');
Route::post('posts/{boardType}', [PostController::class, 'store'])->name('admin.posts.store');
Route::get('posts/{boardType}/{post}/edit', [PostController::class, 'edit'])->name('admin.posts.edit');
Route::put('posts/{boardType}/{post}', [PostController::class, 'update'])->name('admin.posts.update');
Route::delete('posts/{boardType}/{post}', [PostController::class, 'destroy'])->name('admin.posts.destroy');
Route::delete('posts/{boardType}/{post}/attachments/{attachment}', [PostController::class, 'destroyAttachment'])->name('admin.posts.destroy-attachment');

// File Upload (AJAX)
Route::post('files/upload', [FileUploadController::class, 'upload'])->name('admin.files.upload');
Route::delete('files/{attachment}', [FileUploadController::class, 'delete'])->name('admin.files.delete');

// Member Companies
Route::get('member-companies/export', [MemberCompanyController::class, 'export'])->name('admin.member-companies.export');
Route::resource('member-companies', MemberCompanyController::class)->names('admin.member-companies');
Route::patch('member-companies/{member_company}/toggle-verify', [MemberCompanyController::class, 'toggleVerify'])->name('admin.member-companies.toggle-verify');
Route::patch('member-companies/{member_company}/toggle-active', [MemberCompanyController::class, 'toggleActive'])->name('admin.member-companies.toggle-active');

// Banners
Route::resource('banners', BannerController::class)->names('admin.banners');
Route::post('banners/update-order', [BannerController::class, 'updateOrder'])->name('admin.banners.update-order');

// Hero Slides (메인 히어로 슬라이드)
Route::post('hero-slides/update-order', [HeroSlideController::class, 'updateOrder'])->name('admin.hero-slides.update-order');
Route::resource('hero-slides', HeroSlideController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->names('admin.hero-slides');

// Top Popup Items (상단 POPUP 버튼)
Route::resource('top-popup-items', TopPopupItemController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->names('admin.top-popup-items');

// CM Herald 소식지 (호수 관리)
Route::resource('herald-issues', HeraldIssueController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->names('admin.herald-issues');

// 메인 바로가기 카드 (우측 6개 카드)
Route::resource('home-cards', HomeCardController::class)
    ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
    ->names('admin.home-cards');

// Popups
Route::resource('popups', PopupController::class)->names('admin.popups');
Route::patch('popups/{popup}/toggle-active', [PopupController::class, 'toggleActive'])->name('admin.popups.toggle-active');
Route::get('popups/{popup}/preview', [PopupController::class, 'preview'])->name('admin.popups.preview');

// Related Sites
Route::resource('related-sites', RelatedSiteController::class)->names('admin.related-sites');

// Online Applications
Route::resource('online-applications', OnlineApplicationController::class)->names('admin.online-applications');
Route::get('online-applications/{online_application}/entries', [OnlineApplicationController::class, 'entries'])->name('admin.online-applications.entries');
Route::post('online-applications/{online_application}/entries', [OnlineApplicationController::class, 'storeEntry'])->name('admin.online-applications.store-entry');

// Accounts (admin only)
Route::resource('accounts', AccountController::class)->names('admin.accounts');

// Members (회원관리 - 가입 회원 조회 + 등급 조정 + 가입승인 + CSV)
Route::get('members', [MemberController::class, 'index'])->name('admin.members.index');
Route::get('members/export', [MemberController::class, 'export'])->name('admin.members.export');
Route::get('members/{member}/edit', [MemberController::class, 'edit'])->name('admin.members.edit');
Route::put('members/{member}', [MemberController::class, 'update'])->name('admin.members.update');
Route::patch('members/{member}/approve', [MemberController::class, 'approve'])->name('admin.members.approve');
Route::patch('members/{member}/reject', [MemberController::class, 'reject'])->name('admin.members.reject');

// Page Contents (협회업무 등 정적 페이지 편집 - 편집만, 추가/삭제는 코드 작업)
Route::get('page-contents', [PageContentController::class, 'index'])->name('admin.page-contents.index');
Route::get('page-contents/{pageContent}/edit', [PageContentController::class, 'edit'])->name('admin.page-contents.edit');
Route::put('page-contents/{pageContent}', [PageContentController::class, 'update'])->name('admin.page-contents.update');

// English Contents (편집/삭제만 - 페이지 추가는 코드 작업 필요)
Route::resource('english-contents', EnglishContentController::class)
    ->only(['index', 'edit', 'update', 'destroy'])
    ->names('admin.english-contents');

// English Items (수정/삭제만 - 추가는 코드 작업 필요)
Route::put('english-contents/{englishContent}/items/{item}', [EnglishItemController::class, 'update'])->name('admin.english-items.update');
Route::delete('english-contents/{englishContent}/items/{item}', [EnglishItemController::class, 'destroy'])->name('admin.english-items.destroy');
