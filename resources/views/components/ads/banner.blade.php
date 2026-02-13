{{--
    광고 배너 컴포넌트

    @param string $type - 배너 타입: 'horizontal', 'vertical', 'square'
    @param string $position - 배너 위치 식별자 (광고 관리용)
    @param string $class - 추가 CSS 클래스

    Usage:
    @include('components.ads.banner', ['type' => 'horizontal', 'position' => 'main-top'])
--}}
@props([
    'type' => 'horizontal',
    'position' => 'default',
    'class' => ''
])

@php
    $sizes = [
        'horizontal' => [
            'wrapper' => 'w-full',
            'inner' => 'h-[90px] md:h-[100px]',
            'label' => '728x90'
        ],
        'horizontal-large' => [
            'wrapper' => 'w-full',
            'inner' => 'h-[200px] md:h-[250px]',
            'label' => '970x250'
        ],
        'vertical' => [
            'wrapper' => 'w-full',
            'inner' => 'h-[600px]',
            'label' => '160x600'
        ],
        'square' => [
            'wrapper' => 'w-full',
            'inner' => 'h-[250px]',
            'label' => '300x250'
        ],
        'mobile' => [
            'wrapper' => 'w-full',
            'inner' => 'h-[100px]',
            'label' => '320x100'
        ]
    ];
    $size = $sizes[$type] ?? $sizes['horizontal'];
@endphp

<div
    class="ad-banner {{ $size['wrapper'] }} {{ $class }}"
    data-ad-position="{{ $position }}"
    data-ad-type="{{ $type }}"
>
    <div class="relative {{ $size['inner'] }} bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl overflow-hidden group">
        {{-- 광고 이미지/콘텐츠가 들어갈 영역 --}}
        <a
            href="#"
            class="block w-full h-full"
            target="_blank"
            rel="noopener sponsored"
            aria-label="광고 배너 - {{ $position }}"
        >
            {{-- 플레이스홀더 (실제 광고 이미지로 교체) --}}
            <div class="absolute inset-0 flex flex-col items-center justify-center text-slate-400 group-hover:text-slate-500 transition-colors">
                <svg class="w-8 h-8 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span class="text-xs font-medium">광고 영역</span>
                <span class="text-[10px] opacity-60">{{ $size['label'] }}</span>
            </div>

            {{-- 호버 효과 --}}
            <div class="absolute inset-0 bg-primary-600/0 group-hover:bg-primary-600/5 transition-colors duration-300"></div>
        </a>

        {{-- 광고 표시 라벨 --}}
        <span class="absolute top-2 right-2 px-1.5 py-0.5 bg-black/30 text-white text-[9px] rounded backdrop-blur-sm">
            AD
        </span>
    </div>
</div>
