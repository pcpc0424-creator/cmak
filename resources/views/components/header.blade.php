{{-- ICAK 스타일 헤더 --}}
@php
    $basePath = '/cmak';
@endphp

{{-- 상단 팝업 배너 --}}
<div class="topPop" id="topPop">
    <div class="popDiv">
        <div class="topPopupInner" id="topPopInner">
            <div class="pc_pop">
                <a href="/business/certification" target="_self">
                    <img src="{{ $basePath }}/images/ads/banner_top1.jpg" alt="CM능력평가 공시" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22550%22 height=%22110%22%3E%3Crect fill=%22%23364058%22 width=%22550%22 height=%22110%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23fff%22 font-size=%2218%22 font-family=%22sans-serif%22%3E2026 CM능력평가 공시 안내%3C/text%3E%3C/svg%3E'">
                </a>
                <a href="/business/inspection" target="_self">
                    <img src="{{ $basePath }}/images/ads/banner_top2.jpg" alt="자격검정" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22550%22 height=%22110%22%3E%3Crect fill=%22%23364058%22 width=%22550%22 height=%22110%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 text-anchor=%22middle%22 dy=%22.3em%22 fill=%22%23fff%22 font-size=%2218%22 font-family=%22sans-serif%22%3E건설사업관리사 자격검정%3C/text%3E%3C/svg%3E'">
                </a>
            </div>
        </div>
    </div>
    <button type="button" class="topPopBtn" id="topPopBtn">
        <span>POPUP</span>
        <span class="topPopBtnSpan" id="topPopBtnSpan">닫기</span>
    </button>
</div>

{{-- 메인 헤더 --}}
<header class="icak-header" id="mainHeader" x-data="{ mobileOpen: false }">
    <div class="icak-header-inner">
        {{-- 로고 (25%) --}}
        <h1 class="icak-logo">
            <a href="/">
                <span class="icak-logo-icon">CM</span>
                <span class="icak-logo-text">
                    <strong>한국CM협회</strong>
                    <em>CMAK</em>
                </span>
            </a>
        </h1>

        {{-- GNB 메뉴 (50%) --}}
        @php
            $menus = [
                ['title' => '협회소개', 'link' => '/intro', 'sub' => [
                    ['title' => '협회장 인사말', 'link' => '/intro/greeting'],
                    ['title' => '협회안내', 'link' => '/intro/about'],
                    ['title' => '연혁', 'link' => '/intro/history'],
                    ['title' => '조직도', 'link' => '/intro/organization'],
                    ['title' => '회원현황', 'link' => '/intro/members'],
                    ['title' => '찾아오시는 길', 'link' => '/intro/location'],
                ]],
                ['title' => '협회사업', 'link' => '/business', 'sub' => [
                    ['title' => '회원가입', 'link' => '/business/membership'],
                    ['title' => 'CM능력평가 공시', 'link' => '/business/certification'],
                    ['title' => 'CM실적확인', 'link' => '/business/confirm'],
                    ['title' => '자격검정', 'link' => '/business/inspection'],
                    ['title' => 'CM전문교육', 'link' => '/business/education'],
                    ['title' => 'CM Herald', 'link' => '/business/herald'],
                ]],
                ['title' => 'CM정보', 'link' => '/cmdata', 'sub' => [
                    ['title' => 'CM이란', 'link' => '/cmdata/about'],
                    ['title' => '법령정보', 'link' => '/cmdata/law'],
                    ['title' => '논문/연구보고서', 'link' => '/cmdata/report'],
                    ['title' => '수행사례', 'link' => '/cmdata/case'],
                    ['title' => '전문가칼럼', 'link' => '/cmdata/expert'],
                ]],
                ['title' => '소통공간', 'link' => '/community', 'sub' => [
                    ['title' => '공지사항', 'link' => '/notice'],
                    ['title' => '보도자료', 'link' => '/notice/press'],
                    ['title' => 'FAQ', 'link' => '/community/faq'],
                    ['title' => '자유게시판', 'link' => '/community/board'],
                ]],
                ['title' => '새소식', 'link' => '/news', 'sub' => [
                    ['title' => '국내외소식', 'link' => '/news'],
                    ['title' => '입낙찰정보', 'link' => '/bids'],
                    ['title' => '회원동향', 'link' => '/news/member'],
                ]],
                ['title' => '자료실', 'link' => '/archive', 'sub' => [
                    ['title' => 'CM자료방', 'link' => '/archive/cm'],
                    ['title' => '서식자료', 'link' => '/archive/forms'],
                ]],
            ];
        @endphp

        {{-- GNB 메뉴 (50%) --}}
        <ul class="icak-gnb">
            @foreach($menus as $menu)
                <li>
                    <a href="{{ $menu['link'] }}"><span>{{ $menu['title'] }}</span></a>
                    @if(isset($menu['sub']))
                        <div class="icak-sub-wrap">
                            <div class="icak-sub-area">
                                <div class="icak-sub-title">{{ $menu['title'] }}</div>
                                <div class="icak-sub-list">
                                    @foreach($menu['sub'] as $sub)
                                        <a href="{{ $sub['link'] }}">{{ $sub['title'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

        {{-- headerUtil (25%) --}}
        <div class="icak-header-util">
            {{-- 수주통계 주황 버튼: absolute left:20px top:67px --}}
            <button type="button" class="icak-stat-btn" onclick="location.href='/business/certification'">CM능력평가</button>

            {{-- mUtil: 로그인 + 검색 + ENG — absolute top:15px right:20px --}}
            <div class="icak-mutil">
                <a href="/login" class="icak-login-btn">로그인</a>
                <form class="icak-search-box">
                    <input type="text" placeholder="검색어를 입력해주세요.">
                    <button type="button"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></button>
                </form>
                <a href="#" class="icak-lang-btn">ENG</a>
            </div>

            {{-- 전체메뉴: absolute right:15px bottom:0 --}}
            <div class="icak-btn-mainmenu">
                <a href="#" class="icak-hbutton">
                    <span></span><span></span><span></span><span>전체메뉴</span>
                </a>
            </div>
        </div>

        {{-- 모바일 메뉴 버튼 --}}
        <button @click="mobileOpen = !mobileOpen" class="icak-mobile-btn hidden max-lg:block">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- 전체메뉴 패널 (ICAK mainMenu 동일) --}}
    <div class="icak-mainmenu" id="mainMenu">
        <div class="icak-mainmenu-inner">
            <ul>
                @foreach($menus as $menu)
                    <li>
                        <a href="{{ $menu['link'] }}"><span>{{ $menu['title'] }}</span></a>
                        @if(isset($menu['sub']))
                            <div class="icak-allsub">
                                <ul>
                                    @foreach($menu['sub'] as $sub)
                                        <li><a href="{{ $sub['link'] }}">{{ $sub['title'] }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- 모바일 메뉴 --}}
    <div x-show="mobileOpen" x-cloak class="lg:hidden bg-white border-t border-gray-200">
        <nav class="max-w-[1420px] mx-auto px-4 py-4 space-y-1">
            @foreach($menus as $menu)
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center justify-between w-full py-3 px-2 text-[#333] border-b border-gray-100">
                        <span class="font-medium">{{ $menu['title'] }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    @if(isset($menu['sub']))
                        <div x-show="open" x-cloak class="bg-gray-50 py-1">
                            @foreach($menu['sub'] as $sub)
                                <a href="{{ $sub['link'] }}" class="block py-2.5 px-6 text-sm text-[#555] hover:text-[#0061c2]">{{ $sub['title'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </nav>
    </div>
</header>
