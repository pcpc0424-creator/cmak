@php
    $base = '/cmak';
    // 목록 URL 매칭(request()->is) 또는 상세페이지에서 전달된 $activeMenuPath 매칭
    $activeMenuPath = $activeMenuPath ?? null;
    $isActive = fn($p) => request()->is($p) || ($activeMenuPath === $p);
@endphp
<a href="{{ $base }}/notice/news" class="{{ $isActive('notice/news') ? 'active' : '' }}">국내외소식</a>
<a href="{{ $base }}/notice/bids" class="{{ $isActive('notice/bids') ? 'active' : '' }}">입찰소식</a>
<a href="{{ $base }}/notice/law" class="{{ $isActive('notice/law') ? 'active' : '' }}">법령소식</a>
<a href="{{ $base }}/notice/association" class="{{ $isActive('notice/association') ? 'active' : '' }}">협회소식</a>
<a href="{{ $base }}/notice/press" class="{{ $isActive('notice/press') ? 'active' : '' }}">보도자료</a>
<a href="{{ $base }}/notice/personnel" class="{{ $isActive('notice/personnel') ? 'active' : '' }}">인사·경조사</a>
<a href="{{ $base }}/notice/member" class="{{ $isActive('notice/member') ? 'active' : '' }}">회원동향</a>
<a href="{{ $base }}/notice/org" class="{{ $isActive('notice/org') ? 'active' : '' }}">유관기관소식</a>
<a href="{{ $base }}/notice/wordbook" class="{{ $isActive('notice/wordbook') ? 'active' : '' }}">CM을 부탁해</a>
<a href="{{ $base }}/notice/bookreview" class="{{ $isActive('notice/bookreview') ? 'active' : '' }}">Book Review</a>
