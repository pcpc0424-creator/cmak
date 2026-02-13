{{--
    기획특집 섹션
--}}
@props(['features' => [], 'wordBook' => []])

<div class="grid lg:grid-cols-3 gap-6">
    {{-- 기획특집 (좌측 2/3) --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full">
            {{-- 헤더 --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">기획특집</h2>
                </div>
                <a href="/cmdata/feature" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                    더보기
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>

            {{-- 콘텐츠 --}}
            <div class="p-5">
                @php $featured = collect($features)->where('isFeatured', true)->first(); @endphp

                @if($featured)
                {{-- 추천 특집 --}}
                <a href="{{ $featured['link'] }}" class="block group mb-4">
                    <div class="flex gap-4">
                        {{-- 썸네일 --}}
                        <div class="w-32 h-24 bg-gradient-to-br from-indigo-100 to-indigo-200 rounded-xl overflow-hidden shrink-0">
                            @if(isset($featured['image']) && file_exists(public_path($featured['image'])))
                            <img src="{{ $featured['image'] }}" alt="{{ $featured['title'] }}" class="w-full h-full object-cover">
                            @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            @if(isset($featured['category']))
                            <span class="inline-block px-2 py-0.5 bg-indigo-100 text-indigo-700 text-[10px] font-bold rounded mb-2">{{ $featured['category'] }}</span>
                            @endif
                            <h3 class="text-sm font-bold text-gray-900 group-hover:text-indigo-600 transition-colors line-clamp-2 mb-1">
                                {{ $featured['title'] }}
                            </h3>
                            @if(isset($featured['summary']))
                            <p class="text-xs text-gray-500 line-clamp-2">{{ $featured['summary'] }}</p>
                            @endif
                        </div>
                    </div>
                </a>
                @endif

                {{-- 기사 목록 --}}
                <ul class="space-y-2">
                    @foreach(collect($features)->where('isFeatured', false)->take(4) as $feature)
                    <li>
                        <a href="{{ $feature['link'] }}" class="flex items-center justify-between py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="text-xs text-gray-400">-</span>
                                <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">{{ $feature['title'] }}</span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- WordBook (우측 1/3) --}}
    <div class="space-y-4">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">WordBook</h2>
                </div>
            </div>
            <div class="p-5">
                @foreach($wordBook as $word)
                <a href="{{ $word['link'] }}" class="block group">
                    <div class="text-center py-4">
                        <p class="text-base font-bold text-gray-800 group-hover:text-emerald-600 transition-colors mb-2">{{ $word['term'] }}</p>
                        <p class="text-sm text-gray-500">{{ $word['definition'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
