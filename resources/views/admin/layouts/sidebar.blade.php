{{-- Admin Sidebar - Fixed Left 260px --}}
<aside class="fixed left-0 top-0 bottom-0 w-[260px] bg-slate-800 text-white z-40 flex flex-col">
    {{-- Logo / Title --}}
    <div class="h-16 flex items-center px-5 border-b border-slate-700 flex-shrink-0">
        <a href="{{ url('/admin/dashboard') }}" class="flex items-center gap-3">
            <div class="w-8 h-8 bg-blue-500 rounded-lg flex items-center justify-center font-bold text-sm">CM</div>
            <span class="text-lg font-bold tracking-tight">CMAK 관리자</span>
        </a>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto sidebar-scroll py-3" x-data="{ openMenu: '' }">
        {{-- 대시보드 --}}
        <a href="{{ url('/admin/dashboard') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
            </svg>
            <span>대시보드</span>
        </a>

        {{-- 협회업무 --}}
        <div>
            <button @click="openMenu = openMenu === 'association' ? '' : 'association'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    <span>협회업무</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'association' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'association'" x-collapse x-cloak class="bg-slate-900/50">
                <a href="{{ url('/admin/posts/herald') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/herald*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">회보</a>
                <a href="{{ url('/admin/posts/certification_exam') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/certification_exam*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">자격검정시험</a>
                <a href="{{ url('/admin/posts/cm_forms') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/cm_forms*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">CM관련서식</a>
                <a href="{{ url('/admin/posts/cm_performance') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/cm_performance*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">CM능력평가/공시</a>
            </div>
        </div>

        {{-- CM자료방 --}}
        <div>
            <button @click="openMenu = openMenu === 'resources' ? '' : 'resources'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <span>CM자료방</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'resources' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'resources'" x-collapse x-cloak class="bg-slate-900/50">
                <a href="{{ url('/admin/posts/research') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/research*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">연구자료</a>
                <a href="{{ url('/admin/posts/cm_law') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/cm_law*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">CM관련법령</a>
                <a href="{{ url('/admin/posts/education_seminar') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/education_seminar*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">교육세미나</a>
                <a href="{{ url('/admin/posts/ve') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/ve*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">VE자료</a>
                <a href="{{ url('/admin/posts/expert_column') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/expert_column*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">전문가칼럼</a>
                <a href="{{ url('/admin/posts/special_feature') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/special_feature*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">특집</a>
                <a href="{{ url('/admin/posts/etc_data') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/etc_data*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">기타자료</a>
                <a href="{{ url('/admin/posts/press') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/press*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">언론보도</a>
                <a href="{{ url('/admin/posts/cm_case') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/cm_case*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">CM사례</a>
                <a href="{{ url('/admin/posts/education') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/education*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">교육자료</a>
            </div>
        </div>

        {{-- 알림마당 --}}
        <div>
            <button @click="openMenu = openMenu === 'notices' ? '' : 'notices'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                    <span>알림마당</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'notices' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'notices'" x-collapse x-cloak class="bg-slate-900/50">
                <a href="{{ url('/admin/posts/news_domestic') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_domestic*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">국내외소식</a>
                <a href="{{ url('/admin/posts/news_bid') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_bid*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">입찰소식</a>
                <a href="{{ url('/admin/posts/news_law') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_law*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">법령소식</a>
                <a href="{{ url('/admin/posts/news_association') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_association*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">협회소식</a>
                <a href="{{ url('/admin/posts/news_press') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_press*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">보도자료</a>
                <a href="{{ url('/admin/posts/member_trend') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/member_trend*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">회원동향</a>
                <a href="{{ url('/admin/posts/online_news') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/online_news*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">온라인뉴스</a>
                <a href="{{ url('/admin/posts/schedule') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/schedule*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">주요행사일정</a>
            </div>
        </div>

        {{-- 참여마당 --}}
        <div>
            <button @click="openMenu = openMenu === 'community' ? '' : 'community'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <span>참여마당</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'community' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'community'" x-collapse x-cloak class="bg-slate-900/50">
                <a href="{{ url('/admin/posts/faq') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/faq*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">FAQ</a>
                <a href="{{ url('/admin/posts/free_board') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/free_board*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">자유게시판</a>
                <a href="{{ url('/admin/posts/survey') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/survey*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">설문조사</a>
                <a href="{{ url('/admin/posts/book_review') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/book_review*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">BookReview</a>
                <a href="{{ url('/admin/posts/wordbook') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/wordbook*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">CM용어사전</a>
                <a href="{{ url('/admin/posts/gallery') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/gallery*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">사진갤러리</a>
                <a href="{{ url('/admin/posts/job_offer') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/job_offer*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">구인</a>
                <a href="{{ url('/admin/posts/job_seek') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/job_seek*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">구직</a>
            </div>
        </div>

        {{-- Divider --}}
        <div class="my-2 mx-5 border-t border-slate-700"></div>

        {{-- 회원사관리 --}}
        <a href="{{ url('/admin/member-companies') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/member-companies*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>회원사관리</span>
        </a>

        {{-- 배너관리 --}}
        <a href="{{ url('/admin/banners') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/banners*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>배너관리</span>
        </a>

        {{-- 팝업관리 --}}
        <a href="{{ url('/admin/popups') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/popups*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
            </svg>
            <span>팝업관리</span>
        </a>

        {{-- 관련사이트 --}}
        <a href="{{ url('/admin/related-sites') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/related-sites*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
            <span>관련사이트</span>
        </a>

        {{-- 온라인접수 --}}
        <a href="{{ url('/admin/online-applications') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/online-applications*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>온라인접수</span>
        </a>

        {{-- 계정관리 --}}
        <a href="{{ url('/admin/accounts') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/accounts*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>계정관리</span>
        </a>

        {{-- 영문사이트 --}}
        <a href="{{ url('/admin/english-contents') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/english-contents*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>영문사이트</span>
        </a>
    </nav>

    {{-- Sidebar Footer --}}
    <div class="flex-shrink-0 px-5 py-3 border-t border-slate-700 text-xs text-slate-500">
        CMAK Admin v1.0
    </div>
</aside>
