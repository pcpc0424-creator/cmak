{{--
    회원사 가로 배너 슬라이더 컴포넌트
    자동 슬라이드 + 호버시 정지
--}}
@props(['members' => []])

<div
    class="relative"
    x-data="{
        currentIndex: 0,
        itemsPerView: 5,
        autoSlide: null,
        isPaused: false,
        init() {
            this.updateItemsPerView();
            this.startAutoSlide();
            window.addEventListener('resize', () => this.updateItemsPerView());
        },
        updateItemsPerView() {
            if (window.innerWidth < 640) {
                this.itemsPerView = 2;
            } else if (window.innerWidth < 768) {
                this.itemsPerView = 3;
            } else if (window.innerWidth < 1024) {
                this.itemsPerView = 4;
            } else {
                this.itemsPerView = 5;
            }
        },
        startAutoSlide() {
            this.autoSlide = setInterval(() => {
                if (!this.isPaused) {
                    this.next();
                }
            }, 3000);
        },
        next() {
            const maxIndex = Math.max(0, {{ count($members) }} - this.itemsPerView);
            this.currentIndex = this.currentIndex >= maxIndex ? 0 : this.currentIndex + 1;
        },
        prev() {
            const maxIndex = Math.max(0, {{ count($members) }} - this.itemsPerView);
            this.currentIndex = this.currentIndex <= 0 ? maxIndex : this.currentIndex - 1;
        }
    }"
    @mouseenter="isPaused = true"
    @mouseleave="isPaused = false"
>
    <div class="overflow-hidden">
        <div
            class="flex transition-transform duration-500 ease-out"
            :style="`transform: translateX(-${currentIndex * (100 / itemsPerView)}%)`"
        >
            @foreach($members as $member)
            <a
                href="{{ $member['link'] }}"
                target="_blank"
                rel="noopener noreferrer"
                class="shrink-0 px-2"
                :style="`width: ${100 / itemsPerView}%`"
            >
                <div class="bg-gray-50 hover:bg-white rounded-xl p-4 h-24 flex items-center justify-center border border-gray-200 hover:border-primary-300 hover:shadow-md transition-all duration-200 group">
                    <div class="text-center">
                        @if($member['description'])
                        <div class="text-[10px] text-gray-400 mb-1">{{ $member['description'] }}</div>
                        @endif
                        <div class="text-sm font-bold text-gray-700 group-hover:text-primary-600 transition-colors">{{ $member['subname'] }}</div>
                        @if($member['name'] !== $member['subname'])
                        <div class="text-xs text-gray-500 mt-0.5">{{ $member['name'] }}</div>
                        @endif
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- 네비게이션 버튼 --}}
    <button
        @click="prev()"
        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-3 w-8 h-8 bg-white rounded-full shadow-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:text-primary-600 hover:border-primary-300 transition-colors z-10"
        aria-label="이전"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
    </button>
    <button
        @click="next()"
        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-3 w-8 h-8 bg-white rounded-full shadow-lg border border-gray-200 flex items-center justify-center text-gray-500 hover:text-primary-600 hover:border-primary-300 transition-colors z-10"
        aria-label="다음"
    >
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
    </button>
</div>
