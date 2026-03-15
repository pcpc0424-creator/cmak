@php $base = '/cmak'; @endphp
<a href="{{ $base }}/reference/domestic" class="{{ request()->is('reference/domestic') ? 'active' : '' }}">국내관련기관</a>
<a href="{{ $base }}/reference/overseas" class="{{ request()->is('reference/overseas') ? 'active' : '' }}">해외관련기관</a>
<a href="{{ $base }}/reference/media" class="{{ request()->is('reference/media') ? 'active' : '' }}">언론관련기관</a>
<a href="{{ $base }}/reference/bidding" class="{{ request()->is('reference/bidding') ? 'active' : '' }}">입찰관련기관</a>
