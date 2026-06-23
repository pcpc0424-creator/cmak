@extends('layouts.sub')

@section('title', '비밀번호 찾기 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/login')
@section('page-title', '비밀번호 찾기')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">비밀번호 찾기</h2>
    <p class="sub-content-desc">본인확인(아이디·이름·이메일) 후 새 비밀번호를 설정합니다.</p>

    <div style="max-width:420px; margin:24px auto 8px;">
        @if ($errors->any())
            <div style="margin-bottom:16px; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
                <ul style="margin:0; padding-left:18px;">
                    @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
                </ul>
            </div>
        @endif

        @php $inStyle = 'width:100%; height:46px; padding:0 14px; border:1px solid #d4dae5; border-radius:8px; font-size:14px; box-sizing:border-box;'; @endphp
        <form action="{{ url('/reset-password') }}" method="POST">
            @csrf
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">아이디</label>
                <input type="text" name="username" value="{{ old('username') }}" required autofocus style="{{ $inStyle }}">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">이름</label>
                <input type="text" name="name" value="{{ old('name') }}" required style="{{ $inStyle }}">
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">이메일</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="{{ $inStyle }}">
            </div>
            <hr style="border:0; border-top:1px solid #eef1f6; margin:18px 0;">
            <div style="margin-bottom:14px;">
                <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">새 비밀번호 (8자 이상)</label>
                <input type="password" name="password" required style="{{ $inStyle }}">
            </div>
            <div style="margin-bottom:18px;">
                <label style="display:block; font-size:13px; color:#555; margin-bottom:6px;">새 비밀번호 확인</label>
                <input type="password" name="password_confirmation" required style="{{ $inStyle }}">
            </div>
            <button type="submit" style="width:100%; height:48px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">비밀번호 재설정</button>
        </form>
        <div style="margin-top:16px; text-align:center; font-size:13px; color:#777;">
            <a href="{{ url('/login') }}" style="color:#555;">로그인</a>
            <span style="color:#ddd; margin:0 8px;">|</span>
            <a href="{{ url('/find-username') }}" style="color:#555;">아이디 찾기</a>
        </div>
    </div>
</div>
@endsection
