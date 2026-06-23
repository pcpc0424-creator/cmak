@php $base = '/cmak'; @endphp
<a href="{{ $base }}/notice/news" class="{{ request()->is('notice/news') ? 'active' : '' }}">국내외소식</a>
<a href="{{ $base }}/notice/bids" class="{{ request()->is('notice/bids') ? 'active' : '' }}">입찰소식</a>
<a href="{{ $base }}/notice/law" class="{{ request()->is('notice/law') ? 'active' : '' }}">법령소식</a>
<a href="{{ $base }}/notice/association" class="{{ request()->is('notice/association') ? 'active' : '' }}">협회소식</a>
<a href="{{ $base }}/notice/press" class="{{ request()->is('notice/press') ? 'active' : '' }}">보도자료</a>
<a href="{{ $base }}/notice/personnel" class="{{ request()->is('notice/personnel') ? 'active' : '' }}">인사경조사</a>
<a href="{{ $base }}/notice/member" class="{{ request()->is('notice/member') ? 'active' : '' }}">회원동향</a>
<a href="{{ $base }}/notice/org" class="{{ request()->is('notice/org') ? 'active' : '' }}">유관기관소식</a>
<a href="{{ $base }}/notice/wordbook" class="{{ request()->is('notice/wordbook') ? 'active' : '' }}">Word Book</a>
<a href="{{ $base }}/notice/bookreview" class="{{ request()->is('notice/bookreview') ? 'active' : '' }}">Book Review</a>
