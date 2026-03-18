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
    $personnelEvents = HomeData::getPersonnelEvents();
    $governmentLinks = HomeData::getGovernmentLinks();
    $partnerBanners = HomeData::getPartnerBanners();
@endphp

@section('content')

    {{-- 섹션 1: 메인 비주얼 --}}
    <section class="fp-section">
        @include('components.home.hero-section')
    </section>

    {{-- 섹션 2: 콘텐츠 + 푸터 --}}
    @php
        $expertColumns = HomeData::getExpertColumns();
        $today = date('Y-m-d');
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

                <div class="icak-content-main">
                    {{-- 좌측: 콘텐츠 영역 --}}
                    <div class="icak-content-left">

                        {{-- ===== 1행: 공지사항 / 입찰소식 / 법령소식 (3셀) ===== --}}
                        <div class="icak-grid3-row">
                            <div class="icak-cell">
                                <div class="icak-cell-title">
                                    <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                                    공지사항
                                </div>
                                <ul class="icak-cell-list">
                                    @foreach(array_slice($notices, 0, 4) as $item)
                                        <li>
                                            <a href="{{ $item['link'] }}">
                                                {{ $item['title'] }}
                                                @if(isset($item['date']) && (strtotime($today) - strtotime($item['date'])) < 86400 * 2)
                                                    <span class="icak-new-badge">N</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="/cmak/notice" class="icak-cell-more">더보기 +</a>
                            </div>
                            <div class="icak-cell">
                                <div class="icak-cell-title">
                                    <svg class="icak-cell-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
                                    입찰소식
                                </div>
                                <ul class="icak-cell-list">
                                    @foreach(array_slice($bids, 0, 4) as $item)
                                        <li>
                                            <a href="{{ $item['link'] }}">
                                                {{ $item['title'] }}
                                                @if(isset($item['date']) && (strtotime($today) - strtotime($item['date'])) < 86400 * 2)
                                                    <span class="icak-new-badge">N</span>
                                                @endif
                                            </a>
                                        </li>
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
                                        <li>
                                            <a href="{{ $item['link'] }}">
                                                {{ $item['title'] }}
                                                @if(isset($item['date']) && (strtotime($today) - strtotime($item['date'])) < 86400 * 2)
                                                    <span class="icak-new-badge">N</span>
                                                @endif
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="/cmak/news/legal" class="icak-cell-more">더보기 +</a>
                            </div>
                        </div>

                        {{-- ===== 2행: 6개 탭 전환 ===== --}}
                        <div class="icak-tabs-section" x-data="{ activeTab: 'domestic' }">
                            <div class="icak-tabs-header">
                                <button class="icak-tab-btn" :class="{ 'active': activeTab === 'domestic' }" @click="activeTab = 'domestic'">국내외소식</button>
                                <button class="icak-tab-btn" :class="{ 'active': activeTab === 'member' }" @click="activeTab = 'member'">회원동향</button>
                                <button class="icak-tab-btn" :class="{ 'active': activeTab === 'org' }" @click="activeTab = 'org'">유관기관</button>
                                <button class="icak-tab-btn" :class="{ 'active': activeTab === 'personnel' }" @click="activeTab = 'personnel'">인사경조사</button>
                                <button class="icak-tab-btn" :class="{ 'active': activeTab === 'column' }" @click="activeTab = 'column'">전문가 칼럼</button>
                                <button class="icak-tab-btn" :class="{ 'active': activeTab === 'press' }" @click="activeTab = 'press'">보도자료</button>
                            </div>
                            <div class="icak-tabs-body">
                                {{-- 국내외소식 --}}
                                <div x-show="activeTab === 'domestic'" x-transition>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($domesticNews, 0, 4) as $item)
                                            <li>
                                                <a href="{{ $item['link'] }}">
                                                    {{ $item['title'] }}
                                                    @if(isset($item['date']) && (strtotime($today) - strtotime($item['date'])) < 86400 * 2)
                                                        <span class="icak-new-badge">N</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="/cmak/news/domestic" class="icak-cell-more">더보기 +</a>
                                </div>
                                {{-- 회원동향 --}}
                                <div x-show="activeTab === 'member'" x-transition>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($memberTrends, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['company'] }} - {{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                    <a href="/cmak/news/member" class="icak-cell-more">더보기 +</a>
                                </div>
                                {{-- 유관기관 --}}
                                <div x-show="activeTab === 'org'" x-transition>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($relatedOrgNews, 0, 4) as $item)
                                            <li>
                                                <a href="{{ $item['link'] }}">
                                                    {{ $item['title'] }}
                                                    @if(isset($item['date']) && (strtotime($today) - strtotime($item['date'])) < 86400 * 2)
                                                        <span class="icak-new-badge">N</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="/cmak/news/org" class="icak-cell-more">더보기 +</a>
                                </div>
                                {{-- 인사경조사 --}}
                                <div x-show="activeTab === 'personnel'" x-transition>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($personnelEvents, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                    <a href="/cmak/community/board" class="icak-cell-more">더보기 +</a>
                                </div>
                                {{-- 전문가 칼럼 --}}
                                <div x-show="activeTab === 'column'" x-transition>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($expertColumns, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                    <a href="/cmak/cmdata/expert" class="icak-cell-more">더보기 +</a>
                                </div>
                                {{-- 보도자료 --}}
                                <div x-show="activeTab === 'press'" x-transition>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($pressReleases, 0, 4) as $item)
                                            <li>
                                                <a href="{{ $item['link'] }}">
                                                    {{ $item['title'] }}
                                                    @if(isset($item['date']) && (strtotime($today) - strtotime($item['date'])) < 86400 * 2)
                                                        <span class="icak-new-badge">N</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <a href="/cmak/notice/press" class="icak-cell-more">더보기 +</a>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- 우측: 이미지 카드 6개 (2x3 그리드) --}}
                    <div class="icak-content-right">
                        <div class="icak-image-cards">
                            <a href="/cmak/business/education" class="icak-image-card">
                                <div class="icak-image-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/></svg>
                                </div>
                                <div class="icak-image-card-text">
                                    <strong>CM매뉴얼</strong>
                                    <span>CM 업무 가이드</span>
                                </div>
                            </a>
                            <a href="/cmak/cmdata/book/1" class="icak-image-card">
                                <div class="icak-image-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                                </div>
                                <div class="icak-image-card-text">
                                    <strong>Book Review</strong>
                                    <span>추천 도서</span>
                                </div>
                            </a>
                            <a href="/cmak/cmdata/wordbook/1" class="icak-image-card">
                                <div class="icak-image-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                </div>
                                <div class="icak-image-card-text">
                                    <strong>Word Book</strong>
                                    <span>CM 용어집</span>
                                </div>
                            </a>
                            <a href="/cmak/business/herald" class="icak-image-card">
                                <div class="icak-image-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                                </div>
                                <div class="icak-image-card-text">
                                    <strong>CM헤럴드</strong>
                                    <span>월간 소식지</span>
                                </div>
                            </a>
                            <a href="/cmak/archive/cm" class="icak-image-card">
                                <div class="icak-image-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"/></svg>
                                </div>
                                <div class="icak-image-card-text">
                                    <strong>CM자료방</strong>
                                    <span>논문·연구자료</span>
                                </div>
                            </a>
                            <a href="/cmak/intro/members" class="icak-image-card">
                                <div class="icak-image-card-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2" ry="2"/><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/></svg>
                                </div>
                                <div class="icak-image-card-text">
                                    <strong>CM사 소개</strong>
                                    <span>회원사 안내</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- ===== 관련기관 이미지 롤링 배너 ===== --}}
                <div class="icak-gov-banner">
                    <div class="icak-gov-banner-inner">
                        <div class="icak-gov-banner-label">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;"><path d="M3 21h18M3 10h18M5 6l7-3 7 3M4 10v11M20 10v11M8 14v3M12 14v3M16 14v3"/></svg>
                            관련기관
                        </div>
                        <div class="icak-gov-marquee" x-data="{ paused: false }" @mouseenter="paused = true" @mouseleave="paused = false">
                            <div class="icak-gov-marquee-track" :class="{ 'paused': paused }">
                                @foreach($partnerBanners as $banner)
                                    <a href="{{ $banner['link'] }}" target="_blank" rel="noopener noreferrer" class="icak-gov-img-link">
                                        <img src="{{ $banner['image'] }}" alt="{{ $banner['name'] }}">
                                    </a>
                                @endforeach
                                @foreach($partnerBanners as $banner)
                                    <a href="{{ $banner['link'] }}" target="_blank" rel="noopener noreferrer" class="icak-gov-img-link" aria-hidden="true">
                                        <img src="{{ $banner['image'] }}" alt="{{ $banner['name'] }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- 푸터 --}}
            @include('components.footer')
        </div>
    </section>

@endsection
