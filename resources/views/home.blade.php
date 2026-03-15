{{-- CMAK 메인 페이지 - fullpage 스냅 스크롤 --}}
@extends('layouts.app')

@section('title', '한국CM협회 - 건설사업관리의 미래를 선도합니다')

@php
    use App\Data\HomeData;
    $notices = HomeData::getNotices();
    $pressReleases = HomeData::getPressReleases();
    $bids = HomeData::getBids();
    $domesticNews = HomeData::getDomesticNews();
    $legalNews = HomeData::getLegalNews();
    $relatedOrgNews = HomeData::getRelatedOrgNews();
    $news = HomeData::getNews();
    $memberTrends = HomeData::getMemberTrends();
    $resources = HomeData::getCmResources();
@endphp

@section('content')

    {{-- 섹션 1: 메인 비주얼 --}}
    <section class="fp-section">
        @include('components.home.hero-section')
    </section>

    {{-- 섹션 2: 콘텐츠 + 푸터 --}}
    @php
        $sidebarAds = \App\Data\HomeData::getSidebarAds();
        $expertColumns = HomeData::getExpertColumns();
    @endphp
    <section class="fp-section">
        <div class="fp-section-inner">
            <div class="icak-content-section">

                {{-- 섹션 헤더 --}}
                <div class="icak-section-header">
                    <div class="icak-section-header-inner">
                        <div class="icak-section-header-line"></div>
                        <h2 class="icak-section-header-title">
                            <span>CMAK</span> NEWS & INFORMATION
                        </h2>
                        <p class="icak-section-header-sub">한국CM협회의 최신 소식과 정보를 확인하세요</p>
                    </div>
                </div>

                <div class="icak-content-with-sidebar">
                    {{-- 좌측: 기존 콘텐츠 영역 --}}
                    <div class="icak-content-inner">

                        {{-- ===== 1행: 소식 영역 ===== --}}
                        <div class="icak-row">
                            <div class="icak-block-left">
                                <div class="icak-grid4">
                                    <div class="icak-cell">
                                        <div class="icak-cell-title">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                            국내외소식
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($domesticNews, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/news/domestic" class="icak-cell-more">더보기 +</a>
                                    </div>
                                    <div class="icak-cell">
                                        <div class="icak-cell-title">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                            입찰소식
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($bids, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/bids" class="icak-cell-more">더보기 +</a>
                                    </div>
                                    <div class="icak-cell">
                                        <div class="icak-cell-title">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                            법령소식
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($legalNews, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/news/legal" class="icak-cell-more">더보기 +</a>
                                    </div>
                                    <div class="icak-cell">
                                        <div class="icak-cell-title">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                                            유관기관 소식
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($relatedOrgNews, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/news/org" class="icak-cell-more">더보기 +</a>
                                    </div>
                                </div>
                            </div>
                            <div class="icak-block-right">
                                <div class="icak-grid3">
                                    <a href="/cmak/business/education" class="icak-mini-card">
                                        <svg class="icak-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                        CM매뉴얼
                                    </a>
                                    <a href="/cmak/cmdata/book/1" class="icak-mini-card">
                                        <svg class="icak-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                        Book Review
                                    </a>
                                    <a href="/cmak/cmdata/wordbook/1" class="icak-mini-card">
                                        <svg class="icak-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                        Word Book
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- ===== 2행: 협회 영역 ===== --}}
                        <div class="icak-row">
                            <div class="icak-block-left">
                                <div class="icak-grid4">
                                    <div class="icak-cell icak-cell-alt">
                                        <div class="icak-cell-title icak-cell-title-alt">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                                            협회소식
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($news, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/news" class="icak-cell-more">더보기 +</a>
                                    </div>
                                    <div class="icak-cell icak-cell-alt">
                                        <div class="icak-cell-title icak-cell-title-alt">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 20H5a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v1m2 13a2 2 0 0 1-2-2V7m2 13a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-2"/></svg>
                                            보도자료
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($pressReleases, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/notice/press" class="icak-cell-more">더보기 +</a>
                                    </div>
                                    <div class="icak-cell icak-cell-alt">
                                        <div class="icak-cell-title icak-cell-title-alt">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="8.5" cy="7" r="4"/><line x1="20" y1="8" x2="20" y2="14"/><line x1="23" y1="11" x2="17" y2="11"/></svg>
                                            회원동향
                                        </div>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($memberTrends, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['company'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/news/member" class="icak-cell-more">더보기 +</a>
                                    </div>
                                    <div class="icak-cell icak-cell-alt">
                                        <div class="icak-cell-title icak-cell-title-alt">
                                            <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                                            인사·경조사
                                        </div>
                                        <ul class="icak-cell-list">
                                            <li><a href="/cmak/community/board/1">2026년 신년 인사</a></li>
                                            <li><a href="/cmak/community/board/2">제30회 정기총회 축하</a></li>
                                        </ul>
                                        <a href="/cmak/community/board" class="icak-cell-more">더보기 +</a>
                                    </div>
                                </div>
                            </div>
                            <div class="icak-block-right">
                                <div class="icak-grid3">
                                    <a href="/cmak/business/herald" class="icak-mini-card icak-mini-card-alt">
                                        <svg class="icak-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                                        CM헤럴드
                                    </a>
                                    <a href="/cmak/archive/cm" class="icak-mini-card icak-mini-card-alt">
                                        <svg class="icak-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                                        CM자료방
                                    </a>
                                    <a href="/cmak/intro/members" class="icak-mini-card icak-mini-card-alt">
                                        <svg class="icak-mini-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                        CM사 소개
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- ===== 3행: 전문가 칼럼 하이라이트 ===== --}}
                        <div class="icak-expert-bar">
                            <div class="icak-expert-bar-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg>
                                전문가 칼럼
                            </div>
                            <div class="icak-expert-bar-items" x-data="{ current: 0, total: {{ count($expertColumns) }} }" x-init="setInterval(() => current = (current + 1) % total, 4000)">
                                @foreach($expertColumns as $idx => $col)
                                    <a href="{{ $col['link'] }}" class="icak-expert-bar-item" x-show="current === {{ $idx }}" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
                                        {{ $col['title'] }}
                                    </a>
                                @endforeach
                            </div>
                            <a href="/cmak/cmdata/expert" class="icak-expert-bar-more">전체보기</a>
                        </div>

                    </div>

                    {{-- 우측: 세로 광고 사이드바 --}}
                    <div class="icak-sidebar-ads">
                        <div class="icak-sidebar-ads-title">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;display:inline-block;vertical-align:middle;margin-right:4px;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="9" y1="9" x2="15" y2="15"/><line x1="15" y1="9" x2="9" y2="15"/></svg>
                            AD
                        </div>
                        <div class="icak-sidebar-ads-list">
                            @foreach($sidebarAds as $ad)
                                <a href="{{ $ad['link'] }}" target="_blank" rel="noopener noreferrer" class="icak-sidebar-ad-item">
                                    <img src="{{ $ad['image'] }}" alt="{{ $ad['title'] }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <span class="icak-sidebar-ad-fallback" style="display:none;">{{ $ad['title'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- 푸터 --}}
            @include('components.footer')
        </div>
    </section>

@endsection
