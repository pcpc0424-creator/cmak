@php $base = '/cmak'; @endphp
<a href="{{ $base }}/business/membership" class="{{ request()->is('business/membership') ? 'active' : '' }}">회원가입</a>
<a href="{{ $base }}/business/certification" class="{{ request()->is('business/certification') ? 'active' : '' }}">CM능력평가 공시</a>
<a href="{{ $base }}/business/confirm" class="{{ request()->is('business/confirm') ? 'active' : '' }}">CM실적확인</a>
<a href="{{ $base }}/business/confirm-online" class="{{ request()->is('business/confirm-online') ? 'active' : '' }}">온라인CM실적확인서</a>
<a href="{{ $base }}/business/inspection" class="{{ request()->is('business/inspection') ? 'active' : '' }}">자격검정</a>
<a href="{{ $base }}/business/education" class="{{ request()->is('business/education') ? 'active' : '' }}">CM전문교육</a>
<a href="{{ $base }}/business/herald" class="{{ request()->is('business/herald') ? 'active' : '' }}">CM Herald</a>
<a href="{{ $base }}/business/consma" class="{{ request()->is('business/consma') ? 'active' : '' }}">CONSMA</a>
