@php
    $base = '/cmak';
    $activeMenuPath = $activeMenuPath ?? null;
    $isActive = fn($p) => request()->is($p) || ($activeMenuPath === $p);
@endphp
<a href="{{ $base }}/business/membership" class="{{ $isActive('business/membership') ? 'active' : '' }}">일반·특별회원 가입</a>
<a href="{{ $base }}/business/certification" class="{{ $isActive('business/certification') ? 'active' : '' }}">CM능력평가공시</a>
<a href="{{ $base }}/business/confirm" class="{{ $isActive('business/confirm*') ? 'active' : '' }}">CM실적 관리 및 확인서 발급</a>
<a href="{{ $base }}/business/inspection" class="{{ $isActive('business/inspection') ? 'active' : '' }}">건설사업관리사자격검정</a>
<a href="{{ $base }}/business/education" class="{{ $isActive('business/education') ? 'active' : '' }}">CM교육</a>
<a href="{{ $base }}/business/consma" class="{{ $isActive('business/consma') ? 'active' : '' }}">ConsMa</a>
<a href="{{ $base }}/business/herald" class="{{ $isActive('business/herald') ? 'active' : '' }}">CM Herald</a>
<a href="{{ $base }}/business/slogan" class="{{ $isActive('business/slogan') ? 'active' : '' }}">건설사업관리(CM)표어</a>