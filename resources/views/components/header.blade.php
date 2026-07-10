{{-- ICAK 스타일 헤더 --}}
@php
    $basePath = '/cmak';

    // 상단 POPUP 버튼 — 관리자(top_popup_items)에서 읽고, 없으면 기본값 폴백
    $fallbackTopPop = [
        ['label' => 'CM능력평가공시', 'link' => $basePath . '/business/certification', 'target' => '_self', 'image' => null],
        ['label' => 'CM30년', 'link' => $basePath . '/intro/history', 'target' => '_self', 'image' => null],
        ['label' => '건설사업관리사자격검정', 'link' => $basePath . '/business/inspection', 'target' => '_self', 'image' => null],
    ];
    try {
        $topPopItems = \App\Models\TopPopupItem::active()->orderBy('sort_order')->orderBy('id')->get()
            ->map(function ($it) use ($basePath) {
                $link = $it->link_url ?: '#';
                // 상대경로(/...)면 basePath 접두, 절대 URL이면 그대로
                if (\Illuminate\Support\Str::startsWith($link, '/') && !\Illuminate\Support\Str::startsWith($link, $basePath)) {
                    $link = $basePath . $link;
                }
                return [
                    'label' => $it->label,
                    'link' => $link,
                    'target' => $it->link_target ?: '_self',
                    'image' => $it->image_path ? $basePath . '/' . ltrim($it->image_path, '/') : null,
                ];
            })->all();
        if (empty($topPopItems)) {
            $topPopItems = $fallbackTopPop;
        }
    } catch (\Throwable $e) {
        $topPopItems = $fallbackTopPop;
    }
@endphp

