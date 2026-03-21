@php $base = '/cmak'; @endphp
<a href="{{ $base }}/cmdata/about" class="{{ request()->is('*/cmdata/about') ? 'active' : '' }}">CM이란</a>
<a href="{{ $base }}/cmdata/report" class="{{ request()->is('*/cmdata/report') ? 'active' : '' }}">연구자료</a>
<a href="{{ $base }}/cmdata/law" class="{{ request()->is('*/cmdata/law') ? 'active' : '' }}">CM관련법령</a>
<a href="{{ $base }}/cmdata/seminar" class="{{ request()->is('*/cmdata/seminar') ? 'active' : '' }}">교육세미나</a>
<a href="{{ $base }}/cmdata/ve" class="{{ request()->is('*/cmdata/ve') ? 'active' : '' }}">VE자료</a>
<a href="{{ $base }}/cmdata/expert" class="{{ request()->is('*/cmdata/expert') ? 'active' : '' }}">전문가칼럼</a>
<a href="{{ $base }}/cmdata/special" class="{{ request()->is('*/cmdata/special') ? 'active' : '' }}">특집</a>
<a href="{{ $base }}/cmdata/etc" class="{{ request()->is('*/cmdata/etc') ? 'active' : '' }}">기타자료</a>
<a href="{{ $base }}/cmdata/press" class="{{ request()->is('*/cmdata/press') ? 'active' : '' }}">언론보도</a>
<a href="{{ $base }}/cmdata/case" class="{{ request()->is('*/cmdata/case') ? 'active' : '' }}">CM사례</a>
<a href="{{ $base }}/cmdata/education" class="{{ request()->is('*/cmdata/education') ? 'active' : '' }}">교육자료</a>
