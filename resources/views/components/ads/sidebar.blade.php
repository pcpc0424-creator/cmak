{{--
    사이드바 광고 영역 컴포넌트
    스크롤 시 상단에 고정되는 스티키 사이드바
--}}
@props(['class' => ''])

<aside class="hidden xl:block w-[180px] shrink-0 {{ $class }}" aria-label="광고">
    <div class="sticky top-32 space-y-6">
        {{-- 세로 배너 1 --}}
        @include('components.ads.banner', [
            'type' => 'vertical',
            'position' => 'sidebar-top'
        ])

        {{-- 정사각형 배너 --}}
        @include('components.ads.banner', [
            'type' => 'square',
            'position' => 'sidebar-middle'
        ])
    </div>
</aside>
