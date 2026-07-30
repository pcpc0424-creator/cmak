{{-- English Admin Sidebar - Fixed Left 260px --}}
{{-- 국문 관리자 사이드바(admin.layouts.sidebar)와 동일한 구조로, 영문 사이트(/eng)의
     메뉴 트리를 그대로 보여준다. 섹션별로 접었다 펼치며 각 페이지는 편집 화면으로 연결. --}}
<aside class="fixed left-0 top-0 bottom-0 w-[260px] bg-slate-800 text-white z-40 flex flex-col">
    {{-- Logo / Title --}}
    <div class="h-16 flex flex-col justify-center px-5 border-b border-slate-700 flex-shrink-0">
        <a href="{{ url('/admin/english-contents') }}" class="flex items-center gap-3">
            <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center font-bold text-xs">EN</div>
            <span class="text-base font-bold tracking-tight">CMAK 영문관리</span>
        </a>
    </div>

    {{-- 국문 관리자로 복귀 --}}
    <a href="{{ url('/admin/dashboard') }}"
       class="flex items-center gap-2 px-5 py-2.5 text-xs text-slate-400 border-b border-slate-700/60 hover:bg-slate-700/50 hover:text-white transition-colors flex-shrink-0">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
        </svg>
        국문 관리자로 돌아가기
    </a>

    @php
        // 영문 페이지를 섹션별로 묶는다 (site nav 순서 = sectionLabels 순서)
        $engSections = \App\Models\EnglishContent::orderBy('sort_order')->orderBy('id')->get()->groupBy('section');
        $engLabels   = \App\Models\EnglishContent::sectionLabels();

        // 현재 편집 중인 페이지가 속한 섹션을 펼친 상태로 시작
        $engOpen = '';
        if (preg_match('#admin/english-contents/(\d+)#', request()->path(), $m)) {
            $engOpen = optional(\App\Models\EnglishContent::find($m[1]))->section ?? '';
        }
    @endphp

    {{-- Navigation --}}
    <nav class="flex-1 overflow-y-auto sidebar-scroll py-3" x-data="{ openMenu: '{{ $engOpen }}' }">
        @foreach($engLabels as $sectionKey => $sectionLabel)
            @php $pages = $engSections[$sectionKey] ?? collect(); @endphp
            @continue($pages->isEmpty())

            @if($pages->count() === 1 && $sectionKey === $pages->first()->slug)
                {{-- 하위 페이지가 하나뿐이면(Home / Membership) 그룹 없이 단독 링크 --}}
                @php $only = $pages->first(); @endphp
                <a href="{{ url('/admin/english-contents/' . $only->id . '/edit') }}"
                   class="flex items-center gap-3 px-5 py-2.5 text-sm transition-colors {{ request()->is('*/admin/english-contents/' . $only->id . '*') ? 'bg-slate-700 text-white' : 'text-slate-300 hover:bg-slate-700/50 hover:text-white' }}">
                    <span class="w-5 text-center text-xs text-slate-500">▪</span>
                    <span>{{ $sectionLabel }}</span>
                </a>
            @else
                <div>
                    <button @click="openMenu = openMenu === '{{ $sectionKey }}' ? '' : '{{ $sectionKey }}'"
                            class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                        <span>{{ $sectionLabel }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="openMenu === '{{ $sectionKey }}' ? 'rotate-90' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div x-show="openMenu === '{{ $sectionKey }}'" x-collapse x-cloak class="bg-slate-900/50">
                        @foreach($pages as $page)
                            <a href="{{ url('/admin/english-contents/' . $page->id . '/edit') }}"
                               class="block px-5 pl-14 py-2 text-sm {{ request()->is('*/admin/english-contents/' . $page->id . '*') ? 'text-indigo-400' : 'text-slate-400 hover:text-white' }}">{{ $page->title }}</a>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </nav>
</aside>
