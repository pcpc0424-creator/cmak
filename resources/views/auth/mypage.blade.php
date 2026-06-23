@extends('layouts.sub')

@section('title', '마이페이지 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/mypage')
@section('page-title', '마이페이지')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">마이페이지</h2>
    <p class="sub-content-desc"><strong>{{ $user->name }}</strong>님, 환영합니다.</p>

    @if (session('success'))
        <div style="margin:16px 0; padding:12px 14px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; color:#15803d; font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    @include('auth._mypage-nav', ['active' => 'home'])

    @php
        $rowLabel = 'width:140px; padding:14px 16px; background:#f7f8fa; font-size:13px; color:#666; font-weight:600; border-bottom:1px solid #eef1f6; vertical-align:top;';
        $rowVal = 'padding:14px 16px; font-size:14px; color:#333; border-bottom:1px solid #eef1f6;';
    @endphp

    <div style="max-width:680px; margin:20px auto 0;">
        <table style="width:100%; border-collapse:collapse; border-top:2px solid #1e2a4a; border-radius:8px; overflow:hidden;">
            <tbody>
                <tr>
                    <th style="{{ $rowLabel }}">이름</th>
                    <td style="{{ $rowVal }}">{{ $user->name }}</td>
                </tr>
                <tr>
                    <th style="{{ $rowLabel }}">사용자ID</th>
                    <td style="{{ $rowVal }}">{{ $user->username }}</td>
                </tr>
                <tr>
                    <th style="{{ $rowLabel }}">회원구분</th>
                    <td style="{{ $rowVal }}">
                        <span style="display:inline-block; padding:3px 10px; background:#eef2ff; color:#265de8; border-radius:999px; font-size:12.5px; font-weight:600;">{{ $user->gradeLabel() }}</span>
                    </td>
                </tr>
                <tr>
                    <th style="{{ $rowLabel }}">이메일</th>
                    <td style="{{ $rowVal }}">{{ $user->email }}</td>
                </tr>
                <tr>
                    <th style="{{ $rowLabel }}">전화번호(회사)</th>
                    <td style="{{ $rowVal }}">{{ $user->phone_company ?: '-' }}</td>
                </tr>
                <tr>
                    <th style="{{ $rowLabel }}">휴대폰번호</th>
                    <td style="{{ $rowVal }}">{{ $user->phone_mobile ?: '-' }}</td>
                </tr>
                <tr>
                    <th style="{{ $rowLabel }}">주소</th>
                    <td style="{{ $rowVal }}">
                        @if($user->address)
                            {{ $user->zipcode ? '('.$user->zipcode.') ' : '' }}{{ $user->address }} {{ $user->address_detail }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top:26px; display:flex; gap:10px; justify-content:center;">
        @if($user->isAdmin())
            <a href="{{ url('/admin') }}" style="padding:12px 28px; background:#fff; border:1px solid #d4dae5; border-radius:8px; color:#555; font-weight:600; text-decoration:none;">관리자 페이지</a>
        @endif
        <form action="{{ url('/logout') }}" method="POST" style="margin:0;">
            @csrf
            <button type="submit" style="padding:12px 40px; background:#515151; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">로그아웃</button>
        </form>
    </div>
</div>
@endsection
