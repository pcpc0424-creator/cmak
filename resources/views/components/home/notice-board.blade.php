{{--
    Notice Board - ICAK 스타일 참고
    탭 전환 형태의 공지사항/소식 보드
--}}
@props(['notices' => [], 'news' => []])

<section
    role="region"
    aria-label="공지사항 및 소식"
    x-data="{ activeTab: 'notice' }"
>
    <div class="grid lg:grid-cols-5 gap-6">
        {{-- 공지사항/협회소식 탭 영역 --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                {{-- 탭 헤더 --}}
                <div class="flex border-b border-gray-100">
                    <button
                        @click="activeTab = 'notice'"
                        :class="activeTab === 'notice' ? 'text-primary-600 border-primary-600 bg-primary-50/50' : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
                        class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        공지사항
                    </button>
                    <button
                        @click="activeTab = 'news'"
                        :class="activeTab === 'news' ? 'text-primary-600 border-primary-600 bg-primary-50/50' : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
                        class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                        </svg>
                        협회소식
                    </button>
                    <button
                        @click="activeTab = 'bid'"
                        :class="activeTab === 'bid' ? 'text-primary-600 border-primary-600 bg-primary-50/50' : 'text-gray-500 border-transparent hover:text-gray-700 hover:bg-gray-50'"
                        class="flex-1 px-6 py-4 text-sm font-semibold border-b-2 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        입낙찰정보
                    </button>
                </div>

                {{-- 공지사항 탭 --}}
                <div x-show="activeTab === 'notice'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <ul class="divide-y divide-gray-50">
                        @forelse($notices as $index => $notice)
                        <li>
                            <a href="{{ $notice['link'] }}" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors group">
                                <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-gray-100 text-gray-500 text-xs font-bold flex items-center justify-center group-hover:bg-primary-100 group-hover:text-primary-600 transition-colors">
                                    {{ $index + 1 }}
                                </span>
                                <div class="flex-1 min-w-0 flex items-center gap-2">
                                    @if($notice['isNew'])
                                    <span class="px-1.5 py-0.5 bg-red-500 text-white text-[10px] font-bold rounded">N</span>
                                    @endif
                                    <span class="text-gray-800 text-sm truncate group-hover:text-primary-600 transition-colors">{{ $notice['title'] }}</span>
                                </div>
                                <time class="text-xs text-gray-400 tabular-nums">{{ \Carbon\Carbon::parse($notice['date'])->format('Y.m.d') }}</time>
                            </a>
                        </li>
                        @empty
                        <li class="px-6 py-12 text-center text-gray-400 text-sm">등록된 공지사항이 없습니다.</li>
                        @endforelse
                    </ul>
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                        <a href="/notice" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                            공지사항 더보기
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- 협회소식 탭 --}}
                <div x-show="activeTab === 'news'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <ul class="divide-y divide-gray-50">
                        @forelse($news as $index => $item)
                        <li>
                            <a href="{{ $item['link'] }}" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors group">
                                <span class="flex-shrink-0 px-2 py-1 rounded text-[10px] font-bold
                                    @if($item['category'] === '국내') bg-blue-100 text-blue-700
                                    @elseif($item['category'] === '협회') bg-primary-100 text-primary-700
                                    @elseif($item['category'] === '해외') bg-emerald-100 text-emerald-700
                                    @else bg-gray-100 text-gray-700
                                    @endif
                                ">{{ $item['category'] }}</span>
                                <span class="flex-1 text-gray-800 text-sm truncate group-hover:text-primary-600 transition-colors">{{ $item['title'] }}</span>
                                <time class="text-xs text-gray-400 tabular-nums">{{ \Carbon\Carbon::parse($item['date'])->format('Y.m.d') }}</time>
                            </a>
                        </li>
                        @empty
                        <li class="px-6 py-12 text-center text-gray-400 text-sm">등록된 소식이 없습니다.</li>
                        @endforelse
                    </ul>
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                        <a href="/news" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                            협회소식 더보기
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- 입낙찰정보 탭 --}}
                <div x-show="activeTab === 'bid'" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    <ul class="divide-y divide-gray-50">
                        @php
                            $bids = \App\Data\HomeData::getBids();
                        @endphp
                        @forelse($bids as $index => $bid)
                        <li>
                            <a href="{{ $bid['link'] }}" class="flex items-center gap-4 px-6 py-4 hover:bg-gray-50 transition-colors group">
                                <span class="flex-shrink-0 px-2 py-1 rounded text-[10px] font-bold
                                    @if($bid['type'] === '입찰') bg-cyan-100 text-cyan-700
                                    @else bg-emerald-100 text-emerald-700
                                    @endif
                                ">{{ $bid['type'] }}</span>
                                <span class="flex-1 text-gray-800 text-sm truncate group-hover:text-primary-600 transition-colors">{{ $bid['title'] }}</span>
                            </a>
                        </li>
                        @empty
                        <li class="px-6 py-12 text-center text-gray-400 text-sm">등록된 입낙찰 정보가 없습니다.</li>
                        @endforelse
                    </ul>
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100">
                        <a href="/notice/tender" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center justify-center gap-1">
                            입낙찰정보 더보기
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 우측 배너/위젯 영역 --}}
        <div class="lg:col-span-2 space-y-4">
            {{-- CM Herald 배너 --}}
            <a href="/business/herald" class="block bg-gradient-to-br from-primary-600 to-indigo-700 rounded-2xl p-6 text-white hover:shadow-lg hover:shadow-primary-500/20 transition-all duration-300 group">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="inline-block px-2 py-1 bg-white/20 rounded text-xs font-bold mb-3">월간소식지</span>
                        <h3 class="text-xl font-bold mb-2">CM Herald</h3>
                        <p class="text-sm text-white/80">최신 건설사업관리<br>동향을 확인하세요</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                </div>
            </a>

            {{-- 교육안내 배너 --}}
            <a href="/business/education" class="block bg-gradient-to-br from-cyan-500 to-teal-600 rounded-2xl p-6 text-white hover:shadow-lg hover:shadow-cyan-500/20 transition-all duration-300 group">
                <div class="flex items-start justify-between">
                    <div>
                        <span class="inline-block px-2 py-1 bg-white/20 rounded text-xs font-bold mb-3">전문교육</span>
                        <h3 class="text-xl font-bold mb-2">CM 교육</h3>
                        <p class="text-sm text-white/80">전문가 양성<br>교육과정 안내</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center group-hover:bg-white/30 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                        </svg>
                    </div>
                </div>
            </a>

            {{-- 광고 배너 영역 --}}
            @include('components.ads.banner', [
                'type' => 'square',
                'position' => 'notice-sidebar'
            ])
        </div>
    </div>
</section>
