{{--
    히어로 섹션 - ICAK 스타일 풀스크린 배너 + 우측 팝업존
--}}
@php
    $basePath = '/cmak';
    $slides = [
        [
            'title' => '건설사업관리의',
            'highlight' => '미래를 선도합니다',
            'image' => $basePath . '/images/banners/main_visual1.jpg',
        ],
        [
            'title' => '2026년',
            'highlight' => 'CM 능력평가 공시',
            'image' => $basePath . '/images/banners/main_visual2.jpg',
        ],
        [
            'title' => '전문가 양성을 위한',
            'highlight' => 'CM 자격검정',
            'image' => $basePath . '/images/banners/main_visual3.jpg',
        ],
        [
            'title' => '함께 성장하는',
            'highlight' => 'CM 전문교육',
            'image' => $basePath . '/images/banners/main_visual4.jpg',
        ],
    ];

    // 팝업존 슬라이드 데이터
    $popupSlides = [
        [
            'type' => 'banner',
            'image' => $basePath . '/images/ads/popup_banner1.jpg',
            'link' => '/business/education',
            'fallbackText' => 'CM 전문교육 안내',
        ],
        [
            'type' => 'special',
            'category' => '전문가칼럼',
            'title' => '리모델링 성공수행 핵심키워드는 CM이다',
            'desc' => '리모델링, 설계·구조·토목 등 철저한 검증 바탕 사업관리 중요.',
            'link' => '/cmdata/expert/1',
        ],
        [
            'type' => 'brief',
            'category' => '보도자료',
            'title' => '2026년도 건설사업관리(CM)능력평가·공시 안내',
            'desc' => '건설사업관리 능력을 객관적으로 평가하고 공시합니다.',
            'link' => '/notice/press/1',
        ],
    ];
@endphp

<section
    class="icak-hero"
    x-data="{
        current: 0,
        total: {{ count($slides) }},
        autoplay: true,
        popCurrent: 0,
        popTotal: {{ count($popupSlides) }},
        popAutoplay: true,
        init() {
            setInterval(() => {
                if (this.autoplay) this.current = (this.current + 1) % this.total;
            }, 5000);
            setInterval(() => {
                if (this.popAutoplay) this.popCurrent = (this.popCurrent + 1) % this.popTotal;
            }, 4000);
        }
    }"
    @mouseenter="autoplay = false"
    @mouseleave="autoplay = true"
>
    {{-- 배경 슬라이드 --}}
    @foreach($slides as $index => $slide)
        <div
            class="absolute inset-0 transition-opacity duration-1000"
            :class="current === {{ $index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'"
        >
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ $slide['image'] }}')"></div>
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    @endforeach

    {{-- 텍스트 (좌측 중앙) --}}
    <div class="icak-hero-text" style="width: 900px; max-width: 90vw;">
        @foreach($slides as $index => $slide)
            <div
                x-show="current === {{ $index }}"
                x-transition:enter="transition ease-out duration-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
                <h2>{{ $slide['title'] }}<br><strong>{{ $slide['highlight'] }}</strong></h2>
            </div>
        @endforeach
    </div>

    {{-- 팝업존 (우측 플로팅 카드) --}}
    <div class="popupzone-wrapper hidden lg:block"
         @mouseenter="popAutoplay = false"
         @mouseleave="popAutoplay = true"
    >
        <div class="popupzone-con">
            @foreach($popupSlides as $pIdx => $popup)
                <div
                    class="popupzone-slide"
                    x-show="popCurrent === {{ $pIdx }}"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                >
                    @if($popup['type'] === 'banner')
                        <a href="{{ $popup['link'] }}" class="popupzone-banner-link">
                            <img src="{{ $popup['image'] }}" alt="{{ $popup['fallbackText'] }}"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="popupzone-fallback" style="display:none;">
                                <span>{{ $popup['fallbackText'] }}</span>
                            </div>
                        </a>
                    @else
                        <a href="{{ $popup['link'] }}" class="popupzone-content popupzone-{{ $popup['type'] }}">
                            <div class="popupzone-txt">
                                <span class="popupzone-category">{{ $popup['category'] }}</span>
                                <p class="popupzone-title">{{ $popup['title'] }}</p>
                                <p class="popupzone-desc">{{ $popup['desc'] }}</p>
                            </div>
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- 하단 컨트롤 바 --}}
        <div class="popupzone-bom">
            <button @click="popCurrent = (popCurrent - 1 + popTotal) % popTotal" class="popupzone-prev" aria-label="이전">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <div class="popupzone-page">
                <span class="popupzone-current" x-text="popCurrent + 1"></span>/<span class="popupzone-total">{{ count($popupSlides) }}</span>
            </div>
            <button @click="popAutoplay = !popAutoplay" class="popupzone-playpause" aria-label="재생/정지">
                <template x-if="popAutoplay">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4h4v16H6zm8 0h4v16h-4z"/></svg>
                </template>
                <template x-if="!popAutoplay">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
                </template>
            </button>
            <button @click="popCurrent = (popCurrent + 1) % popTotal" class="popupzone-next" aria-label="다음">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>
    </div>

    {{-- 스크롤 다운 --}}
    <div class="icak-scroll-txt hidden lg:block">
        <div class="icak-scroll-dot w-1.5 h-1.5 bg-white rounded-full mx-auto mb-2"></div>
        <span>SCROLL DOWN</span>
    </div>

    {{-- 하단 퀵링크 바 --}}
    <div class="icak-shortcut hidden lg:flex">
        <div class="icak-shortcut-title">
            <span><span class="blue">주요사업</span> 안내</span>
        </div>
        <div class="icak-shortcut-body">
            <div class="icak-shortcut-list">
                <a href="/business/certification">CM능력평가 공시</a>
                <a href="/business/inspection">자격검정</a>
                <a href="/business/education">CM전문교육</a>
                <a href="/business/membership">회원가입</a>
                <a href="/business/herald">CM Herald</a>
                <a href="/cmdata/about">CM이란</a>
                <a href="/cmdata/report">논문/연구보고서</a>
            </div>
        </div>
    </div>
</section>
