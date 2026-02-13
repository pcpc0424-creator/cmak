{{--
    Resources Section Component - 리뉴얼 버전
    자료실, 입찰정보, 전문가 칼럼 등 부가 콘텐츠

    @param array $bids - 입찰정보 데이터
    @param array $resources - 자료실 데이터
    @param array $columns - 전문가 칼럼 데이터

    특징:
    - 모던한 카드 디자인
    - 그라데이션 배경
    - 호버 인터랙션
--}}
@props(['bids' => [], 'resources' => [], 'columns' => []])

<section
    role="region"
    aria-label="자료 및 정보"
    class="space-y-0"
    x-data="{ isVisible: false }"
    x-intersect:enter="isVisible = true"
>
    <div class="grid lg:grid-cols-3 gap-6">
        {{-- 입찰 정보 --}}
        <article
            class="relative bg-gradient-to-br from-slate-800 via-slate-800 to-slate-900 rounded-2xl p-6 text-white overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-slate-900/50"
            :class="{ 'opacity-100 translate-y-0': isVisible, 'opacity-0 translate-y-4': !isVisible }"
            style="transition-delay: 0ms;"
        >
            {{-- 배경 장식 --}}
            <div class="absolute top-0 right-0 w-32 h-32 bg-cyan-500/10 rounded-full blur-2xl"></div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-primary-500/10 rounded-full blur-2xl"></div>

            <header class="relative flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-400 to-cyan-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    입/낙찰 정보
                </h2>
                <a href="/notice/tender" class="text-sm text-gray-400 hover:text-white transition-colors flex items-center gap-1 group">
                    더보기
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </header>

            <ul class="relative space-y-2">
                @forelse($bids as $bid)
                <li>
                    <a
                        href="{{ $bid['link'] }}"
                        class="flex items-start gap-3 p-3 rounded-xl hover:bg-white/5 transition-all duration-300 group border border-transparent hover:border-white/10"
                    >
                        @php
                            $typeClass = $bid['type'] === '입찰'
                                ? 'from-cyan-400 to-cyan-500 shadow-cyan-500/30'
                                : 'from-emerald-400 to-emerald-500 shadow-emerald-500/30';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-gradient-to-r {{ $typeClass }} text-white shadow-lg shrink-0 mt-0.5">
                            {{ $bid['type'] }}
                        </span>
                        <span class="text-sm text-gray-300 group-hover:text-white transition-colors line-clamp-2">
                            {{ $bid['title'] }}
                        </span>
                    </a>
                </li>
                @empty
                <li class="text-center py-8">
                    <svg class="w-10 h-10 text-gray-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                    <p class="text-gray-500 text-sm">등록된 정보가 없습니다.</p>
                </li>
                @endforelse
            </ul>
        </article>

        {{-- CM 자료방 --}}
        <article
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-hidden transition-all duration-500 hover:shadow-lg hover:border-gray-200"
            :class="{ 'opacity-100 translate-y-0': isVisible, 'opacity-0 translate-y-4': !isVisible }"
            style="transition-delay: 100ms;"
        >
            <header class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    CM 자료방
                </h2>
                <a href="/cmdata" class="text-sm text-gray-500 hover:text-primary-600 transition-colors flex items-center gap-1 group">
                    더보기
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </header>

            <ul class="space-y-2">
                @forelse($resources as $resource)
                <li>
                    <a
                        href="{{ $resource['link'] }}"
                        class="flex items-center gap-3 p-3 rounded-xl hover:bg-gray-50 transition-all duration-300 group border border-transparent hover:border-gray-100"
                    >
                        @php
                            $categoryColors = [
                                '논문' => 'from-primary-500 to-primary-600',
                                '수행사례' => 'from-cyan-500 to-cyan-600',
                                '세미나' => 'from-purple-500 to-purple-600',
                                '법령' => 'from-amber-500 to-amber-600',
                            ];
                            $bgColor = $categoryColors[$resource['category']] ?? 'from-gray-500 to-gray-600';
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-gradient-to-r {{ $bgColor }} text-white shadow-sm shrink-0">
                            {{ $resource['category'] }}
                        </span>
                        <span class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors truncate">
                            {{ $resource['title'] }}
                        </span>
                    </a>
                </li>
                @empty
                <li class="text-center py-8">
                    <svg class="w-10 h-10 text-gray-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <p class="text-gray-400 text-sm">등록된 자료가 없습니다.</p>
                </li>
                @endforelse
            </ul>
        </article>

        {{-- 전문가 칼럼 --}}
        <article
            class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 overflow-hidden transition-all duration-500 hover:shadow-lg hover:border-gray-200"
            :class="{ 'opacity-100 translate-y-0': isVisible, 'opacity-0 translate-y-4': !isVisible }"
            style="transition-delay: 200ms;"
        >
            <header class="flex items-center justify-between mb-6">
                <h2 class="text-lg font-bold text-gray-900 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-amber-400 to-amber-500 flex items-center justify-center shadow-lg shadow-amber-400/20">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    전문가 칼럼
                </h2>
                <a href="/cmdata/expert" class="text-sm text-gray-500 hover:text-primary-600 transition-colors flex items-center gap-1 group">
                    더보기
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </header>

            <ul class="space-y-3">
                @forelse($columns as $column)
                <li>
                    <a
                        href="{{ $column['link'] }}"
                        class="block p-4 rounded-xl hover:bg-gray-50 transition-all duration-300 group border border-transparent hover:border-gray-100
                            @if($column['isFeatured']) bg-gradient-to-r from-amber-50 to-orange-50 border-amber-100 hover:border-amber-200 @endif"
                    >
                        @if($column['isFeatured'])
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-[10px] font-bold bg-gradient-to-r from-amber-500 to-orange-500 text-white shadow-sm">
                                LATEST
                            </span>
                            <span class="text-[10px] text-amber-600 font-medium">추천 칼럼</span>
                        </div>
                        @endif
                        <h3 class="text-sm font-semibold text-gray-800 group-hover:text-primary-600 transition-colors mb-1.5 line-clamp-1">
                            {{ $column['title'] }}
                        </h3>
                        @if($column['summary'])
                        <p class="text-xs text-gray-500 line-clamp-2 leading-relaxed">
                            {{ $column['summary'] }}
                        </p>
                        @endif
                    </a>
                </li>
                @empty
                <li class="text-center py-8">
                    <svg class="w-10 h-10 text-gray-200 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                    </svg>
                    <p class="text-gray-400 text-sm">등록된 칼럼이 없습니다.</p>
                </li>
                @endforelse
            </ul>
        </article>
    </div>
</section>
