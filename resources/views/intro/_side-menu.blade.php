@php $base = '/cmak'; @endphp
<a href="{{ $base }}/intro/greeting" class="{{ request()->is('intro/greeting') ? 'active' : '' }}">협회장 인사말</a>
<a href="{{ $base }}/intro/about" class="{{ request()->is('intro/about') ? 'active' : '' }}">협회안내</a>
<a href="{{ $base }}/intro/members" class="{{ request()->is('intro/members') ? 'active' : '' }}">회원현황</a>
<a href="{{ $base }}/intro/departments" class="{{ request()->is('intro/departments') ? 'active' : '' }}">부서별 업무안내</a>
<a href="{{ $base }}/intro/articles" class="{{ request()->is('intro/articles') ? 'active' : '' }}">정관 및 제규정</a>
<a href="{{ $base }}/intro/location" class="{{ request()->is('intro/location') ? 'active' : '' }}">찾아오시는 길</a>
