{{--
    우측 4개 배너 카드 - ICAK 스타일
    각 카드: float left, 50% 너비, 2x2 그리드
--}}
@php
    $basePath = '/cmak';
@endphp

{{-- 배너 1: 전문가칼럼 --}}
<div class="icak-banner-card">
    <span class="icak-banner-card-title">전문가 칼럼</span>
    <div class="icak-banner-slide">
        @if(count($expertColumns) > 0)
            <a href="{{ $expertColumns[0]['link'] }}">
                <strong>{{ $expertColumns[0]['title'] }}</strong>
                <p>{{ $expertColumns[0]['summary'] ?? '' }}</p>
            </a>
        @endif
    </div>
</div>

{{-- 배너 2: 알림존 (입낙찰정보) --}}
<div class="icak-banner-card">
    <span class="icak-banner-card-title">입낙찰정보</span>
    <div class="icak-banner-list">
        <ul>
            @foreach(array_slice(\App\Data\HomeData::getBids(), 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <span class="inline-block px-1.5 py-0.5 text-[10px] font-bold rounded mr-1 {{ $item['type'] === '입찰' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">{{ $item['type'] }}</span>
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ \Carbon\Carbon::parse($item['date'])->format('m.d') }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- 배너 3: 유관기관소식 --}}
<div class="icak-banner-card">
    <span class="icak-banner-card-title">유관기관 소식</span>
    <div class="icak-banner-list">
        <ul>
            @foreach(array_slice($relatedOrgNews, 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ \Carbon\Carbon::parse($item['date'])->format('m.d') }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

{{-- 배너 4: 광고/배너 --}}
<div class="icak-banner-card">
    <span class="icak-banner-card-title">CM자료</span>
    <div class="icak-banner-slide" style="background: linear-gradient(135deg, #1a5276, #2e86c1);">
        @php $resources = \App\Data\HomeData::getResources(); @endphp
        @if(count($resources) > 0)
            <a href="{{ $resources[0]['link'] }}">
                <strong>{{ $resources[0]['title'] }}</strong>
                <p>{{ $resources[0]['category'] }} - 최신 CM 자료를 확인하세요</p>
            </a>
        @endif
    </div>
</div>
