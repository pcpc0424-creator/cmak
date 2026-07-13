@php
    $base = '/cmak';
    $activeMenuPath = $activeMenuPath ?? null;
    $isActive = fn($p) => request()->is($p) || ($activeMenuPath === $p);
@endphp
<a href="{{ $base }}/community/faq" class="{{ $isActive('community/faq') ? 'active' : '' }}">FAQ</a>
<a href="{{ $base }}/community/board" class="{{ $isActive('community/board') ? 'active' : '' }}">자유게시판</a>
<a href="{{ $base }}/community/job-offer" class="{{ $isActive('community/job-offer') ? 'active' : '' }}">구인</a>
<a href="{{ $base }}/community/job-seek" class="{{ $isActive('community/job-seek') ? 'active' : '' }}">구직</a>
