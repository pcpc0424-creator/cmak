{{--
    회원동향 카드
    2026 Modern Design - ICAK Style
--}}
@php
    $basePath = '/cmak';
@endphp

<div class="modern-card overflow-hidden">
    {{-- 헤더 --}}
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
            <span class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </span>
            회원동향
        </h3>
        <a href="/news/member" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 group">
            더보기
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    {{-- 콘텐츠 --}}
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach(array_slice($memberTrends, 0, 6) as $index => $trend)
                <a href="{{ $trend['link'] }}" class="block group">
                    <div class="relative overflow-hidden rounded-xl border border-gray-100 hover:border-blue-200 transition-all duration-300 hover:shadow-lg">
                        {{-- 이미지 영역 --}}
                        @if(isset($trend['image']))
                            <div class="aspect-video bg-gray-100 overflow-hidden">
                                <img
                                    src="{{ $basePath . $trend['image'] }}"
                                    alt="{{ $trend['company'] }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500"
                                    loading="lazy"
                                    onerror="this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200\'><svg class=\'w-12 h-12 text-gray-300\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4\'/></svg></div>'"
                                >
                            </div>
                        @else
                            <div class="aspect-video bg-gradient-to-br from-blue-50 to-indigo-100 flex items-center justify-center">
                                <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                        @endif

                        {{-- 텍스트 영역 --}}
                        <div class="p-4">
                            <p class="text-sm font-semibold text-blue-600 mb-1">{{ $trend['company'] }}</p>
                            @if($trend['title'])
                                <p class="text-gray-700 font-medium line-clamp-2 group-hover:text-blue-700 transition-colors">
                                    {{ $trend['title'] }}
                                </p>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
