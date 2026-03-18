{{--
    히어로 섹션 - ICAK 스타일 풀스크린 배너
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
        [
            'title' => 'IPMA KOREA',
            'highlight' => '글로벌 CM 네트워크',
            'image' => $basePath . '/images/banners/main_visual5.jpg',
        ],
    ];
@endphp

<section
    class="icak-hero"
    x-data="{
        current: 0,
        total: {{ count($slides) }},
        autoplay: true,
        init() {
            setInterval(() => {
                if (this.autoplay) this.current = (this.current + 1) % this.total;
            }, 5000);
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

    {{-- 스크롤 다운 --}}
    <div class="icak-scroll-txt hidden lg:block">
        <div class="icak-scroll-dot w-1.5 h-1.5 bg-white rounded-full mx-auto mb-2"></div>
        <span>SCROLL DOWN</span>
    </div>

    {{-- 하단 광고 배너 바 --}}
    @php
        $bottomAds = \App\Data\HomeData::getBottomAds();
    @endphp
    <div class="icak-shortcut hidden lg:flex"
         x-data="{
             scrollEl: null,
             init() {
                 this.scrollEl = this.$refs.adScroll;
                 this.autoScroll();
             },
             autoScroll() {
                 setInterval(() => {
                     if (!this.scrollEl) return;
                     const maxScroll = this.scrollEl.scrollWidth - this.scrollEl.clientWidth;
                     if (this.scrollEl.scrollLeft >= maxScroll - 2) {
                         this.scrollEl.scrollLeft = 0;
                     } else {
                         this.scrollEl.scrollLeft += 1;
                     }
                 }, 30);
             }
         }"
         @mouseenter="scrollEl = null"
         @mouseleave="scrollEl = $refs.adScroll"
    >
        <div class="icak-shortcut-title">
            <span><span class="blue">CM</span> AD</span>
        </div>
        <div class="icak-shortcut-body">
            <div class="icak-ad-scroll" x-ref="adScroll">
                @foreach($bottomAds as $ad)
                    <a href="{{ $ad['link'] }}" target="_blank" rel="noopener noreferrer" class="icak-ad-item">
                        <img src="{{ $ad['image'] }}" alt="{{ $ad['title'] }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <span class="icak-ad-fallback" style="display:none;">{{ $ad['title'] }}</span>
                    </a>
                @endforeach
                {{-- 무한 스크롤을 위한 복제 --}}
                @foreach($bottomAds as $ad)
                    <a href="{{ $ad['link'] }}" target="_blank" rel="noopener noreferrer" class="icak-ad-item">
                        <img src="{{ $ad['image'] }}" alt="{{ $ad['title'] }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <span class="icak-ad-fallback" style="display:none;">{{ $ad['title'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>
