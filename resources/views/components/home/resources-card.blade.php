{{--
    CM자료방 카드
    2026 Modern Design
--}}

<div class="modern-card overflow-hidden">
    {{-- 헤더 --}}
    <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-violet-50 to-purple-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <span class="w-8 h-8 bg-gradient-to-br from-violet-500 to-purple-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
            </span>
            CM자료방
        </h3>
        <a href="/cmdata" class="text-sm text-violet-600 hover:text-violet-700 font-medium flex items-center gap-1 group">
            더보기
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- 콘텐츠 --}}
    <div class="p-4">
        <div class="space-y-3">
            @foreach($resources as $resource)
                <a href="{{ $resource['link'] }}" class="block group">
                    <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="shrink-0 px-2 py-0.5 text-xs font-medium rounded bg-violet-100 text-violet-700">
                            {{ $resource['category'] }}
                        </span>
                        <p class="flex-1 text-sm text-gray-800 font-medium line-clamp-2 group-hover:text-violet-600 transition-colors">
                            {{ $resource['title'] }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
