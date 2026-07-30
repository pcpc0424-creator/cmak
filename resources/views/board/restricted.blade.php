@extends('layouts.sub')

@section('title', '열람 권한 안내 - 한국CM협회')
@section('category', $boardConfig['menu'] ?? '')
@section('page-title', $boardConfig['name'] ?? '열람 권한 안내')

@section('side-menu')
    @php
        $menuToSideMenu = [
            '알림마당' => 'notice._side-menu',
            'CM 소개' => 'cmdata._side-menu',
            '협회업무' => 'business._side-menu',
            '참여마당' => 'community._side-menu',
        ];
        $sideMenuView = $menuToSideMenu[$boardConfig['menu'] ?? ''] ?? null;
    @endphp
    @if($sideMenuView)
        @include($sideMenuView)
    @endif
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">{{ $boardConfig['name'] ?? '' }}</h2>

    <div style="max-width:560px; margin:40px auto; text-align:center;">
        <div style="font-size:48px; margin-bottom:16px;">🔒</div>
        <h3 style="font-size:18px; color:#1e2a4a; margin-bottom:12px;">열람 권한이 없습니다</h3>
        <p style="font-size:14px; color:#666; line-height:1.8;">
            <strong>{{ $boardConfig['name'] ?? '이 게시판' }}</strong>은(는) <strong>정회원·준회원·특별회원</strong>만 열람하실 수 있습니다.<br>
            인터넷회원은 일부 자료의 열람이 제한됩니다.<br>
            등급 상향이 필요하신 경우 협회로 문의해 주세요.
        </p>

        <div style="margin-top:24px; padding:16px 18px; background:#f8f9fb; border:1px solid #e8ecf1; border-radius:10px; display:inline-block; text-align:left; font-size:13px; color:#555;">
            <div>전화 : 02-585-4712~4</div>
            <div>이메일 : cm@cmak.or.kr</div>
        </div>

        <div style="margin-top:28px; display:flex; gap:10px; justify-content:center;">
            <a href="/cmak/mypage" style="padding:11px 26px; background:#265de8; color:#fff; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">마이페이지</a>
            <a href="/cmak" style="padding:11px 26px; background:#fff; border:1px solid #d4dae5; color:#555; border-radius:8px; font-size:14px; font-weight:600; text-decoration:none;">홈으로</a>
        </div>
    </div>
</div>
@endsection
