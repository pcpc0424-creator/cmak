{{--
    통계 카운터 섹션
    2026 Modern Design - Count Up Animation
--}}
@php
    $stats = [
        [
            'label' => '설립연도',
            'value' => 1996,
            'suffix' => '년',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>',
        ],
        [
            'label' => '회원사',
            'value' => 500,
            'suffix' => '+',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>',
        ],
        [
            'label' => '인증 전문가',
            'value' => 5000,
            'suffix' => '+',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>',
        ],
        [
            'label' => '교육 수료생',
            'value' => 20000,
            'suffix' => '+',
            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>',
        ],
    ];
@endphp

<section
    class="relative py-20 lg:py-28 dark-section overflow-hidden"
    x-data="{
        revealed: false,
        counters: [0, 0, 0, 0],
        targets: [{{ $stats[0]['value'] }}, {{ $stats[1]['value'] }}, {{ $stats[2]['value'] }}, {{ $stats[3]['value'] }}],
        animateCounters() {
            this.targets.forEach((target, index) => {
                const duration = 2000;
                const steps = 60;
                const stepValue = target / steps;
                let current = 0;
                const interval = setInterval(() => {
                    current += stepValue;
                    if (current >= target) {
                        this.counters[index] = target;
                        clearInterval(interval);
                    } else {
                        this.counters[index] = Math.floor(current);
                    }
                }, duration / steps);
            });
        }
    }"
    x-intersect:enter.once="revealed = true; setTimeout(() => animateCounters(), 300)"
>
    {{-- 배경 장식 --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-80 h-80 bg-cyan-500/5 rounded-full blur-3xl"></div>
        {{-- 그리드 패턴 --}}
        <div class="absolute inset-0 opacity-5" style="background-image: linear-gradient(rgba(255,255,255,0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,0.05) 1px, transparent 1px); background-size: 60px 60px;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- 섹션 헤더 --}}
        <div
            class="text-center mb-16"
            :class="revealed ? 'animate-slide-in-up' : 'opacity-0'"
        >
            <span class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm text-blue-300 rounded-full text-sm font-semibold mb-4 border border-white/10">
                CMAK IN NUMBERS
            </span>
            <h2 class="text-3xl lg:text-4xl font-bold text-white mb-4">
                숫자로 보는 한국CM협회
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                1996년 설립 이래 대한민국 건설사업관리 산업의 발전을 이끌어 왔습니다
            </p>
        </div>

        {{-- 통계 그리드 --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @foreach($stats as $index => $stat)
                <div
                    class="stat-card group"
                    :class="revealed ? 'animate-slide-in-up stagger-{{ $index + 1 }}' : 'opacity-0'"
                >
                    {{-- 아이콘 --}}
                    <div class="w-16 h-16 mx-auto mb-6 rounded-2xl bg-gradient-to-br from-blue-500/20 to-cyan-500/20 flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            {!! $stat['icon'] !!}
                        </svg>
                    </div>

                    {{-- 숫자 --}}
                    <div class="stat-number mb-2" x-text="counters[{{ $index }}].toLocaleString() + '{{ $stat['suffix'] }}'">
                        0{{ $stat['suffix'] }}
                    </div>

                    {{-- 라벨 --}}
                    <p class="text-gray-400 font-medium">{{ $stat['label'] }}</p>
                </div>
            @endforeach
        </div>

        {{-- 하단 CTA --}}
        <div
            class="text-center mt-16"
            :class="revealed ? 'animate-slide-in-up stagger-5' : 'opacity-0'"
        >
            <a href="/intro/about" class="inline-flex items-center gap-2 text-blue-400 hover:text-blue-300 font-semibold group transition-colors">
                <span>협회 소개 자세히 보기</span>
                <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
