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

// File Upload (AJAX)
Route::post('files/upload', [FileUploadController::class, 'upload'])->name('admin.files.upload');
Route::delete('files/{attachment}', [FileUploadController::class, 'delete'])->name('admin.files.delete');

// Member Companies
Route::resource('member-companies', MemberCompanyController::class)->names('admin.member-companies');
Route::patch('member-companies/{member_company}/toggle-verify', [MemberCompanyController::class, 'toggleVerify'])->name('admin.member-companies.toggle-verify');
Route::patch('member-companies/{member_company}/toggle-active', [MemberCompanyController::class, 'toggleActive'])->name('admin.member-companies.toggle-active');

// Banners
Route::resource('banners', BannerController::class)->names('admin.banners');
Route::post('banners/update-order', [BannerController::class, 'updateOrder'])->name('admin.banners.update-order');

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

// English Contents (편집/삭제만 - 페이지 추가는 코드 작업 필요)
Route::resource('english-contents', EnglishContentController::class)
    ->only(['index', 'edit', 'update', 'destroy'])
    ->names('admin.english-contents');

// English Items (수정/삭제만 - 추가는 코드 작업 필요)
Route::put('english-contents/{englishContent}/items/{item}', [EnglishItemController::class, 'update'])->name('admin.english-items.update');
Route::delete('english-contents/{englishContent}/items/{item}', [EnglishItemController::class, 'destroy'])->name('admin.english-items.destroy');
