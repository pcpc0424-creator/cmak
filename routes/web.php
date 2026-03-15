<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

// ============================================
// 협회소개
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
// 협회업무
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
// CM자료방
// ============================================
Route::get('/cmdata/about', fn() => view('cmdata.about'));
Route::get('/cmdata/law', fn() => view('cmdata.law'));
Route::get('/cmdata/report', fn() => view('cmdata.report'));
Route::get('/cmdata/global', fn() => view('cmdata.global'));
Route::get('/cmdata/case', fn() => view('cmdata.case'));
Route::get('/cmdata/seminar', fn() => view('cmdata.seminar'));
Route::get('/cmdata/expert', fn() => view('cmdata.expert'));
Route::get('/cmdata/special', fn() => view('cmdata.special'));
Route::get('/cmdata/etc', fn() => view('cmdata.etc'));
Route::get('/cmdata', fn() => redirect('cmdata/about'));

// ============================================
// 알림마당
// ============================================
Route::get('/notice/news', fn() => view('notice.news'));
Route::get('/notice/bids', fn() => view('notice.bids'));
Route::get('/notice/law', fn() => view('notice.law'));
Route::get('/notice/association', fn() => view('notice.association'));
Route::get('/notice/member', fn() => view('notice.member'));
Route::get('/notice/org', fn() => view('notice.org'));
Route::get('/notice/press', fn() => view('notice.press'));
Route::get('/notice', fn() => redirect('notice/news'));

// ============================================
// 참여마당
// ============================================
Route::get('/community/faq', fn() => view('community.faq'));
Route::get('/community/board', fn() => view('community.board'));
Route::get('/community/bookreview', fn() => view('community.bookreview'));
Route::get('/community/wordbook', fn() => view('community.wordbook'));
Route::get('/community/jobs', fn() => view('community.jobs'));
Route::get('/community', fn() => redirect('community/faq'));

// ============================================
// 관련사이트
// ============================================
Route::get('/reference/domestic', fn() => view('reference.domestic'));
Route::get('/reference/overseas', fn() => view('reference.overseas'));
Route::get('/reference/media', fn() => view('reference.media'));
Route::get('/reference/bidding', fn() => view('reference.bidding'));
Route::get('/reference', fn() => redirect('reference/domestic'));
