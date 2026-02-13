{{--
    Hero Section - ICAK 스타일 참고
    대형 텍스트 슬라이더 + 클린한 디자인
--}}
@props(['slides' => [], 'statistics' => []])

<section
    role="region"
    aria-label="메인 비주얼"
    class="relative min-h-[500px] lg:min-h-[600px] overflow-hidden"
    x-data="{
        currentSlide: 0,
        slides: [
            { title: '건설사업관리의 미래', subtitle: '한국CM협회가 함께합니다', desc: 'Construction Management for Tomorrow' },
            { title: 'CM 전문가 양성', subtitle: '체계적인 교육과 자격검정', desc: 'Professional Development & Certification' },
            { title: '회원사와 함께 성장', subtitle: '300+ 회원사 네트워크', desc: 'Growing Together with Our Members' },
            { title: '글로벌 CM 리더십', subtitle: '국제 표준을 선도합니다', desc: 'Leading Global CM Standards' }
        ],
        autoSlide: null,
        init() {
            this.autoSlide = setInterval(() => {
                this.currentSlide = (this.currentSlide + 1) % this.slides.length;
            }, 5000);
        }
    }"
>
    {{-- 배경 --}}
    <div class="absolute inset-0">
        {{-- 그라데이션 배경 --}}
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-primary-900 to-slate-900"></div>

        {{-- 패턴 오버레이 --}}
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'40\' height=\'40\' viewBox=\'0 0 40 40\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\' fill-rule=\'evenodd\'%3E%3Cpath d=\'M0 40L40 0H20L0 20M40 40V20L20 40\'/%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        {{-- 우측 장식 요소 --}}
        <div class="absolute right-0 top-0 w-1/2 h-full opacity-20">
            <div class="absolute right-0 top-1/4 w-96 h-96 bg-primary-500 rounded-full blur-[100px]"></div>
            <div class="absolute right-1/4 bottom-1/4 w-64 h-64 bg-cyan-500 rounded-full blur-[80px]"></div>
        </div>
    </div>

    {{-- 콘텐츠 --}}
    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
        <div class="flex flex-col justify-center min-h-[500px] lg:min-h-[600px] py-16">

            {{-- 슬라이드 콘텐츠 --}}
            <div class="max-w-3xl">
                {{-- 뱃지 --}}
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-8">
                    <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                    <span class="text-sm font-medium text-white/90">Since 1996 · 대한민국 CM의 중심</span>
                </div>

                {{-- 메인 타이틀 (슬라이드) - 고정 높이 컨테이너 --}}
                <div class="relative h-[180px] sm:h-[200px] lg:h-[220px]">
                    <template x-for="(slide, index) in slides" :key="index">
                        <div
                            x-show="currentSlide === index"
                            x-transition:enter="transition ease-out duration-500"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="transition ease-in duration-300 absolute inset-0"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0"
                            class="space-y-4"
                        >
                            <p class="text-primary-300 text-lg font-medium tracking-wide" x-text="slide.desc"></p>
                            <h1 class="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white leading-tight">
                                <span x-text="slide.title"></span><br>
                                <span class="text-primary-400" x-text="slide.subtitle"></span>
                            </h1>
                        </div>
                    </template>
                </div>

                {{-- CTA 버튼 --}}
                <div class="flex flex-wrap gap-4 mt-10">
                    <a
                        href="/business/certification"
                        class="inline-flex items-center gap-2 bg-primary-600 hover:bg-primary-500 text-white px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 hover:shadow-lg hover:shadow-primary-500/30"
                    >
                        CM 능력평가
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a
                        href="/intro/about"
                        class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-semibold text-lg border border-white/30 transition-all duration-300"
                    >
                        협회소개
                    </a>
                </div>

                {{-- 슬라이드 인디케이터 --}}
                <div class="flex items-center gap-3 mt-12">
                    <template x-for="(slide, index) in slides" :key="'dot-'+index">
                        <button
                            @click="currentSlide = index"
                            :class="currentSlide === index ? 'w-8 bg-primary-500' : 'w-3 bg-white/30 hover:bg-white/50'"
                            class="h-3 rounded-full transition-all duration-300"
                            :aria-label="'슬라이드 ' + (index + 1)"
                        ></button>
                    </template>
                </div>
            </div>

            {{-- 우측 통계 (데스크톱) --}}
            <div class="hidden xl:block absolute right-8 top-1/2 -translate-y-1/2">
                <div class="space-y-4">
                    @foreach($statistics as $stat)
                    <div class="bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-white/10 text-right min-w-[160px]">
                        <div class="text-3xl font-bold text-white">{{ $stat['value'] }}<span class="text-primary-400">{{ $stat['suffix'] }}</span></div>
                        <div class="text-sm text-white/60">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    {{-- 하단 웨이브 --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-12 lg:h-16" viewBox="0 0 1440 60" fill="none" preserveAspectRatio="none">
            <path d="M0 60V30C240 10 480 0 720 10C960 20 1200 40 1440 30V60H0Z" fill="white"/>
        </svg>
    </div>
</section>
