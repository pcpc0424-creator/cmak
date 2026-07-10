@php $base = '/cmak'; @endphp
<a href="{{ $base }}/business/membership" class="{{ request()->is('business/membership') ? 'active' : '' }}">일반·특별회원 가입</a>
<a href="{{ $base }}/business/certification" class="{{ request()->is('business/certification') ? 'active' : '' }}">CM능력평가공시</a>
<a href="{{ $base }}/business/confirm" class="{{ request()->is('business/confirm*') ? 'active' : '' }}">CM실적 관리 및 확인서 발급</a>
<a href="{{ $base }}/business/inspection" class="{{ request()->is('business/inspection') ? 'active' : '' }}">건설사업관리사자격검정</a>
<a href="{{ $base }}/business/education" class="{{ request()->is('business/education') ? 'active' : '' }}">CM교육</a>
<a href="{{ $base }}/business/consma" class="{{ request()->is('business/consma') ? 'active' : '' }}">ConsMa</a>
<a href="{{ $base }}/business/herald" class="{{ request()->is('business/herald') ? 'active' : '' }}">CM Herald</a>
<a href="{{ $base }}/business/slogan" class="{{ request()->is('business/slogan') ? 'active' : '' }}">건설사업관리(CM)표어</a>