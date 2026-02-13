{{--
    전문가 칼럼 + 기획특집 + 회원동향 (좌측) + BookReview/WordBook/광고 (우측)
--}}
@props([
    'columns' => [],
    'features' => [],
    'memberTrends' => [],
    'bookReviews' => [],
    'wordBook' => [],
    'sidebarAds' => []
])

<div class="flex flex-col lg:flex-row gap-6">
    {{-- 좌측: 전문가 칼럼 + 기획특집 + 회원동향 (세로 쌓기) --}}
    <div class="flex-1 space-y-6">

        {{-- 전문가 칼럼 박스 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">전문가 칼럼</h2>
                </div>
                <a href="/cmdata/expert" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                    더보기
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="p-5">
                @php $featuredColumn = collect($columns)->where('isFeatured', true)->first(); @endphp
                @if($featuredColumn)
                <a href="{{ $featuredColumn['link'] }}" class="block group mb-4">
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-xl p-4 border border-amber-100 hover:border-amber-200 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-amber-200 to-orange-200 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="inline-block px-2 py-0.5 bg-amber-200 text-amber-800 text-[10px] font-bold rounded mb-2">추천 칼럼</span>
                                <h3 class="text-sm font-bold text-gray-900 group-hover:text-amber-700 transition-colors line-clamp-2">{{ $featuredColumn['title'] }}</h3>
                                @if($featuredColumn['summary'])
                                <p class="text-xs text-gray-600 line-clamp-2 mt-1">{{ $featuredColumn['summary'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endif
                <ul class="space-y-2">
                    @foreach(collect($columns)->where('isFeatured', false)->take(3) as $column)
                    <li>
                        <a href="{{ $column['link'] }}" class="flex items-center py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                            <span class="text-xs text-gray-400 mr-2">-</span>
                            <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">{{ $column['title'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- 기획특집 박스 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
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
            <div class="p-5">
                @php $featuredFeature = collect($features)->where('isFeatured', true)->first(); @endphp
                @if($featuredFeature)
                <a href="{{ $featuredFeature['link'] }}" class="block group mb-4">
                    <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl p-4 border border-indigo-100 hover:border-indigo-200 transition-colors">
                        <div class="flex items-start gap-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-indigo-200 to-purple-200 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                @if(isset($featuredFeature['category']))
                                <span class="inline-block px-2 py-0.5 bg-indigo-200 text-indigo-800 text-[10px] font-bold rounded mb-2">{{ $featuredFeature['category'] }}</span>
                                @endif
                                <h3 class="text-sm font-bold text-gray-900 group-hover:text-indigo-700 transition-colors line-clamp-2">{{ $featuredFeature['title'] }}</h3>
                                @if(isset($featuredFeature['summary']))
                                <p class="text-xs text-gray-600 line-clamp-2 mt-1">{{ $featuredFeature['summary'] }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </a>
                @endif
                <ul class="space-y-2">
                    @foreach(collect($features)->where('isFeatured', false)->take(3) as $feature)
                    <li>
                        <a href="{{ $feature['link'] }}" class="flex items-center py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                            <span class="text-xs text-gray-400 mr-2">-</span>
                            <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">{{ $feature['title'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        {{-- 회원동향 박스 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-sky-500 to-sky-600 flex items-center justify-center shadow-lg shadow-sky-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">회원동향</h2>
                </div>
                <a href="/news/member" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                    더보기
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
            <div class="p-5">
                <ul class="space-y-2">
                    @foreach(collect($memberTrends)->take(5) as $trend)
                    <li>
                        <a href="{{ $trend['link'] }}" class="flex items-center py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                            <span class="text-xs text-gray-400 mr-2">-</span>
                            <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">
                                <strong class="font-medium">{{ $trend['company'] }}</strong>
                                @if($trend['title']), {{ $trend['title'] }}@endif
                            </span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>

    {{-- 우측: BookReview + WordBook + 광고 --}}
    <div class="w-full lg:w-[280px] shrink-0 space-y-4">

        {{-- BookReview --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center shadow-lg shadow-teal-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">BookReview</h2>
                </div>
            </div>
            <div class="p-5">
                @foreach($bookReviews as $book)
                <a href="{{ $book['link'] }}" class="block group">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-20 bg-gradient-to-br from-gray-200 to-gray-300 rounded-lg flex items-center justify-center shrink-0">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700 group-hover:text-primary-600 transition-colors">{{ $book['title'] }}</p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- WordBook --}}
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
                    <div class="text-center py-2">
                        <p class="text-sm font-bold text-gray-800 group-hover:text-emerald-600 transition-colors">{{ $word['term'] }}</p>
                        <p class="text-xs text-gray-500 mt-1">{{ $word['definition'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        {{-- 광고 배너들 --}}
        <div class="space-y-3">
            @foreach($sidebarAds as $ad)
            <a href="{{ $ad['link'] }}" target="_blank" rel="noopener noreferrer" class="block rounded-xl overflow-hidden border border-gray-200 hover:border-primary-300 hover:shadow-md transition-all duration-200 group">
                <div class="aspect-[3/1] bg-gradient-to-br from-gray-100 to-gray-50 flex items-center justify-center p-3 group-hover:from-primary-50 group-hover:to-indigo-50 transition-colors">
                    <div class="text-center">
                        <div class="text-sm font-semibold text-gray-500 group-hover:text-primary-600 transition-colors">{{ $ad['title'] }}</div>
                        <div class="text-[10px] text-gray-400 mt-1">광고</div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

    </div>
</div>
