{{--
    회원동향 섹션
--}}
@props(['trends' => [], 'cmCompany' => []])

<div class="grid lg:grid-cols-3 gap-6">
    {{-- 회원동향 (좌측 2/3) --}}
    <div class="lg:col-span-2">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full">
            {{-- 헤더 --}}
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

            {{-- 콘텐츠 --}}
            <div class="p-5">
                <div class="grid md:grid-cols-2 gap-4">
                    {{-- 이미지 카드 (첫 2개) --}}
                    @foreach(collect($trends)->take(2) as $index => $trend)
                    <a href="{{ $trend['link'] }}" class="block group">
                        <div class="bg-gray-50 rounded-xl overflow-hidden border border-gray-100 hover:border-sky-200 transition-colors">
                            <div class="aspect-video bg-gradient-to-br from-sky-100 to-sky-200 flex items-center justify-center">
                                @if(isset($trend['image']) && file_exists(public_path($trend['image'])))
                                <img src="{{ $trend['image'] }}" alt="{{ $trend['company'] }}" class="w-full h-full object-cover">
                                @else
                                <svg class="w-16 h-16 text-sky-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                @endif
                            </div>
                            <div class="p-3">
                                <p class="text-sm font-medium text-gray-800 group-hover:text-sky-600 transition-colors line-clamp-2">
                                    {{ $trend['company'] }}
                                </p>
                                @if($trend['title'])
                                <p class="text-xs text-gray-500 mt-1 line-clamp-1">{{ $trend['title'] }}</p>
                                @endif
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>

                {{-- 텍스트 목록 (나머지) --}}
                <ul class="mt-4 space-y-2">
                    @foreach(collect($trends)->skip(2)->take(3) as $trend)
                    <li>
                        <a href="{{ $trend['link'] }}" class="flex items-center justify-between py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                            <div class="flex items-center gap-2 min-w-0">
                                <span class="text-xs text-gray-400">-</span>
                                <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">
                                    <strong class="font-medium">{{ $trend['company'] }}</strong>
                                    @if($trend['title']), {{ $trend['title'] }}@endif
                                </span>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- CM사 소개 (우측 1/3) --}}
    <div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden h-full">
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-500 to-violet-600 flex items-center justify-center shadow-lg shadow-violet-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                    <h2 class="text-lg font-bold text-gray-900">CM사 소개</h2>
                </div>
            </div>
            <div class="p-5">
                <a href="{{ $cmCompany['link'] ?? '/intro/members' }}" class="block group">
                    <div class="text-center py-4 bg-gradient-to-br from-violet-50 to-indigo-50 rounded-xl border border-violet-100">
                        <div class="w-20 h-20 mx-auto bg-white rounded-xl shadow-sm flex items-center justify-center mb-4">
                            <svg class="w-10 h-10 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-gray-800 group-hover:text-violet-600 transition-colors mb-3">{{ $cmCompany['company'] ?? '' }}</p>
                        <div class="text-xs text-gray-500 space-y-1">
                            <p>전화 {{ $cmCompany['phone'] ?? '' }}</p>
                            <p>팩스 {{ $cmCompany['fax'] ?? '' }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
