@php $base = '/cmak'; @endphp
<a href="{{ $base }}/community/faq" class="{{ request()->is('community/faq') ? 'active' : '' }}">FAQ</a>
<a href="{{ $base }}/community/board" class="{{ request()->is('community/board') ? 'active' : '' }}">자유게시판</a>
<a href="{{ $base }}/community/bookreview" class="{{ request()->is('community/bookreview') ? 'active' : '' }}">BookReview</a>
<a href="{{ $base }}/community/wordbook" class="{{ request()->is('community/wordbook') ? 'active' : '' }}">WordBook</a>
<a href="{{ $base }}/community/jobs" class="{{ request()->is('community/jobs') ? 'active' : '' }}">구인/구직</a>
