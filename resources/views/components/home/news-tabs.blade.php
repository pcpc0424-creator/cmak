{{--
    뉴스 탭 컴포넌트
    국내외소식, 법령소식, 유관기관소식 탭 형태
--}}
@props(['domesticNews' => [], 'legalNews' => [], 'relatedOrgNews' => []])

<div
    class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden"
    x-data="{ activeTab: 'domestic' }"
>
    {{-- 탭 헤더 --}}
    <div class="flex border-b border-gray-100">
        <button
            @click="activeTab = 'domestic'"
            :class="activeTab === 'domestic'
                ? 'text-primary-600 border-primary-600 bg-primary-50/50'
                : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
            class="flex-1 px-4 py-3.5 text-sm font-semibold border-b-2 transition-all duration-200"
        >
            국내외소식
        </button>
        <button
            @click="activeTab = 'legal'"
            :class="activeTab === 'legal'
                ? 'text-primary-600 border-primary-600 bg-primary-50/50'
                : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
            class="flex-1 px-4 py-3.5 text-sm font-semibold border-b-2 transition-all duration-200"
        >
            법령소식
        </button>
        <button
            @click="activeTab = 'org'"
            :class="activeTab === 'org'
                ? 'text-primary-600 border-primary-600 bg-primary-50/50'
                : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
            class="flex-1 px-4 py-3.5 text-sm font-semibold border-b-2 transition-all duration-200"
        >
            유관기관소식
        </button>
    </div>

    {{-- 국내외소식 탭 콘텐츠 --}}
    <div x-show="activeTab === 'domestic'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <ul class="divide-y divide-gray-50">
            @foreach($domesticNews as $news)
            <li>
                <a href="{{ $news['link'] }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors group">
                    <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate pr-4">
                        {{ $news['title'] }}
                    </span>
                    <time class="text-xs text-gray-400 tabular-nums shrink-0">
                        {{ \Carbon\Carbon::parse($news['date'])->format('y.m.d') }}
                    </time>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
            <a href="/news/domestic" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- 법령소식 탭 콘텐츠 --}}
    <div x-show="activeTab === 'legal'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <ul class="divide-y divide-gray-50">
            @foreach($legalNews as $news)
            <li>
                <a href="{{ $news['link'] }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors group">
                    <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate pr-4">
                        {{ $news['title'] }}
                    </span>
                    <time class="text-xs text-gray-400 tabular-nums shrink-0">
                        {{ \Carbon\Carbon::parse($news['date'])->format('y.m.d') }}
                    </time>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
            <a href="/news/legal" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- 유관기관소식 탭 콘텐츠 --}}
    <div x-show="activeTab === 'org'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
        <ul class="divide-y divide-gray-50">
            @foreach($relatedOrgNews as $news)
            <li>
                <a href="{{ $news['link'] }}" class="flex items-center justify-between px-5 py-3.5 hover:bg-gray-50 transition-colors group">
                    <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate pr-4">
                        {{ $news['title'] }}
                    </span>
                    <time class="text-xs text-gray-400 tabular-nums shrink-0">
                        {{ \Carbon\Carbon::parse($news['date'])->format('y.m.d') }}
                    </time>
                </a>
            </li>
            @endforeach
        </ul>
        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100">
            <a href="/news/org" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</div>
