{{--
    하단 관련기관 링크 배너
--}}
@props(['links' => []])

<div class="flex flex-wrap items-center justify-center gap-4 md:gap-8">
    @foreach($links as $link)
    <a
        href="{{ $link['link'] }}"
        target="_blank"
        rel="noopener noreferrer"
        class="flex items-center justify-center px-4 py-3 bg-white rounded-xl border border-gray-200 hover:border-primary-300 hover:shadow-md transition-all duration-200 group min-w-[140px]"
    >
        @if(isset($link['logo']) && file_exists(public_path($link['logo'])))
        <img src="{{ $link['logo'] }}" alt="{{ $link['name'] }}" class="h-8 max-w-[120px] object-contain opacity-70 group-hover:opacity-100 transition-opacity">
        @else
        <span class="text-sm font-medium text-gray-500 group-hover:text-primary-600 transition-colors">{{ $link['name'] }}</span>
        @endif
    </a>
    @endforeach
</div>
