@php $base = '/cmak'; @endphp
<a href="{{ $base }}/intro/greeting" class="{{ request()->is('intro/greeting') ? 'active' : '' }}">협회장 인사말</a>
<a href="{{ $base }}/intro/about" class="{{ request()->is('intro/about') ? 'active' : '' }}">협회안내</a>
<a href="{{ $base }}/intro/history" class="{{ request()->is('intro/history') ? 'active' : '' }}">주요연혁</a>
<a href="{{ $base }}/intro/organization" class="{{ request()->is('intro/organization') ? 'active' : '' }}">조직 및 구성</a>
<a href="{{ $base }}/intro/presidents" class="{{ request()->is('intro/presidents') ? 'active' : '' }}">역대 회장단</a>
<a href="{{ $base }}/intro/plan" class="{{ request()->is('intro/plan') ? 'active' : '' }}">사업계획</a>
<a href="{{ $base }}/intro/members" class="{{ request()->is('intro/members') ? 'active' : '' }}">회원현황</a>
<a href="{{ $base }}/intro/departments" class="{{ request()->is('intro/departments') ? 'active' : '' }}">부서별 업무안내</a>
<a href="{{ $base }}/intro/articles" class="{{ request()->is('intro/articles') ? 'active' : '' }}">정관 및 제규정</a>
<a href="{{ $base }}/intro/location" class="{{ request()->is('intro/location') ? 'active' : '' }}">찾아오시는 길</a>
