{{--
    공지사항/보도자료 탭 컴포넌트
--}}
@props(['notices' => [], 'pressReleases' => []])

<div
    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
    x-data="{ activeTab: 'notice' }"
>
    {{-- 탭 헤더 --}}
    <div class="flex border-b border-gray-100">
        <button
            @click="activeTab = 'notice'"
            :class="activeTab === 'notice'
                ? 'text-primary-600 border-primary-600 bg-primary-50/50'
                : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
            class="flex-1 px-4 py-3.5 text-sm font-semibold border-b-2 transition-all duration-200 flex items-center justify-center gap-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
            </svg>
            공지사항
        </button>
        <button
            @click="activeTab = 'press'"
            :class="activeTab === 'press'
                ? 'text-primary-600 border-primary-600 bg-primary-50/50'
                : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
            class="flex-1 px-4 py-3.5 text-sm font-semibold border-b-2 transition-all duration-200 flex items-center justify-center gap-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            보도자료
        </button>
    </div>

    {{-- 공지사항 탭 콘텐츠 --}}
    <div x-show="activeTab === 'notice'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <ul class="divide-y divide-gray-50">
            @foreach($notices as $notice)
            <li>
                <a href="{{ $notice['link'] }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors group">
                    <div class="flex items-center gap-2 min-w-0 flex-1">
                        @if($notice['isNew'] ?? false)
                        <span class="inline-flex items-center justify-center w-5 h-5 bg-red-500 text-white text-[9px] font-bold rounded shrink-0">N</span>
                        @endif
                        <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">
                            {{ $notice['title'] }}
                        </span>
                    </div>
                    <time class="text-xs text-gray-400 tabular-nums shrink-0 ml-4">
                        {{ \Carbon\Carbon::parse($notice['date'])->format('y.m.d') }}
                    </time>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
            <a href="/notice" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                공지사항 더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- 보도자료 탭 콘텐츠 --}}
    <div x-show="activeTab === 'press'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <ul class="divide-y divide-gray-50">
            @foreach($pressReleases as $press)
            <li>
                <a href="{{ $press['link'] }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors group">
                    <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate pr-4">
                        {{ $press['title'] }}
                    </span>
                    <time class="text-xs text-gray-400 tabular-nums shrink-0">
                        {{ \Carbon\Carbon::parse($press['date'])->format('y.m.d') }}
                    </time>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
            <a href="/notice/press" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                보도자료 더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</div>
