{{--
    Header Component
    글로벌 네비게이션 헤더

    접근성:
    - 스킵 네비게이션 링크 제공
    - ARIA 레이블 적용
    - 키보드 탐색 지원
    - 모바일 메뉴 접근성
--}}
<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-[100] focus:px-4 focus:py-2 focus:bg-primary-600 focus:text-white focus:rounded-lg">
    본문 바로가기
</a>

<header
    x-data="{ mobileMenuOpen: false, activeMenu: null }"
    class="fixed top-0 left-0 right-0 z-50"
    role="banner"
>
    <!-- Top Utility Bar (optional) -->
    <div class="hidden lg:block bg-gray-100 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-8 text-xs text-gray-600">
                <div class="flex items-center gap-4">
                    <span>{{ now()->format('Y.m.d') }} ({{ ['일','월','화','수','목','금','토'][now()->dayOfWeek] }})</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="/sitemap" class="hover:text-gray-900 transition-colors">사이트맵</a>
                    <span class="text-gray-300">|</span>
                    <a href="/intro/location" class="hover:text-gray-900 transition-colors">오시는길</a>
                    <span class="text-gray-300">|</span>
                    <a href="/community/faq" class="hover:text-gray-900 transition-colors">FAQ</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-20">
                <!-- Logo -->
                <a href="/" class="flex items-center gap-3 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg">
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-primary-600 rounded-lg flex items-center justify-center" aria-hidden="true">
                        <span class="text-white font-bold text-sm lg:text-base">CM</span>
                    </div>
                    <div>
                        <span class="block text-lg lg:text-xl font-bold text-gray-900">한국CM협회</span>
                        <span class="block text-[10px] lg:text-xs text-gray-500 -mt-0.5">CMAK</span>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:block" aria-label="메인 메뉴">
                    <ul class="flex items-center gap-1">
                        <!-- 협회사업 -->
                        <li class="relative" @mouseenter="activeMenu = 'business'" @mouseleave="activeMenu = null">
                            <a
                                href="/business"
                                class="block px-4 py-2 text-gray-700 hover:text-primary-600 font-medium text-[15px] transition-colors"
                                :class="{ 'text-primary-600': activeMenu === 'business' }"
                                aria-haspopup="true"
                                :aria-expanded="activeMenu === 'business'"
                            >
                                협회사업
                            </a>
                            <ul
                                x-show="activeMenu === 'business'"
                                x-cloak
                                x-transition:enter="transition ease-out duration-150"
                                x-transition:enter-start="opacity-0 translate-y-1"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                class="absolute top-full left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-200 py-2"
                                role="menu"
                            >
                                <li><a href="/business/membership" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">회원가입</a></li>
                                <li><a href="/business/certification" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">CM 능력평가 공시</a></li>
                                <li><a href="/business/confirm" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">CM 실적확인</a></li>
                                <li><a href="/business/inspection" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">자격검정</a></li>
                                <li><a href="/business/education" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">CM 전문교육</a></li>
                                <li><a href="/business/herald" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">CM Herald</a></li>
                                <li><a href="/business/consma" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600" role="menuitem">CONSMA</a></li>
                            </ul>
                        </li>

                        <!-- CM정보 -->
                        <li class="relative" @mouseenter="activeMenu = 'cmdata'" @mouseleave="activeMenu = null">
                            <a
                                href="/cmdata"
                                class="block px-4 py-2 text-gray-700 hover:text-primary-600 font-medium text-[15px] transition-colors"
                                :class="{ 'text-primary-600': activeMenu === 'cmdata' }"
                            >
                                CM정보
                            </a>
                            <ul x-show="activeMenu === 'cmdata'" x-cloak x-transition class="absolute top-full left-0 mt-1 w-44 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                <li><a href="/cmdata/about" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">CM이란</a></li>
                                <li><a href="/cmdata/law" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">법령정보</a></li>
                                <li><a href="/cmdata/report" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">논문/연구보고서</a></li>
                                <li><a href="/cmdata/case" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">수행사례</a></li>
                                <li><a href="/cmdata/seminar" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">교육/세미나</a></li>
                                <li><a href="/cmdata/expert" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">전문가칼럼</a></li>
                            </ul>
                        </li>

                        <!-- 새소식 -->
                        <li class="relative" @mouseenter="activeMenu = 'news'" @mouseleave="activeMenu = null">
                            <a
                                href="/news"
                                class="block px-4 py-2 text-gray-700 hover:text-primary-600 font-medium text-[15px] transition-colors"
                                :class="{ 'text-primary-600': activeMenu === 'news' }"
                            >
                                새소식
                            </a>
                            <ul x-show="activeMenu === 'news'" x-cloak x-transition class="absolute top-full left-0 mt-1 w-40 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                <li><a href="/news" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">국내소식</a></li>
                                <li><a href="/notice/tender" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">입낙찰소식</a></li>
                                <li><a href="/notice/law" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">법령소식</a></li>
                                <li><a href="/notice" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">협회소식</a></li>
                                <li><a href="/notice/member" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">회원동향</a></li>
                            </ul>
                        </li>

                        <!-- 열린광장 -->
                        <li class="relative" @mouseenter="activeMenu = 'community'" @mouseleave="activeMenu = null">
                            <a
                                href="/community"
                                class="block px-4 py-2 text-gray-700 hover:text-primary-600 font-medium text-[15px] transition-colors"
                                :class="{ 'text-primary-600': activeMenu === 'community' }"
                            >
                                열린광장
                            </a>
                            <ul x-show="activeMenu === 'community'" x-cloak x-transition class="absolute top-full left-0 mt-1 w-40 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                <li><a href="/community/faq" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">FAQ</a></li>
                                <li><a href="/community/board" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">자유게시판</a></li>
                                <li><a href="/community/book" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">Book Review</a></li>
                                <li><a href="/community/word" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">Word Book</a></li>
                                <li><a href="/community/job" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">구인/구직</a></li>
                            </ul>
                        </li>

                        <!-- 협회소개 -->
                        <li class="relative" @mouseenter="activeMenu = 'intro'" @mouseleave="activeMenu = null">
                            <a
                                href="/intro"
                                class="block px-4 py-2 text-gray-700 hover:text-primary-600 font-medium text-[15px] transition-colors"
                                :class="{ 'text-primary-600': activeMenu === 'intro' }"
                            >
                                협회소개
                            </a>
                            <ul x-show="activeMenu === 'intro'" x-cloak x-transition class="absolute top-full left-0 mt-1 w-40 bg-white rounded-lg shadow-lg border border-gray-200 py-2">
                                <li><a href="/intro/greeting" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">협회장 인사말</a></li>
                                <li><a href="/intro/about" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">협회안내</a></li>
                                <li><a href="/intro/members" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">회원현황</a></li>
                                <li><a href="/intro/organization" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">조직도</a></li>
                                <li><a href="/intro/location" class="block px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-primary-600">찾아오시는 길</a></li>
                            </ul>
                        </li>

                        <!-- 관련기관 -->
                        <li>
                            <a href="/reference" class="block px-4 py-2 text-gray-700 hover:text-primary-600 font-medium text-[15px] transition-colors">
                                관련기관
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- Right Actions -->
                <div class="flex items-center gap-3">
                    <a
                        href="/login"
                        class="hidden sm:inline-flex items-center gap-1.5 px-4 py-2 text-sm font-medium text-gray-600 hover:text-gray-900 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 rounded-lg"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        로그인
                    </a>
                    <a
                        href="/register"
                        class="hidden sm:inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-semibold rounded-lg hover:bg-primary-700 transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                    >
                        회원가입
                    </a>

                    <!-- Mobile Menu Button -->
                    <button
                        @click="mobileMenuOpen = !mobileMenuOpen"
                        class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary-500"
                        :aria-expanded="mobileMenuOpen"
                        aria-controls="mobile-menu"
                        aria-label="메뉴 열기"
                    >
                        <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                        <svg x-show="mobileMenuOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div
        id="mobile-menu"
        x-show="mobileMenuOpen"
        x-cloak
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="lg:hidden bg-white border-t border-gray-200 shadow-lg"
    >
        <nav class="max-w-7xl mx-auto px-4 py-4 space-y-1" aria-label="모바일 메뉴">
            <a href="/business" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">협회사업</a>
            <a href="/cmdata" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">CM정보</a>
            <a href="/news" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">새소식</a>
            <a href="/community" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">열린광장</a>
            <a href="/intro" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">협회소개</a>
            <a href="/reference" class="block px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg font-medium">관련기관</a>
            <div class="pt-4 flex gap-2">
                <a href="/login" class="flex-1 text-center px-4 py-3 border border-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-50">로그인</a>
                <a href="/register" class="flex-1 text-center px-4 py-3 bg-primary-600 text-white rounded-lg font-semibold hover:bg-primary-700">회원가입</a>
            </div>
        </nav>
    </div>
</header>

<!-- Header spacer: 데스크톱에서는 utility bar + header 높이, 모바일에서는 header만 -->
<div class="h-16 lg:h-28"></div>
