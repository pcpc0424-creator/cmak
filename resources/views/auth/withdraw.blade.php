@extends('layouts.sub')

@section('title', '회원 탈퇴 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/mypage')
@section('page-title', '마이페이지')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원 탈퇴</h2>
    <p class="sub-content-desc">회원 탈퇴를 진행합니다.</p>

    @include('auth._mypage-nav', ['active' => 'withdraw'])

    @if ($errors->any())
        <div style="margin:16px 0; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    <div style="max-width:520px; margin:20px auto 0;">
        <div style="padding:16px 18px; background:#fff7ed; border:1px solid #fed7aa; border-radius:10px; color:#9a3412; font-size:13.5px; line-height:1.7; margin-bottom:20px;">
            <strong>탈퇴 시 유의사항</strong>
            <ul style="margin:8px 0 0; padding-left:18px;">
                <li>탈퇴하면 계정이 비활성화되어 다시 로그인할 수 없습니다.</li>
                <li>작성하신 게시글은 자동으로 삭제되지 않습니다.</li>
                <li>재가입을 원하시면 협회로 문의해 주세요.</li>
            </ul>
        </div>

        @php
            $lblStyle = 'display:block; font-size:13px; color:#555; margin-bottom:6px;';
            $inStyle = 'width:100%; height:44px; padding:0 12px; border:1px solid #d4dae5; border-radius:8px; font-size:14px; box-sizing:border-box;';
        @endphp

        <form action="/cmak/mypage/withdraw" method="POST" onsubmit="return confirm('정말 탈퇴하시겠습니까? 이 작업은 되돌릴 수 없습니다.');">
            @csrf @method('DELETE')
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 현재 비밀번호 확인</label>
                <input type="password" name="current_password" required style="{{ $inStyle }}">
            </div>

            <div style="margin-top:26px; display:flex; gap:10px; justify-content:center;">
                <a href="/cmak/mypage" style="padding:12px 28px; background:#fff; border:1px solid #d4dae5; border-radius:8px; color:#555; font-weight:600; text-decoration:none;">취소</a>
                <button type="submit" style="padding:12px 40px; background:#d04444; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">탈퇴하기</button>
            </div>
        </form>
    </div>
</div>
@endsection
