{{--
    Partners Section Component
    회원사/파트너 로고 배너

    @param array $partners - 파트너 데이터 (HomeData::getPartners())

    접근성:
    - 자동 스크롤 시 prefers-reduced-motion 고려
    - 회사 이름을 alt 텍스트로 제공
--}}
@props(['partners' => []])

<section
    role="region"
    aria-label="회원사"
    class="py-10 bg-white border-t border-b border-gray-100"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-sm font-medium text-gray-500 mb-8">
            함께하는 회원사
        </h2>

        <!-- Partner Logos -->
        <div class="flex flex-wrap justify-center items-center gap-8 lg:gap-12">
            @foreach($partners as $partner)
            <div class="w-28 h-12 flex items-center justify-center grayscale hover:grayscale-0 opacity-60 hover:opacity-100 transition-all">
                {{-- 실제 로고 이미지가 있을 경우 --}}
                {{-- <img src="{{ $partner['logo'] }}" alt="{{ $partner['name'] }}" class="max-w-full max-h-full object-contain"> --}}

                {{-- 더미: 텍스트로 표시 --}}
                <span class="text-sm font-bold text-gray-400 uppercase tracking-wide">
                    {{ $partner['name'] }}
                </span>
            </div>
            @endforeach
        </div>
    </div>
</section>
