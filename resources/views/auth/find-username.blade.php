@extends('layouts.sub')

@section('title', '아이디 찾기 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/login')
@section('page-title', '아이디 찾기')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">아이디 찾기</h2>
    <p class="sub-content-desc">가입 시 등록한 이름과 이메일로 아이디를 찾을 수 있습니다.</p>

    <div style="max-width:420px; margin:24px auto 8px;">
        @if ($errors->any())
            <div style="margin-bottom:16px; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
                {{ $errors->first() }}
            </div>
        @endif

        @isset($foundUsername)
            <div style="margin-bottom:16px; padding:18px; background:#f0f6ff; border:1px solid #bcd4ff; border-radius:10px; text-align:center;">
                <div style="font-size:13px; color:#555; margin-bottom:6px;">회원님의 아이디</div>
                <div style="font-size:20px; font-weight:700; color:#265de8; letter-spacing:1px;">{{ $foundUsername }}</div>
                <div style="font-size:12px; color:#999; margin-top:8px;">보안을 위해 일부만 표시됩니다.</div>
            </div>
            <div style="text-align:center;">
                <a href="{{ url('/login') }}" style="display:inline-block; padding:11px 30px; background:#265de8; color:#fff; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">로그인하러 가기</a>
                <a href="{{ url('/reset-password') }}" style="display:inline-block; padding:11px 30px; background:#fff; border:1px solid #d4dae5; color:#555; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none; margin-left:6px;">비밀번호 찾기</a>
            </div>
        @else
            @php $inStyle = 'width:100%; height:46px; padding:0 14px; border:1px solid #d4dae5; border-radius:8px; font-size:14px; box-sizing:border-box;'; @endphp
            <form action="{{ url('/find-username') }}" method="POST">
                @csrf
                <div style="margin-bottom:14px;">
                    <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">이름</label>
                    <input type="text" name="name" value="{{ old('name') }}" required autofocus style="{{ $inStyle }}">
                </div>
                <div style="margin-bottom:18px;">
                    <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">이메일</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="{{ $inStyle }}">
                </div>
                <button type="submit" style="width:100%; height:48px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">아이디 찾기</button>
            </form>
            <div style="margin-top:16px; text-align:center; font-size:13px; color:#777;">
                <a href="{{ url('/login') }}" style="color:#555;">로그인</a>
                <span style="color:#ddd; margin:0 8px;">|</span>
                <a href="{{ url('/reset-password') }}" style="color:#555;">비밀번호 찾기</a>
            </div>
        @endisset
    </div>
</div>
@endsection
