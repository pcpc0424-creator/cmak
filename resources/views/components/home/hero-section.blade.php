{{--
    히어로 섹션 - ICAK 스타일 풀스크린 배너
--}}
@php
    $basePath = '/cmak';

    // DB(hero_slides)에서 노출 슬라이드를 읽고, 없으면 기본값으로 폴백
    $fallbackSlides = [
        ['eyebrow' => 'CMAK · Since 1996', 'title' => '대한민국 건설사업관리의', 'highlight' => '미래를 선도합니다', 'image' => $basePath . '/images/banners/main_visual1.jpg'],
        ['eyebrow' => '2026 CM 능력평가 공시', 'title' => '신뢰받는 CM,', 'highlight' => '능력으로 증명합니다', 'image' => $basePath . '/images/banners/main_visual2.jpg'],
        ['eyebrow' => '전문가 양성', 'title' => '체계적인 교육과 자격으로', 'highlight' => 'CM 전문가를 양성합니다', 'image' => $basePath . '/images/banners/main_visual3.jpg'],
        ['eyebrow' => 'CM 전문교육', 'title' => '함께 배우고 함께 성장하는', 'highlight' => 'CMAK 전문교육 프로그램', 'image' => $basePath . '/images/banners/main_visual4.jpg'],
        ['eyebrow' => 'IPMA KOREA', 'title' => '세계와 함께하는', 'highlight' => '글로벌 CM 네트워크', 'image' => $basePath . '/images/banners/main_visual5.jpg'],
        ['eyebrow' => 'Sustainable Construction', 'title' => '지속가능한 건설로', 'highlight' => '내일의 가치를 만듭니다', 'image' => $basePath . '/images/banners/main_visual6.jpg'],
    ];

    try {
        $slides = \App\Models\HeroSlide::active()->orderBy('sort_order')->orderBy('id')->get()
            ->map(fn($s) => [
                'eyebrow' => $s->eyebrow,
                'title' => $s->title,
                'highlight' => $s->highlight,
                'image' => $basePath . '/' . ltrim($s->image_path, '/'),
            ])->all();
        if (empty($slides)) {
            $slides = $fallbackSlides;
        }
    } catch (\Throwable $e) {
        $slides = $fallbackSlides;
    }
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
        },
        next() { this.current = (this.current + 1) % this.total; },
        prev() { this.current = (this.current - 1 + this.total) % this.total; }
    }"
    @mouseenter="autoplay = false"
    @mouseleave="autoplay = true"
>
    {{-- 배경 슬라이드 --}}
    @foreach($slides as $index => $slide)
        <div
            class="absolute inset-0 transition-opacity ease-in-out"
            style="transition-duration: 1200ms; will-change: opacity;"
            :class="current === {{ $index }} ? 'opacity-100 z-10' : 'opacity-0 z-0'"
        >
            <div class="absolute inset-0 bg-cover bg-center hero-bg-zoom"
                 :class="current === {{ $index }} ? 'is-active' : ''"
                 style="background-image: url('{{ $slide['image'] }}')"></div>
            <div class="absolute inset-0 bg-black/40"></div>
        </div>
    @endforeach

    {{-- 좌우 네비게이션 화살표 --}}
    <button type="button" @click="prev()" class="icak-hero-arrow icak-hero-arrow-prev" aria-label="이전 슬라이드">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button type="button" @click="next()" class="icak-hero-arrow icak-hero-arrow-next" aria-label="다음 슬라이드">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- 텍스트 (좌측 중앙) - 슬라이드들이 같은 위치에 절대배치되어 자연스럽게 교차 --}}
    <div class="icak-hero-text">
        @foreach($slides as $index => $slide)
            <div
                x-show="current === {{ $index }}"
                x-transition:enter="hero-text-enter"
                x-transition:enter-start="hero-text-enter-start"
                x-transition:enter-end="hero-text-enter-end"
                x-transition:leave="hero-text-leave"
                x-transition:leave-start="hero-text-leave-start"
                x-transition:leave-end="hero-text-leave-end"
                class="icak-hero-slide-text"
                style="will-change: opacity, transform;"
            >
                <span class="icak-hero-eyebrow">{{ $slide['eyebrow'] }}</span>
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
        // CM AD — 관리자 배너(screen_type=cm_ad)에서 읽고, 없으면 기존값 폴백
        try {
            $cmAdBanners = \App\Models\Banner::active()->where('screen_type', 'cm_ad')
                ->orderBy('sort_order')->orderBy('id')->get();
            $bottomAds = $cmAdBanners->map(fn($b) => [
                'title' => $b->title,
                'image' => '/cmak/' . ltrim($b->image_path, '/'),
                'link' => $b->link_url ?: '#',
            ])->all();
            if (empty($bottomAds)) {
                $bottomAds = \App\Data\HomeData::getBottomAds();
            }
        } catch (\Throwable $e) {
            $bottomAds = \App\Data\HomeData::getBottomAds();
        }
    @endphp
    <div class="icak-shortcut hidden lg:flex"
         x-data="{
             scrollEl: null,
             dragging: false,
             moved: false,
             startX: 0,
             startScroll: 0,
             init() {
                 this.scrollEl = this.$refs.adScroll;
                 this.autoScroll();
             },
             autoScroll() {
                 setInterval(() => {
                     if (!this.scrollEl || this.dragging) return;
                     const maxScroll = this.scrollEl.scrollWidth - this.scrollEl.clientWidth;
                     if (this.scrollEl.scrollLeft >= maxScroll - 2) {
                         this.scrollEl.scrollLeft = 0;
                     } else {
                         this.scrollEl.scrollLeft += 1;
                     }
                 }, 30);
             },
             startDrag(e) {
                 this.dragging = true;
                 this.moved = false;
                 this.startX = e.pageX;
                 this.startScroll = this.$refs.adScroll.scrollLeft;
             },
             onDrag(e) {
                 if (!this.dragging) return;
                 const delta = e.pageX - this.startX;
                 if (Math.abs(delta) > 3) this.moved = true;
                 this.$refs.adScroll.scrollLeft = this.startScroll - delta;
             },
             endDrag() { this.dragging = false; }
         }"
         @mouseenter="scrollEl = null"
         @mouseleave="scrollEl = $refs.adScroll; endDrag()"
    >
        <div class="icak-shortcut-title">
            <span><span class="blue">CM</span> AD</span>
        </div>
        <div class="icak-shortcut-body">
            <div class="icak-ad-scroll" x-ref="adScroll"
                 @mousedown.prevent="startDrag($event)"
                 @mousemove="onDrag($event)"
                 @mouseup="endDrag()"
                 @click.capture="if (moved) { $event.preventDefault(); $event.stopPropagation(); }"
                 :style="dragging ? 'cursor:grabbing; user-select:none;' : 'cursor:grab; user-select:none;'">
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
