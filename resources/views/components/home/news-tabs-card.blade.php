{{--
    협회소식 카드 - ICAK 스타일 썸네일 리스트
    좌측 하단 카드 (height: 280px)
--}}
@php
    $basePath = '/cmak';
@endphp

<div class="icak-cont">
    {{-- 탭 영역 --}}
    <div class="icak-tab-area">
        <ul>
            <li>
                <button class="icak-tab-btn active">협회소식</button>
            </li>
        </ul>
        <a href="/news" class="icak-more-circle" title="더보기">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    {{-- 썸네일 리스트 --}}
    <div class="icak-list-thumb">
        <ul>
            @foreach(array_slice($news, 0, 3) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <div class="img">
                            <img src="{{ $basePath }}/images/news/news{{ $item['id'] }}.jpg" alt="{{ $item['title'] }}" onerror="this.style.display='none'">
                        </div>
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ $item['date'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