{{-- 상단 팝업 배너 (기본 접힘) --}}
<div class="topPop active" id="topPop">
    <div class="popDiv">
        <div class="topPopupInner" id="topPopInner">
            <div class="pc_pop">
                @foreach($topPopItems as $tp)
                    <a href="{{ $tp['link'] }}" target="{{ $tp['target'] }}" class="pc_pop_item">
                        @if($tp['image'])
                            <img src="{{ $tp['image'] }}" alt="{{ $tp['label'] }}">
                        @else
                            <span class="pc_pop_label">{{ $tp['label'] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <button type="button" class="topPopBtn" id="topPopBtn">
        <span>POPUP</span>
        <span class="topPopBtnSpan active" id="topPopBtnSpan">닫기</span>
    </button>
</div>

{{-- 메인 헤더 --}}
<header class="icak-header" id="mainHeader" x-data="{ mobileOpen: false }">
    <div class="icak-header-inner">
        {{-- 로고 (25%) --}}
        <h1 class="icak-logo">
            <a href="{{ $basePath }}">
                <img src="{{ $basePath }}/images/logo_header_white.png" alt="CMAK" class="icak-logo-img icak-logo-img--light" style="height:50px; width:auto;">
                <img src="{{ $basePath }}/images/logo_header.png" alt="CMAK" class="icak-logo-img icak-logo-img--dark" style="height:50px; width:auto;">
            </a>
        </h1>

        {{-- GNB 메뉴 (50%) --}}
        @php
            $bp = $basePath;
            $menus = [
                ['title' => '협회업무', 'link' => "$bp/business", 'sub' => [
                    ['title' => '일반·특별회원 가입', 'link' => "$bp/business/membership"],
                    ['title' => 'CM능력평가공시', 'link' => "$bp/business/certification"],
                    ['title' => 'CM실적 관리 및 확인서 발급', 'link' => "$bp/business/confirm"],
                    ['title' => '건설사업관리사자격검정', 'link' => "$bp/business/inspection"],
                    ['title' => 'CM교육', 'link' => "$bp/business/education"],
                    ['title' => 'ConsMa', 'link' => "$bp/business/consma"],
                    ['title' => 'CM Herald', 'link' => "$bp/business/herald"],
                    ['title' => '건설사업관리(CM)표어', 'link' => "$bp/business/slogan"],
                ]],
                ['title' => 'CM 소개', 'link' => "$bp/cmdata", 'sub' => [
                    ['title' => 'CM이란?', 'link' => "$bp/cmdata/about"],
                    ['title' => 'CM 가이드', 'link' => "$bp/business/cm-forms"],
                    ['title' => '법령정보조회', 'link' => "$bp/cmdata/law"],
                    ['title' => '논문 및 연구보고서', 'link' => "$bp/cmdata/report"],
                    ['title' => 'CM해외공급사업', 'link' => "$bp/cmdata/overseas"],
                    ['title' => '수행사례', 'link' => "$bp/cmdata/case"],
                    ['title' => '교육 및 세미나 자료', 'link' => "$bp/cmdata/seminar"],
                    ['title' => '전문가 칼럼', 'link' => "$bp/cmdata/expert"],
                    ['title' => '기획/특집', 'link' => "$bp/cmdata/special"],
                    ['title' => 'CM30년', 'link' => "$bp/cm30"],
                    ['title' => '기타자료', 'link' => "$bp/cmdata/etc"],
                ]],
                ['title' => '알림마당', 'link' => "$bp/notice", 'sub' => [
                    ['title' => '국내외소식', 'link' => "$bp/notice/news"],
                    ['title' => '입찰소식', 'link' => "$bp/notice/bids"],
                    ['title' => '법령소식', 'link' => "$bp/notice/law"],
                    ['title' => '협회소식', 'link' => "$bp/notice/association"],
                    ['title' => '보도자료', 'link' => "$bp/notice/press"],
                    ['title' => '인사경조사', 'link' => "$bp/notice/personnel"],
                    ['title' => '회원동향', 'link' => "$bp/notice/member"],
                    ['title' => '유관기관소식', 'link' => "$bp/notice/org"],
                    ['title' => 'CM을 부탁해', 'link' => "$bp/notice/wordbook"],
                    ['title' => 'Book Review', 'link' => "$bp/notice/bookreview"],
                ]],
                ['title' => '참여마당', 'link' => "$bp/community", 'sub' => [
                    ['title' => 'FAQ', 'link' => "$bp/community/faq"],
                    ['title' => '자유게시판', 'link' => "$bp/community/board"],
                    ['title' => '구인', 'link' => "$bp/community/job-offer"],
                    ['title' => '구직', 'link' => "$bp/community/job-seek"],
                ]],
                ['title' => '온라인접수', 'link' => "$bp/reception"],
                ['title' => '협회소개', 'link' => "$bp/intro", 'sub' => [
                    ['title' => '협회장 인사말', 'link' => "$bp/intro/greeting"],
                    ['title' => '협회안내', 'link' => "$bp/intro/about"],
                    ['title' => '주요연혁', 'link' => "$bp/intro/history"],
                    ['title' => '조직 및 구성', 'link' => "$bp/intro/organization"],
                    ['title' => '역대 회장단', 'link' => "$bp/intro/presidents"],
                    ['title' => '사업계획', 'link' => "$bp/intro/plan"],
                    ['title' => '회원현황', 'link' => "$bp/intro/members"],
                    ['title' => '부서별 업무안내', 'link' => "$bp/intro/departments"],
                    ['title' => '정관 및 제규정', 'link' => "$bp/intro/articles"],
                    ['title' => '찾아오시는 길', 'link' => "$bp/intro/location"],
                ]],
                ['title' => '관련사이트', 'link' => "$bp/reference", 'sub' => [
                    ['title' => '국내관련기관', 'link' => "$bp/reference/domestic"],
                    ['title' => '해외관련기관', 'link' => "$bp/reference/overseas"],
                    ['title' => '언론관련기관', 'link' => "$bp/reference/media"],
                    ['title' => '입찰관련기관', 'link' => "$bp/reference/bidding"],
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

        {{-- headerUtil (25%) — 검색창 우측에 로그인/IPMA/ENG/전체메뉴를 한 줄로 정렬 --}}
        <div class="icak-header-util">
            <div class="icak-mutil">
                <form class="icak-search-box" action="{{ $basePath }}/search" method="GET">
                    <input type="text" name="q" placeholder="검색어를 입력해주세요." value="{{ request('q') }}">
                    <button type="submit"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></button>
                </form>
                @auth
                    <a href="{{ $basePath }}/mypage" class="icak-login-btn">마이페이지</a>
                @else
                    <a href="{{ $basePath }}/login" class="icak-login-btn">로그인</a>
                @endauth
                <a href="https://www.ipma.world/" target="_blank" rel="noopener noreferrer" class="icak-special-btn">IPMA KOREA</a>
                <a href="{{ $basePath }}/eng" class="icak-lang-btn">ENG</a>
                <div class="icak-btn-mainmenu">
                    <a href="#" class="icak-hbutton">
                        <span></span><span></span><span></span><span>전체메뉴</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- 모바일 전용 우측 버튼 (햄버거만) - 로고/햄버거 외 나머지는 햄버거 펼침 패널 내부에 있음 --}}
        <div class="icak-mobile-util hidden max-lg:flex items-center gap-2">
            <button @click="mobileOpen = !mobileOpen" class="icak-mobile-btn">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>
        </div>
    </div>

    {{-- 전체메뉴 패널 (ICAK mainMenu 동일) --}}
    <div class="icak-mainmenu" id="mainMenu">
        <div class="icak-mainmenu-inner">
            <button type="button" class="icak-mainmenu-close" id="mainMenuClose" aria-label="메뉴 닫기">
                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
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
    <div x-show="mobileOpen" x-cloak id="mobileMenuPanel" class="lg:hidden bg-white border-t border-gray-200 max-h-[calc(100vh-125px)] overflow-y-auto">
        <nav class="max-w-[1420px] mx-auto px-4 py-4 space-y-1">
            {{-- 모바일 검색 + 유틸 버튼 --}}
            <form action="{{ $basePath }}/search" method="GET" class="flex items-center border border-gray-300 rounded-full overflow-hidden mb-3 bg-white">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="검색어를 입력해주세요." class="flex-1 px-4 py-2 text-sm outline-none bg-transparent">
                <button type="submit" class="px-3 text-gray-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
            </form>
            <div class="flex gap-2 mb-3">
                @auth
                    <a href="{{ $basePath }}/mypage" class="flex-1 text-center py-2 rounded-full bg-[#265de8] text-white text-sm font-medium">마이페이지</a>
                @else
                    <a href="{{ $basePath }}/login" class="flex-1 text-center py-2 rounded-full bg-[#265de8] text-white text-sm font-medium">로그인</a>
                @endauth
                <a href="{{ $basePath }}/eng" class="flex-1 text-center py-2 rounded-full bg-[#515151] text-white text-sm font-medium">ENG</a>
                <a href="https://www.ipma.world/" target="_blank" rel="noopener noreferrer" class="flex-1 text-center py-2 rounded-full bg-[#f56800] text-white text-sm font-medium">IPMA KOREA</a>
            </div>
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
