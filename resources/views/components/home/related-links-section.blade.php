{{--
    관련기관 링크 섹션 - ICAK 스타일
--}}
@php
    $basePath = '/cmak';
@endphp

<section class="py-8 bg-[#f4f6f9] border-t border-gray-200">
    <div class="icak-container">
        <div class="flex flex-wrap items-center justify-center gap-6">
            @foreach($relatedLinks as $link)
                <a
                    href="{{ $link['link'] }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="flex items-center justify-center w-36 h-12 bg-white border border-gray-200 rounded px-3 hover:border-[#265de8] hover:shadow-sm transition-all"
                >
                    <img
                        src="{{ $basePath . $link['logo'] }}"
                        alt="{{ $link['name'] }}"
                        class="max-h-8 max-w-full object-contain"
                        loading="lazy"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='block';"
                    >
                    <span class="hidden text-xs font-medium text-gray-500">{{ $link['name'] }}</span>
                </a>
            @endforeach
        </div>
    </div>
</section>
