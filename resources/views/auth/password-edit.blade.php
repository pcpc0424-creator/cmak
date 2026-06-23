@extends('layouts.sub')

@section('title', '비밀번호 변경 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/mypage')
@section('page-title', '마이페이지')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">비밀번호 변경</h2>
    <p class="sub-content-desc">보안을 위해 현재 비밀번호 확인 후 변경됩니다.</p>

    @include('auth._mypage-nav', ['active' => 'password'])

    @if ($errors->any())
        <div style="margin:16px 0; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    @php
        $lblStyle = 'display:block; font-size:13px; color:#555; margin-bottom:6px;';
        $inStyle = 'width:100%; height:44px; padding:0 12px; border:1px solid #d4dae5; border-radius:8px; font-size:14px; box-sizing:border-box;';
    @endphp

    <form action="/cmak/mypage/password" method="POST" style="max-width:480px; margin:20px auto 0;">
        @csrf @method('PUT')

        <div style="display:grid; grid-template-columns:1fr; gap:16px;">
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 현재 비밀번호</label>
                <input type="password" name="current_password" required style="{{ $inStyle }}">
            </div>
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 새 비밀번호 (8자 이상)</label>
                <input type="password" name="password" required style="{{ $inStyle }}">
            </div>
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 새 비밀번호 확인</label>
                <input type="password" name="password_confirmation" required style="{{ $inStyle }}">
            </div>
        </div>

        <div style="margin-top:26px; display:flex; gap:10px; justify-content:center;">
            <a href="/cmak/mypage" style="padding:12px 28px; background:#fff; border:1px solid #d4dae5; border-radius:8px; color:#555; font-weight:600; text-decoration:none;">취소</a>
            <button type="submit" style="padding:12px 40px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">변경</button>
        </div>
    </form>
</div>
@endsection
