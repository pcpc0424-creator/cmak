{{--
    메인 배너 슬라이더
--}}
@php
    $basePath = '/cmak';
    $banners = [
        [
            'image' => $basePath . '/images/banners/main_visual1.jpg',
            'alt' => '한국CM협회 메인 배너 1',
            'link' => '/intro/about',
        ],
        [
            'image' => $basePath . '/images/banners/main_visual2.jpg',
            'alt' => '한국CM협회 - CM 능력평가',
            'link' => '/business/certification',
        ],
        [
            'image' => $basePath . '/images/banners/main_visual3.jpg',
            'alt' => '한국CM협회 - CM 전문교육',
            'link' => '/business/education',
        ],
        [
            'image' => $basePath . '/images/banners/main_visual4.jpg',
            'alt' => '한국CM협회 - 자격검정',
            'link' => '/business/inspection',
        ],
        [
            'image' => $basePath . '/images/banners/main_visual5.jpg',
            'alt' => '한국CM협회 메인 배너 5',
            'link' => '#',
        ],
    ];
@endphp

<section class="relative bg-gray-900">
    <div class="relative w-full" style="padding-bottom: 33.6%;" id="banner-slider">
        @foreach($banners as $index => $banner)
        <a
            href="{{ $banner['link'] }}"
            class="banner-slide absolute inset-0 w-full h-full transition-opacity duration-500 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
            data-index="{{ $index }}"
        >
            <img
                src="{{ $banner['image'] }}"
                alt="{{ $banner['alt'] }}"
                class="w-full h-full object-cover"
            >
        </a>
        @endforeach
    </div>

    {{-- 네비게이션 화살표 --}}
    <button
        onclick="prevSlide()"
        class="absolute left-4 lg:left-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:text-primary-600 transition-all z-10"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button
        onclick="nextSlide()"
        class="absolute right-4 lg:right-8 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/90 hover:bg-white rounded-full shadow-lg flex items-center justify-center text-gray-700 hover:text-primary-600 transition-all z-10"
    >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>

    {{-- 인디케이터 --}}
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex items-center gap-2 z-10" id="banner-indicators">
        @foreach($banners as $index => $banner)
        <button
            onclick="goToSlide({{ $index }})"
            class="banner-dot h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'w-8 bg-primary-500' : 'w-3 bg-white/50 hover:bg-white/80' }}"
            data-index="{{ $index }}"
        ></button>
        @endforeach
    </div>

    {{-- 프로그레스 바 --}}
    <div class="absolute bottom-0 left-0 right-0 h-1 bg-black/20 z-10">
        <div id="banner-progress" class="h-full bg-primary-500 transition-all duration-300" style="width: 25%;"></div>
    </div>
</section>

<script>
(function() {
    let current = 0;
    const total = {{ count($banners) }};
    let autoSlide;

    function showSlide(index) {
        current = index;
        document.querySelectorAll('.banner-slide').forEach((slide, i) => {
            slide.classList.toggle('opacity-100', i === index);
            slide.classList.toggle('opacity-0', i !== index);
        });
        document.querySelectorAll('.banner-dot').forEach((dot, i) => {
            dot.classList.toggle('w-8', i === index);
            dot.classList.toggle('bg-primary-500', i === index);
            dot.classList.toggle('w-3', i !== index);
            dot.classList.toggle('bg-white/50', i !== index);
        });
        document.getElementById('banner-progress').style.width = ((index + 1) / total * 100) + '%';
    }

    window.nextSlide = function() {
        showSlide((current + 1) % total);
    };

    window.prevSlide = function() {
        showSlide((current - 1 + total) % total);
    };

    window.goToSlide = function(index) {
        showSlide(index);
    };

    // Auto slide
    autoSlide = setInterval(window.nextSlide, 5000);

    // Pause on hover
    document.getElementById('banner-slider').parentElement.addEventListener('mouseenter', () => clearInterval(autoSlide));
    document.getElementById('banner-slider').parentElement.addEventListener('mouseleave', () => {
        autoSlide = setInterval(window.nextSlide, 5000);
    });
})();
</script>
