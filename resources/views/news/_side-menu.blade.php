@php $base = '/cmak'; @endphp
<a href="{{ $base }}/news" class="{{ request()->is('news') && !request()->is('news/*') ? 'active' : '' }}">국내외소식</a>
<a href="{{ $base }}/bids" class="{{ request()->is('bids') ? 'active' : '' }}">입낙찰정보</a>
<a href="{{ $base }}/news/member" class="{{ request()->is('news/member') ? 'active' : '' }}">회원동향</a>
