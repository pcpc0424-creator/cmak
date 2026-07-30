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

        // 섹션별 아이콘 (국문 사이드바와 동일한 Heroicons outline 스타일)
        $engIcons = [
            'home'       => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1m-4 0h4"/>',
            'about'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            'cmday'      => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>',
            'ipma'       => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>',
            'news'       => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m0 12a2 2 0 01-2-2V7m2 12a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>',
            'membership' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>',
        ];
        $engFallbackIcon = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>';
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
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $engIcons[$sectionKey] ?? $engFallbackIcon !!}</svg>
                    <span>{{ $sectionLabel }}</span>
                </a>
            @else
                <div>
                    <button @click="openMenu = openMenu === '{{ $sectionKey }}' ? '' : '{{ $sectionKey }}'"
                            class="w-full flex items-center justify-between px-5 py-2.5 text-sm text-slate-300 hover:bg-slate-700/50 hover:text-white transition-colors">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">{!! $engIcons[$sectionKey] ?? $engFallbackIcon !!}</svg>
                            <span>{{ $sectionLabel }}</span>
                        </div>
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
