{{--
    공지사항/입찰공고/보도자료 탭 카드 - ICAK 스타일
    좌측 상단 카드 (height: 280px, border: 1px solid #e1e1e1, border-radius: 8px)
--}}
<div class="icak-cont" x-data="{ tab: 'notice' }">
    {{-- 탭 영역 --}}
    <div class="icak-tab-area">
        <ul>
            <li>
                <button @click="tab = 'notice'" class="icak-tab-btn" :class="tab === 'notice' && 'active'">공지사항</button>
            </li>
            <li>
                <button @click="tab = 'bid'" class="icak-tab-btn" :class="tab === 'bid' && 'active'">입낙찰정보</button>
            </li>
            <li>
                <button @click="tab = 'domestic'" class="icak-tab-btn" :class="tab === 'domestic' && 'active'">국내외소식</button>
            </li>
            <li>
                <button @click="tab = 'legal'" class="icak-tab-btn" :class="tab === 'legal' && 'active'">법령소식</button>
            </li>
            <li>
                <button @click="tab = 'press'" class="icak-tab-btn" :class="tab === 'press' && 'active'">보도자료</button>
            </li>
        </ul>
        <a href="/notice" class="icak-more-circle" title="더보기">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </a>
    </div>

    {{-- 공지사항 --}}
    <div class="icak-list" x-show="tab === 'notice'">
        <ul>
            @foreach(array_slice($notices, 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ $item['date'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- 입낙찰정보 --}}
    <div class="icak-list" x-show="tab === 'bid'" x-cloak>
        <ul>
            @foreach(array_slice($bids, 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <p><span class="inline-block px-1.5 py-0.5 text-[10px] font-bold rounded mr-1 {{ $item['type'] === '입찰' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">{{ $item['type'] }}</span>{{ $item['title'] }}</p>
                        <span class="date">{{ $item['date'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- 국내외소식 --}}
    <div class="icak-list" x-show="tab === 'domestic'" x-cloak>
        <ul>
            @foreach(array_slice($domesticNews, 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ $item['date'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- 법령소식 --}}
    <div class="icak-list" x-show="tab === 'legal'" x-cloak>
        <ul>
            @foreach(array_slice($legalNews, 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ $item['date'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

    {{-- 보도자료 --}}
    <div class="icak-list" x-show="tab === 'press'" x-cloak>
        <ul>
            @foreach(array_slice($pressReleases, 0, 4) as $item)
                <li>
                    <a href="{{ $item['link'] }}">
                        <p>{{ $item['title'] }}</p>
                        <span class="date">{{ $item['date'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
