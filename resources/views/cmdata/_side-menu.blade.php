@php $base = '/cmak'; @endphp
<a href="{{ $base }}/cmdata/about" class="{{ request()->is('cmdata/about') ? 'active' : '' }}">CM이란?</a>
<a href="{{ $base }}/business/cm-forms" class="{{ request()->is('business/cm-forms') ? 'active' : '' }}">CM 가이드</a>
<a href="{{ $base }}/cmdata/procedure" class="{{ request()->is('cmdata/procedure') ? 'active' : '' }}">CM업무절차서</a>
<a href="{{ $base }}/cmdata/task-spec" class="{{ request()->is('cmdata/task-spec') ? 'active' : '' }}">CM표준과업내용서</a>
<a href="{{ $base }}/cmdata/contract" class="{{ request()->is('cmdata/contract') ? 'active' : '' }}">CM표준계약서</a>
<a href="{{ $base }}/cmdata/law" class="{{ request()->is('cmdata/law') ? 'active' : '' }}">법령정보조회</a>
<a href="{{ $base }}/cmdata/report" class="{{ request()->is('cmdata/report') ? 'active' : '' }}">논문 및 연구보고서</a>
<a href="{{ $base }}/cmdata/overseas" class="{{ request()->is('cmdata/overseas') ? 'active' : '' }}">CM해외공급사업</a>
<a href="{{ $base }}/cmdata/case" class="{{ request()->is('cmdata/case') ? 'active' : '' }}">수행사례</a>
<a href="{{ $base }}/cmdata/seminar" class="{{ request()->is('cmdata/seminar') ? 'active' : '' }}">교육 및 세미나 자료</a>
<a href="{{ $base }}/cmdata/expert" class="{{ request()->is('cmdata/expert') ? 'active' : '' }}">전문가 칼럼</a>
<a href="{{ $base }}/cmdata/special" class="{{ request()->is('cmdata/special') ? 'active' : '' }}">기획/특집</a>
<a href="{{ $base }}/cmdata/etc" class="{{ request()->is('cmdata/etc') ? 'active' : '' }}">기타자료</a>
