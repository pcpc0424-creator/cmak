@php
    $base = '/cmak';
    $activeMenuPath = $activeMenuPath ?? null;
    $isActive = fn($p) => request()->is($p) || ($activeMenuPath === $p);
@endphp
<a href="{{ $base }}/cmdata/about" class="{{ $isActive('cmdata/about') ? 'active' : '' }}">CM이란?</a>
<a href="{{ $base }}/business/cm-forms" class="{{ $isActive('business/cm-forms') ? 'active' : '' }}">CM 관련 서식</a>
<a href="{{ $base }}/cmdata/law" class="{{ $isActive('cmdata/law') ? 'active' : '' }}">법령정보조회</a>
<a href="{{ $base }}/cmdata/report" class="{{ $isActive('cmdata/report') ? 'active' : '' }}">논문 및 연구보고서</a>
<a href="{{ $base }}/cmdata/overseas" class="{{ $isActive('cmdata/overseas') ? 'active' : '' }}">CM해외공급사업</a>
<a href="{{ $base }}/cmdata/case" class="{{ $isActive('cmdata/case') ? 'active' : '' }}">수행사례</a>
<a href="{{ $base }}/cmdata/seminar" class="{{ $isActive('cmdata/seminar') ? 'active' : '' }}">교육 및 세미나 자료</a>
<a href="{{ $base }}/cmdata/expert" class="{{ $isActive('cmdata/expert') ? 'active' : '' }}">전문가 칼럼</a>
<a href="{{ $base }}/cmdata/special" class="{{ $isActive('cmdata/special') ? 'active' : '' }}">기획/특집</a>
<a href="{{ $base }}/cm30" class="{{ $isActive('cm30') ? 'active' : '' }}">CM30년</a>
<a href="{{ $base }}/cmdata/etc" class="{{ $isActive('cmdata/etc') ? 'active' : '' }}">기타자료</a>
