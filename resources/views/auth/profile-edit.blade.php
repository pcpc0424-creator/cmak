@extends('layouts.sub')

@section('title', '회원정보 수정 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/mypage')
@section('page-title', '마이페이지')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원정보 수정</h2>
    <p class="sub-content-desc">회원 정보를 수정합니다. 사용자ID와 회원구분은 변경할 수 없습니다.</p>

    @include('auth._mypage-nav', ['active' => 'profile'])

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
        $roStyle = $inStyle . ' background:#f3f4f6; color:#999;';
    @endphp

    <form action="/cmak/mypage/profile" method="POST" style="max-width:680px; margin:20px auto 0;">
        @csrf @method('PUT')

        <div style="display:grid; grid-template-columns:1fr; gap:16px;">
            {{-- 사용자ID (읽기전용) --}}
            <div>
                <label style="{{ $lblStyle }}">사용자ID</label>
                <input type="text" value="{{ $user->username }}" disabled style="{{ $roStyle }}">
            </div>

            {{-- 회원구분 (읽기전용) --}}
            <div>
                <label style="{{ $lblStyle }}">회원구분</label>
                <input type="text" value="{{ $user->gradeLabel() }}" disabled style="{{ $roStyle }}">
            </div>

            {{-- 이름 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 이름</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="{{ $inStyle }}">
            </div>

            {{-- 이메일 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 이메일</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="{{ $inStyle }}">
                <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#666; margin-top:8px; cursor:pointer;">
                    <input type="checkbox" name="email_agree" value="1" {{ old('email_agree', $user->email_agree) ? 'checked' : '' }}> 이메일 수신 동의
                </label>
            </div>

            {{-- 전화 / 휴대폰 --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                <div>
                    <label style="{{ $lblStyle }}">전화번호(회사)</label>
                    <input type="text" name="phone_company" value="{{ old('phone_company', $user->phone_company) }}" placeholder="02-000-0000" style="{{ $inStyle }}">
                </div>
                <div>
                    <label style="{{ $lblStyle }}">휴대폰번호</label>
                    <input type="text" name="phone_mobile" value="{{ old('phone_mobile', $user->phone_mobile) }}" placeholder="010-0000-0000" style="{{ $inStyle }}">
                    <label style="display:inline-flex; align-items:center; gap:6px; font-size:13px; color:#666; margin-top:8px; cursor:pointer;">
                        <input type="checkbox" name="sms_agree" value="1" {{ old('sms_agree', $user->sms_agree) ? 'checked' : '' }}> SMS 수신 동의
                    </label>
                </div>
            </div>

            {{-- 주소 --}}
            <div>
                <label style="{{ $lblStyle }}">주소</label>
                <input type="text" name="zipcode" value="{{ old('zipcode', $user->zipcode) }}" placeholder="우편번호" style="{{ $inStyle }} margin-bottom:8px;">
                <input type="text" name="address" value="{{ old('address', $user->address) }}" placeholder="기본주소" style="{{ $inStyle }} margin-bottom:8px;">
                <input type="text" name="address_detail" value="{{ old('address_detail', $user->address_detail) }}" placeholder="상세주소" style="{{ $inStyle }}">
            </div>
        </div>

        <div style="margin-top:26px; display:flex; gap:10px; justify-content:center;">
            <a href="/cmak/mypage" style="padding:12px 28px; background:#fff; border:1px solid #d4dae5; border-radius:8px; color:#555; font-weight:600; text-decoration:none;">취소</a>
            <button type="submit" style="padding:12px 40px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">저장</button>
        </div>
    </form>
</div>
@endsection
