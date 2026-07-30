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
    @php
        $can = fn($k) => auth()->check() && auth()->user()->hasPermission($k);

        // 현재 보고 있는 화면이 속한 그룹을 펼친 상태로 시작한다.
        // (그룹이 전부 접힌 채로 열리면 편집 화면에 직접 들어왔을 때 내 위치를 찾을 수 없다)
        $menuToKey = [
            '협회업무'   => 'association',
            '협회소개'   => 'intro',
            'CM 소개'    => 'cmintro',
            '약관/정책'  => 'policy',
            '알림마당'   => 'notices',
            '참여마당'   => 'community',
        ];
        $openDefault = '';
        if (preg_match('#admin/page-contents/(\d+)#', request()->path(), $m)) {
            $openDefault = $menuToKey[\App\Models\PageContent::find($m[1])?->menu] ?? '';
        } elseif (preg_match('#admin/posts/([a-z0-9_]+)#', request()->path(), $m)) {
            // CM30년은 관리자에서만 최상위 별도 메뉴라 그룹을 펼칠 필요가 없다
            $standalone = ['cm30'];
            $openDefault = in_array($m[1], $standalone, true)
                ? ''
                : ($menuToKey[config('boards.' . $m[1] . '.menu')] ?? '');
        }
    @endphp
    <nav class="flex-1 overflow-y-auto sidebar-scroll py-3" x-data="{ openMenu: '{{ $openDefault }}' }">
        {{-- 대시보드 --}}
        <a href="{{ url('/admin/dashboard') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/dashboard') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
            </svg>
            <span>대시보드</span>
        </a>

        @if($can('page_contents'))
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
                @foreach(\App\Models\PageContent::ofMenu('협회업무')->orderBy('sort_order')->orderBy('id')->get() as $bizPage)
                    <a href="{{ url('/admin/page-contents/' . $bizPage->id . '/edit') }}"
                       class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/page-contents/' . $bizPage->id . '*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">{{ $bizPage->page_title }}</a>
                @endforeach
                <a href="{{ url('/admin/consma-editions') }}"
                   class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/consma-editions*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">ConsMa 포스터 관리</a>
            </div>
        </div>

        {{-- 협회소개 --}}
        <div>
            <button @click="openMenu = openMenu === 'intro' ? '' : 'intro'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m6-1.13a4 4 0 100-8 4 4 0 000 8zm6 0a4 4 0 00-3-3.87M9 7a4 4 0 00-3 3.87"/>
                    </svg>
                    <span>협회소개</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'intro' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'intro'" x-collapse x-cloak class="bg-slate-900/50">
                @foreach(\App\Models\PageContent::ofMenu('협회소개')->orderBy('sort_order')->orderBy('id')->get() as $introPage)
                    <a href="{{ url('/admin/page-contents/' . $introPage->id . '/edit') }}"
                       class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/page-contents/' . $introPage->id . '*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">{{ $introPage->page_title }}</a>
                @endforeach
            </div>
        </div>

        @endif

        {{-- CM 소개 : 유저홈 2번 대메뉴와 동일 구성(편집페이지 + 게시판이 섞여 있어 권한을 개별로 확인) --}}
        @if($can('page_contents') || $can('posts'))
        <div>
            <button @click="openMenu = openMenu === 'cmintro' ? '' : 'cmintro'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>CM 소개</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'cmintro' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'cmintro'" x-collapse x-cloak class="bg-slate-900/50">
                @php
                    // 유저홈 좌측 메뉴(cmdata/_side-menu) 순서 그대로. page=편집페이지, board=게시판
                    $cmPages = \App\Models\PageContent::ofMenu('CM 소개')->get()->keyBy('slug');
                    $cmItems = [
                        ['type' => 'page',  'key' => 'cm-about'],
                        ['type' => 'board', 'key' => 'cm_forms',          'label' => 'CM 관련 서식'],
                        ['type' => 'page',  'key' => 'cm-law'],
                        ['type' => 'board', 'key' => 'research',          'label' => '논문 및 연구보고서'],
                        ['type' => 'board', 'key' => 'cm_overseas',       'label' => 'CM해외공급사업'],
                        ['type' => 'board', 'key' => 'cm_case',           'label' => '수행사례'],
                        ['type' => 'board', 'key' => 'education_seminar', 'label' => '교육 및 세미나 자료'],
                        ['type' => 'board', 'key' => 'expert_column',     'label' => '전문가 칼럼'],
                        ['type' => 'board', 'key' => 'special_feature',   'label' => '기획/특집'],
                        ['type' => 'board', 'key' => 'etc_data',          'label' => '기타자료'],
                    ];
                @endphp
                @foreach($cmItems as $item)
                    @if($item['type'] === 'page')
                        @php $p = $cmPages[$item['key']] ?? null; @endphp
                        @if($p && $can('page_contents'))
                            <a href="{{ url('/admin/page-contents/' . $p->id . '/edit') }}"
                               class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/page-contents/' . $p->id . '*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">{{ $p->page_title }}</a>
                        @endif
                    @elseif($can('posts'))
                        <a href="{{ url('/admin/posts/' . $item['key']) }}"
                           class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/' . $item['key'] . '*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">{{ $item['label'] }}</a>
                    @endif
                @endforeach
            </div>
        </div>
        @endif

        @if($can('page_contents'))

        {{-- 약관/정책 --}}
        <div>
            <button @click="openMenu = openMenu === 'policy' ? '' : 'policy'"
                    class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <span>약관/정책</span>
                </div>
                <svg class="w-4 h-4 transition-transform" :class="openMenu === 'policy' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div x-show="openMenu === 'policy'" x-collapse x-cloak class="bg-slate-900/50">
                @foreach(\App\Models\PageContent::ofMenu('약관/정책')->orderBy('sort_order')->orderBy('id')->get() as $policyPage)
                    <a href="{{ url('/admin/page-contents/' . $policyPage->id . '/edit') }}"
                       class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/page-contents/' . $policyPage->id . '*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">{{ $policyPage->page_title }}</a>
                @endforeach
            </div>
        </div>

        @endif

        @if($can('posts'))
        {{-- (CM자료방 그룹은 위 'CM 소개'로 통합됨) --}}

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
                <a href="{{ url('/admin/posts/news_personnel') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_personnel*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">인사·경조사</a>
                <a href="{{ url('/admin/posts/member_trend') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/member_trend*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">회원동향</a>
                <a href="{{ url('/admin/posts/news_org') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/news_org*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">유관기관소식</a>
                <a href="{{ url('/admin/posts/wordbook') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/wordbook*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">CM을 부탁해</a>
                <a href="{{ url('/admin/posts/book_review') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/book_review*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">Book Review</a>
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
                <a href="{{ url('/admin/posts/job_offer') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/job_offer*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">구인</a>
                <a href="{{ url('/admin/posts/job_seek') }}" class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/posts/job_seek*') ? 'text-blue-400' : 'text-slate-400 hover:text-white' }}">구직</a>
            </div>
        </div>

        {{-- CM30년 (완전 별도 독립 게시판) --}}
        <a href="{{ url('/admin/posts/cm30') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/posts/cm30*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>CM30년 게시판</span>
        </a>

        @endif

        {{-- Divider --}}
        <div class="my-2 mx-5 border-t border-slate-700"></div>

        @if($can('member_companies'))
        {{-- 회원사관리 --}}
        <a href="{{ url('/admin/member-companies') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/member-companies*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            <span>회원사관리</span>
        </a>

        @endif

        @if($can('members'))
        {{-- 개인(온라인)회원관리 --}}
        <a href="{{ url('/admin/members') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/members*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            <span>개인(온라인)회원관리</span>
        </a>

        @endif

        @if($can('home'))
        {{-- 히어로 슬라이드 --}}
        <a href="{{ url('/admin/hero-slides') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/hero-slides*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a2 2 0 012-2h12a2 2 0 012 2v14a2 2 0 01-2 2H6a2 2 0 01-2-2V5z M9 12l2 2 4-4"/>
            </svg>
            <span>히어로 슬라이드</span>
        </a>

        {{-- 메인 바로가기 카드 --}}
        <a href="{{ url('/admin/home-cards') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/home-cards*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h6a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 5a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM14 13a1 1 0 011-1h4a1 1 0 011 1v6a1 1 0 01-1 1h-4a1 1 0 01-1-1v-6z"/>
            </svg>
            <span>메인 바로가기 카드</span>
        </a>

        {{-- CM Herald 관리 --}}
        <a href="{{ url('/admin/herald-issues') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/herald-issues*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            <span>CM Herald 관리</span>
        </a>

        {{-- 상단 POPUP 관리 --}}
        <a href="{{ url('/admin/top-popup-items') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/top-popup-items*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M9 14h6M9 18h6"/>
            </svg>
            <span>상단 POPUP 관리</span>
        </a>

        @endif

        @if($can('banners'))
        {{-- 배너관리 --}}
        <a href="{{ url('/admin/banners') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/banners*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <span>배너관리</span>
        </a>

        @endif

        @if($can('popups'))
        {{-- 팝업관리 --}}
        <a href="{{ url('/admin/popups') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/popups*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
            </svg>
            <span>팝업관리</span>
        </a>

        @endif

        @if($can('related_sites'))
        {{-- 관련사이트 --}}
        <a href="{{ url('/admin/related-sites') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/related-sites*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
            </svg>
            <span>관련사이트</span>
        </a>

        @endif

        @if($can('online'))
        {{-- 온라인접수 --}}
        <a href="{{ url('/admin/reception') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/reception*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span>온라인접수</span>
        </a>

        @endif

        @if($can('accounts'))
        {{-- 계정관리 --}}
        <a href="{{ url('/admin/accounts') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/accounts*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
            <span>계정관리(관리자·직원)</span>
        </a>

        @endif

        @if($can('english'))
        {{-- 영문사이트 --}}
        <a href="{{ url('/admin/english-contents') }}"
           class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/english-contents*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>영문사이트 페이지 관리</span>
        </a>
        @endif
    </nav>

    {{-- Sidebar Footer --}}
    <div class="flex-shrink-0 px-5 py-3 border-t border-slate-700 text-xs text-slate-500">
        CMAK Admin v1.0
    </div>
</aside>
