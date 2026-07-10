@extends('layouts.sub')

@section('title', '로그인 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/login')
@section('page-title', '로그인')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">온라인 회원 로그인</h2>
    <p class="sub-content-desc">한국CM협회 홈페이지의 각종 서비스를 이용하시려면 로그인해 주세요.</p>

    <div style="max-width:420px; margin:24px auto 8px;">
        @if (session('success'))
            <div style="margin-bottom:16px; padding:12px 14px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; color:#15803d; font-size:13px;">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div style="margin-bottom:16px; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
                {{ session('error') }}
            </div>
        @endif
        @if ($errors->any())
            <div style="margin-bottom:16px; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div style="margin-bottom:14px;">
                <label for="login_id" style="display:block; font-size:13px; color:#555; margin-bottom:6px;">아이디 (또는 이메일)</label>
                <input type="text" name="login_id" id="login_id" value="{{ old('login_id') }}" required autofocus
                       style="width:100%; height:46px; padding:0 14px; border:1px solid #d4dae5; border-radius:8px; font-size:14px;">
            </div>
            <div style="margin-bottom:14px;">
                <label for="password" style="display:block; font-size:13px; color:#555; margin-bottom:6px;">비밀번호</label>
                <input type="password" name="password" id="password" required
                       style="width:100%; height:46px; padding:0 14px; border:1px solid #d4dae5; border-radius:8px; font-size:14px;">
            </div>
            <label style="display:flex; align-items:center; gap:8px; font-size:13px; color:#555; margin-bottom:18px; cursor:pointer;">
                <input type="checkbox" name="remember" value="1"> 로그인 상태 유지
            </label>
            <button type="submit"
                    style="width:100%; height:48px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">
                로그인
            </button>
        </form>

        <div style="margin-top:16px; display:flex; align-items:center; justify-content:center; gap:10px; font-size:13px; color:#777;">
            <a href="{{ url('/find-username') }}" style="color:#555;">아이디 찾기</a>
            <span style="color:#ddd;">|</span>
            <a href="{{ url('/reset-password') }}" style="color:#555;">비밀번호 찾기</a>
        </div>
        <div style="margin-top:10px; text-align:center; font-size:13px; color:#777;">
            아직 온라인 회원이 아니신가요?
            <a href="{{ url('/register') }}" style="color:#265de8; font-weight:600; margin-left:4px;">온라인 회원가입</a>
        </div>

        {{-- 일반·특별회원 가입안내 (협회업무-회원가입 페이지로 연결) --}}
        <div style="margin-top:22px; padding:16px 18px; background:#f7f9fc; border:1px solid #e5eaf2; border-radius:10px;">
            <p style="font-size:13px; color:#555; line-height:1.6; margin-bottom:12px;">
                회원사 혹은 특별(개인)회원으로 가입하시려면 별도의 가입절차를 확인하세요.
            </p>
            <a href="{{ url('/business/membership') }}"
               style="display:block; text-align:center; height:44px; line-height:44px; background:#fff; border:1px solid #265de8; color:#265de8; border-radius:8px; font-size:14px; font-weight:600;">
                일반·특별회원 가입안내
            </a>
        </div>
    </div>
</div>
@endsection
