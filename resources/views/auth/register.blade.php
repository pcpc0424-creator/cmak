@extends('layouts.sub')

@section('title', '회원가입 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/login')
@section('page-title', '회원가입')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원가입</h2>
    <p class="sub-content-desc">한국CM협회 회원으로 가입합니다. <span style="color:#d00;">*</span> 표시는 필수 입력 항목입니다.</p>

    @if ($errors->any())
        <div style="margin:16px 0; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/register') }}" method="POST" style="max-width:680px; margin:20px auto 0;">
        @csrf

        {{-- 약관 동의 --}}
        <div x-data="{ terms: false, privacy: false }" style="margin-bottom:24px;">
            <h3 style="font-size:15px; font-weight:700; color:#1e2a4a; margin-bottom:12px;">약관 동의</h3>

            {{-- 이용약관 --}}
            <div style="border:1px solid #e3e8f0; border-radius:10px; margin-bottom:12px; overflow:hidden;">
                <div style="display:flex; align-items:center; justify-content:space-between; padding:12px 16px; background:#f9fbfd;">
                    <label style="display:flex; align-items:center; gap:8px; font-size:14px; color:#333; cursor:pointer; margin:0;">
                        <input type="checkbox" name="agree_terms" value="1" {{ old('agree_terms') ? 'checked' : '' }}>
                        <span><span style="color:#d00;">*</span> 이용약관에 동의합니다.</span>
                    </label>
                    <button type="button" @click="terms = !terms" style="background:none; border:0; color:#777; font-size:13px; cursor:pointer; white-space:nowrap;">
                        약관 보기 <span x-text="terms ? '▲' : '▼'"></span>
                    </button>
                </div>
                <div x-show="terms" x-transition style="max-height:240px; overflow-y:auto; padding:14px 16px; border-top:1px solid #eef1f6; font-size:12.5px; line-height:1.6; color:#555;">
                    @php $tA = \App\Models\PageContent::bySlug('terms_agreement'); @endphp
                    @if($tA && $tA->content){!! $tA->content !!}@else @include('auth._terms_agreement')@endif
                </div>
            </div>

            {{-- 개인정보처리방침 --}}
            <div style="border:1px solid #e3e8f0; border-radius:10px; margin-bottom:12px; overflow:hidden;">
                <div style="display:flex; align-items:center; justify-content:space-between; padding:12px 16px; background:#f9fbfd;">
                    <label style="display:flex; align-items:center; gap:8px; font-size:14px; color:#333; cursor:pointer; margin:0;">
                        <input type="checkbox" name="agree_privacy" value="1" {{ old('agree_privacy') ? 'checked' : '' }}>
                        <span><span style="color:#d00;">*</span> 개인정보처리방침에 동의합니다.</span>
                    </label>
                    <button type="button" @click="privacy = !privacy" style="background:none; border:0; color:#777; font-size:13px; cursor:pointer; white-space:nowrap;">
                        전문 보기 <span x-text="privacy ? '▲' : '▼'"></span>
                    </button>
                </div>
                <div x-show="privacy" x-transition style="max-height:240px; overflow-y:auto; padding:14px 16px; border-top:1px solid #eef1f6; font-size:12.5px; line-height:1.6; color:#555;">
                    @php $tP = \App\Models\PageContent::bySlug('terms_privacy'); @endphp
                    @if($tP && $tP->content){!! $tP->content !!}@else @include('auth._terms_privacy')@endif
                </div>
            </div>

            {{-- 광고성 정보 (선택) --}}
            <label style="display:flex; align-items:center; gap:8px; font-size:14px; color:#444; cursor:pointer; padding:4px 4px;">
                <input type="checkbox" name="agree_ad" value="1" {{ old('agree_ad') ? 'checked' : '' }}>
                <span>(선택) 광고성 정보 수신에 동의합니다.</span>
            </label>
        </div>

        @php
            $lblStyle = 'display:block; font-size:13px; color:#555; margin-bottom:6px;';
            $inStyle = 'width:100%; height:44px; padding:0 12px; border:1px solid #d4dae5; border-radius:8px; font-size:14px;';
        @endphp

        <div style="display:grid; grid-template-columns:1fr; gap:16px;">
            {{-- 이름 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 이름</label>
                <input type="text" name="name" value="{{ old('name') }}" required style="{{ $inStyle }}">
            </div>

            {{-- 사용자ID + 중복확인 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 사용자ID (영문/숫자 6자 이상)</label>
                <div style="display:flex; gap:8px;">
                    <input type="text" name="username" id="username" value="{{ old('username') }}" required
                           style="{{ $inStyle }} flex:1;">
                    <button type="button" id="checkUserBtn"
                            style="flex-shrink:0; padding:0 16px; background:#515151; color:#fff; border:0; border-radius:8px; font-size:13px; font-weight:600; cursor:pointer;">중복확인</button>
                </div>
                <p id="usernameMsg" style="font-size:12px; margin-top:6px; min-height:16px;"></p>
            </div>

            {{-- 비밀번호 --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 비밀번호 (8자 이상)</label>
                    <input type="password" name="password" required style="{{ $inStyle }}">
                </div>
                <div>
                    <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 비밀번호 확인</label>
                    <input type="password" name="password_confirmation" required style="{{ $inStyle }}">
                </div>
            </div>

            {{-- 회원구분 안내 (선택 불가, 관리자 승급) --}}
            <div>
                <label style="{{ $lblStyle }}">회원구분</label>
                <div style="display:flex; align-items:center; gap:8px; height:44px; padding:0 12px; border:1px solid #d4dae5; border-radius:8px; background:#f7f8fa; font-size:14px; color:#555;">
                    <span style="font-weight:600; color:#333;">인터넷회원</span>
                    <span style="font-size:12.5px; color:#888;">· 가입 시 기본 부여되며, 등급 승급은 관리자 승인 후 이루어집니다.</span>
                </div>
            </div>

            {{-- 이메일 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 이메일</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="{{ $inStyle }}">
                <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#666; margin-top:8px; cursor:pointer;">
                    <input type="checkbox" name="email_agree" value="1" {{ old('email_agree') ? 'checked' : '' }}> 이메일 수신 동의
                </label>
            </div>

            {{-- 전화 / 휴대폰 --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label style="{{ $lblStyle }}">전화번호(회사)</label>
                    <input type="text" name="phone_company" value="{{ old('phone_company') }}" placeholder="02-000-0000" style="{{ $inStyle }}">
                </div>
                <div>
                    <label style="{{ $lblStyle }}">휴대폰번호</label>
                    <input type="text" name="phone_mobile" value="{{ old('phone_mobile') }}" placeholder="010-0000-0000" style="{{ $inStyle }}">
                    <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#666; margin-top:8px; cursor:pointer;">
                        <input type="checkbox" name="sms_agree" value="1" {{ old('sms_agree') ? 'checked' : '' }}> SMS 수신 동의
                    </label>
                </div>
            </div>

            {{-- 주소 --}}
            <div>
                <label style="{{ $lblStyle }}">주소</label>
                <input type="text" name="zipcode" value="{{ old('zipcode') }}" placeholder="우편번호" style="{{ $inStyle }} margin-bottom:8px;">
                <input type="text" name="address" value="{{ old('address') }}" placeholder="기본주소" style="{{ $inStyle }} margin-bottom:8px;">
                <input type="text" name="address_detail" value="{{ old('address_detail') }}" placeholder="상세주소" style="{{ $inStyle }}">
            </div>

            {{-- 가입기간 --}}
            <div>
                <label style="{{ $lblStyle }}">가입기간</label>
                <input type="text" name="join_period" value="{{ old('join_period') }}" placeholder="(선택)" style="{{ $inStyle }}">
            </div>
        </div>

        <div style="margin-top:26px; display:flex; gap:10px; justify-content:center;">
            <a href="{{ url('/login') }}" style="padding:12px 28px; background:#fff; border:1px solid #d4dae5; border-radius:8px; color:#555; font-weight:600; text-decoration:none;">취소</a>
            <button type="submit" style="padding:12px 40px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">가입하기</button>
        </div>
    </form>
</div>

<script>
(function () {
    var btn = document.getElementById('checkUserBtn');
    var input = document.getElementById('username');
    var msg = document.getElementById('usernameMsg');
    if (!btn) return;
    btn.addEventListener('click', function () {
        var u = (input.value || '').trim();
        if (u.length < 6) { msg.style.color = '#d00'; msg.textContent = '아이디는 영문/숫자 6자 이상이어야 합니다.'; return; }
        fetch('{{ url('/register/check-username') }}?username=' + encodeURIComponent(u))
            .then(function (r) { return r.json(); })
            .then(function (d) {
                if (d.available) { msg.style.color = '#15803d'; msg.textContent = '사용 가능한 아이디입니다.'; }
                else { msg.style.color = '#d00'; msg.textContent = '이미 사용 중이거나 사용할 수 없는 아이디입니다.'; }
            })
            .catch(function () { msg.style.color = '#d00'; msg.textContent = '확인 중 오류가 발생했습니다.'; });
    });
})();
</script>
@endsection
