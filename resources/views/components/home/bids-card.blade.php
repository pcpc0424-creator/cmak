{{--
    입찰정보 카드
    2026 Modern Design
--}}

<div class="modern-card overflow-hidden">
    {{-- 헤더 --}}
    <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gradient-to-r from-emerald-50 to-teal-50">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <span class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
            </span>
            입·낙찰정보
        </h3>
        <a href="/bids" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium flex items-center gap-1 group">
            더보기
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- 콘텐츠 --}}
    <div class="p-4">
        <div class="space-y-3">
            @foreach($bids as $bid)
                <a href="{{ $bid['link'] }}" class="block group">
                    <div class="flex items-start gap-3 p-3 rounded-xl hover:bg-gray-50 transition-colors">
                        <span class="shrink-0 px-2 py-0.5 text-xs font-semibold rounded {{ $bid['type'] === '입찰' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                            {{ $bid['type'] }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-800 font-medium line-clamp-2 group-hover:text-emerald-600 transition-colors">
                                {{ $bid['title'] }}
                            </p>
                            <p class="text-xs text-gray-400 mt-1">{{ $bid['date'] }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
