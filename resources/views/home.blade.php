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

    // 관련기관 롤링 배너 — 관리자 배너(screen_type=partner)에서 읽고, 없으면 기존값 폴백
    try {
        $partnerRows = \App\Models\Banner::active()->where('screen_type', 'partner')
            ->orderBy('sort_order')->orderBy('id')->get();
        $partnerBanners = $partnerRows->map(fn($b) => [
            'name' => $b->title,
            'image' => '/cmak/' . ltrim($b->image_path, '/'),
            'link' => $b->link_url ?: '#',
        ])->all();
        if (empty($partnerBanners)) {
            $partnerBanners = HomeData::getPartnerBanners();
        }
    } catch (\Throwable $e) {
        $partnerBanners = HomeData::getPartnerBanners();
    }
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
                                <a href="/cmak/notice/bids" class="icak-cell-more">더보기 +</a>
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
                                <a href="/cmak/notice/law" class="icak-cell-more">더보기 +</a>
                            </div>
                        </div>

                        {{-- ===== 2행: 두 그룹 동시 노출 (PC: 좌우 / 모바일: 상하) ===== --}}
                        <div class="icak-tab-groups-wrap">
                            {{-- 그룹 1: 국내외소식 / 보도자료 / 유관기관 --}}
                            <div class="icak-tabs-section" x-data="{ activeTab: 'domestic' }">
                                <div class="icak-tabs-header">
                                    <button class="icak-tab-btn" :class="{ 'active': activeTab === 'domestic' }" @click="activeTab = 'domestic'">국내외소식</button>
                                    <button class="icak-tab-btn" :class="{ 'active': activeTab === 'press' }" @click="activeTab = 'press'">보도자료</button>
                                    <button class="icak-tab-btn" :class="{ 'active': activeTab === 'org' }" @click="activeTab = 'org'">유관기관</button>
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
                                        <a href="/cmak/notice/news" class="icak-cell-more">더보기 +</a>
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
                                        <a href="/cmak/notice/org" class="icak-cell-more">더보기 +</a>
                                    </div>
                                </div>
                            </div>

                            {{-- 그룹 2: 회원동향 / 전문가 칼럼 / 인사경조사 --}}
                            <div class="icak-tabs-section" x-data="{ activeTab: 'member' }">
                                <div class="icak-tabs-header">
                                    <button class="icak-tab-btn" :class="{ 'active': activeTab === 'member' }" @click="activeTab = 'member'">회원동향</button>
                                    <button class="icak-tab-btn" :class="{ 'active': activeTab === 'column' }" @click="activeTab = 'column'">전문가 칼럼</button>
                                    <button class="icak-tab-btn" :class="{ 'active': activeTab === 'personnel' }" @click="activeTab = 'personnel'">인사경조사</button>
                                </div>
                                <div class="icak-tabs-body">
                                    {{-- 회원동향 --}}
                                    <div x-show="activeTab === 'member'" x-transition>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($memberTrends, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">@if(!empty($item['company'])){{ $item['company'] }} - @endif{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/notice/member" class="icak-cell-more">더보기 +</a>
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
                                    {{-- 인사경조사 --}}
                                    <div x-show="activeTab === 'personnel'" x-transition>
                                        <ul class="icak-cell-list">
                                            @foreach(array_slice($personnelEvents, 0, 4) as $item)
                                                <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                            @endforeach
                                        </ul>
                                        <a href="/cmak/notice/personnel" class="icak-cell-more">더보기 +</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- 우측: 이미지 카드 6개 (2x3 그리드) — 관리자(home_cards) 연동 --}}
                    @php
                        $fallbackCards = [
                            ['title' => 'CM 가이드', 'subtitle' => 'CM 업무 관련 서식·안내', 'link_url' => '/business/cm-forms', 'icon' => 'doc', 'image_path' => null],
                            ['title' => 'Book Review', 'subtitle' => '추천 도서', 'link_url' => '/notice/bookreview', 'icon' => 'book', 'image_path' => null],
                            ['title' => 'CM을 부탁해', 'subtitle' => 'CM 용어집', 'link_url' => '/notice/wordbook', 'icon' => 'search', 'image_path' => null],
                            ['title' => 'CM헤럴드', 'subtitle' => '월간 소식지', 'link_url' => '/business/herald', 'icon' => 'monitor', 'image_path' => null],
                            ['title' => 'CM자료방', 'subtitle' => '논문·연구자료', 'link_url' => '/cmdata/report', 'icon' => 'folder', 'image_path' => null],
                            ['title' => 'CM사 소개', 'subtitle' => '회원사 안내', 'link_url' => '/intro/members', 'icon' => 'building', 'image_path' => null],
                        ];
                        try {
                            $homeCards = \App\Models\HomeCard::active()->orderBy('sort_order')->orderBy('id')->get()
                                ->map(fn($c) => ['title' => $c->title, 'subtitle' => $c->subtitle, 'link_url' => $c->link_url, 'icon' => $c->icon, 'image_path' => $c->image_path])->all();
                            if (empty($homeCards)) { $homeCards = $fallbackCards; }
                        } catch (\Throwable $e) { $homeCards = $fallbackCards; }

                        // CM사 소개 카드: 납부(active) 회원사 기본정보를 매일 순환 노출 → 해당 업체 홈페이지로 연결
                        $featuredCompany = null;
                        try {
                            $cos = \App\Models\MemberCompany::active()
                                ->whereNotNull('website')->where('website', '!=', '')
                                ->orderBy('id')->get(['company_name', 'representative', 'website']);
                            if ($cos->isNotEmpty()) {
                                $featuredCompany = $cos[(int) floor(time() / 86400) % $cos->count()];
                            }
                        } catch (\Throwable $e) { $featuredCompany = null; }
                    @endphp
                    <div class="icak-content-right">
                        <div class="icak-image-cards">
                            @foreach($homeCards as $card)
                                @php
                                    $link = $card['link_url'] ?: '#';
                                    if (!\Illuminate\Support\Str::startsWith($link, ['http://', 'https://', '/cmak'])) {
                                        $link = '/cmak' . (\Illuminate\Support\Str::startsWith($link, '/') ? '' : '/') . $link;
                                    }
                                    $img = $card['image_path'] ? '/cmak/' . ltrim($card['image_path'], '/') : null;
                                    // CM사 소개 카드 판별(제목 또는 회원현황 링크)
                                    $isCmCompanyCard = ($card['title'] === 'CM사 소개')
                                        || \Illuminate\Support\Str::contains($card['link_url'] ?? '', 'intro/members');
                                @endphp
                                @if($isCmCompanyCard && $featuredCompany)
                                    @php
                                        $coLink = $featuredCompany->website;
                                        if ($coLink && !\Illuminate\Support\Str::startsWith($coLink, ['http://', 'https://'])) {
                                            $coLink = 'https://' . $coLink;
                                        }
                                    @endphp
                                    <a href="{{ $coLink ?: $link }}" @if($coLink) target="_blank" rel="noopener noreferrer" @endif class="icak-image-card" title="CM사 소개 - {{ $featuredCompany->company_name }}">
                                        <div class="icak-image-card-icon">
                                            @include('components.home.card-icon', ['icon' => $card['icon']])
                                        </div>
                                        <div class="icak-image-card-text">
                                            <strong>{{ $featuredCompany->company_name }}</strong>
                                            <span>CM사 소개@if($featuredCompany->representative) · 대표 {{ $featuredCompany->representative }}@endif</span>
                                        </div>
                                    </a>
                                @elseif($img)
                                    <a href="{{ $link }}" class="icak-image-card has-image">
                                        <img src="{{ $img }}" alt="{{ $card['title'] }}" class="icak-image-card-bg">
                                        <div class="icak-image-card-overlay">
                                            <strong>{{ $card['title'] }}</strong>
                                            <span>{{ $card['subtitle'] }}</span>
                                        </div>
                                    </a>
                                @else
                                    <a href="{{ $link }}" class="icak-image-card">
                                        <div class="icak-image-card-icon">
                                            @include('components.home.card-icon', ['icon' => $card['icon']])
                                        </div>
                                        <div class="icak-image-card-text">
                                            <strong>{{ $card['title'] }}</strong>
                                            <span>{{ $card['subtitle'] }}</span>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
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
