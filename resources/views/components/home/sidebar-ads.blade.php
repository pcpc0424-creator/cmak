{{--
    우측 세로 광고 배너 컴포넌트
    스크롤 시 sticky 고정
--}}
@props(['ads' => []])

<div class="sticky top-24 space-y-3">
    {{-- 검색창 --}}
    <div class="bg-white rounded-xl border border-gray-200 p-3">
        <form action="/search" method="GET" class="flex gap-2">
            <input
                type="text"
                name="q"
                placeholder="검색어"
                class="flex-1 px-3 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent"
            >
            <button
                type="submit"
                class="px-3 py-2 bg-gray-700 hover:bg-gray-800 text-white rounded-lg transition-colors"
                aria-label="검색"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
        </form>
    </div>

    {{-- 광고 배너들 --}}
    <div class="space-y-3 max-h-[calc(100vh-200px)] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
        @foreach($ads as $ad)
        <a
            href="{{ $ad['link'] }}"
            target="_blank"
            rel="noopener noreferrer"
            class="block rounded-xl overflow-hidden border border-gray-200 hover:border-primary-300 hover:shadow-md transition-all duration-200 group"
        >
            @if($ad['type'] === 'youtube')
            {{-- YouTube 배너 --}}
            <div class="bg-gradient-to-r from-red-600 to-red-500 p-4 text-white">
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold">{{ $ad['title'] }}</span>
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </div>
            </div>
            @else
            {{-- 일반 광고 배너 --}}
            <div class="aspect-[16/9] bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center p-4 group-hover:from-primary-50 group-hover:to-indigo-50 transition-colors">
                @if(file_exists(public_path($ad['image'])))
                <img src="{{ $ad['image'] }}" alt="{{ $ad['title'] }}" class="max-w-full max-h-full object-contain">
                @else
                <div class="text-center">
                    <div class="text-xs font-semibold text-gray-500 group-hover:text-primary-600 transition-colors">{{ $ad['title'] }}</div>
                    <div class="text-[10px] text-gray-400 mt-1">광고</div>
                </div>
                @endif
            </div>
            @endif
        </a>
        @endforeach
    </div>
</div>
