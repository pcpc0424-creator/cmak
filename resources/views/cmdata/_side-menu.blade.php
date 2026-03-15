@php $base = '/cmak'; @endphp
<a href="{{ $base }}/cmdata/about" class="{{ request()->is('cmdata/about') ? 'active' : '' }}">CM이란</a>
<a href="{{ $base }}/cmdata/law" class="{{ request()->is('cmdata/law') ? 'active' : '' }}">법령정보</a>
<a href="{{ $base }}/cmdata/report" class="{{ request()->is('cmdata/report') ? 'active' : '' }}">논문/연구보고서</a>
<a href="{{ $base }}/cmdata/global" class="{{ request()->is('cmdata/global') ? 'active' : '' }}">해외CM</a>
<a href="{{ $base }}/cmdata/case" class="{{ request()->is('cmdata/case') ? 'active' : '' }}">수행사례</a>
<a href="{{ $base }}/cmdata/seminar" class="{{ request()->is('cmdata/seminar') ? 'active' : '' }}">교육/세미나</a>
<a href="{{ $base }}/cmdata/expert" class="{{ request()->is('cmdata/expert') ? 'active' : '' }}">전문가칼럼</a>
<a href="{{ $base }}/cmdata/special" class="{{ request()->is('cmdata/special') ? 'active' : '' }}">기획/특집</a>
<a href="{{ $base }}/cmdata/etc" class="{{ request()->is('cmdata/etc') ? 'active' : '' }}">기타자료</a>
