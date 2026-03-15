{{--
    회원사 로고 슬라이더 - ICAK 스타일
--}}
@php
    $basePath = '/cmak';
@endphp

<section class="py-10 bg-white border-t border-gray-200 overflow-hidden">
    <div class="max-w-[1420px] mx-auto px-5 mb-6">
        <h3 class="text-center text-lg font-bold text-[#212121]">회원사</h3>
    </div>

    <div class="relative">
        <div class="absolute left-0 top-0 bottom-0 w-20 bg-gradient-to-r from-white to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-20 bg-gradient-to-l from-white to-transparent z-10 pointer-events-none"></div>

        <div class="flex animate-marquee">
            @for($i = 0; $i < 2; $i++)
                @foreach($members as $member)
                    <a
                        href="{{ $member['link'] }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="flex-shrink-0 mx-6 flex items-center justify-center w-40 h-16 bg-white border border-gray-200 rounded px-4 hover:border-[#0061c2] transition-colors"
                    >
                        <img
                            src="{{ $basePath . $member['logo'] }}"
                            alt="{{ $member['name'] }}"
                            class="max-h-10 max-w-full object-contain partner-logo"
                            loading="lazy"
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                        >
                        <span class="hidden text-sm font-bold text-gray-400">{{ $member['subname'] ?? $member['name'] }}</span>
                    </a>
                @endforeach
            @endfor
        </div>
    </div>
</section>
