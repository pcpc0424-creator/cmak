@extends('layouts.sub')

@section('title', '법령정보 - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '법령정보')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">법령정보 조회</h2>

    <div style="max-width:520px; margin:30px auto 20px; padding:40px 24px; background:#fbfdff; border:1px solid #dde9f2; border-radius:10px; text-align:center;">
        <p style="font-size:14px; line-height:1.8; color:#444; margin:0 0 20px 0;">
            법령·조약, 행정규칙, 자치법규, 판례, 헌재결정례, 법령해석례, 행정심판례 등<br>
            모든 법령정보를 검색할 수 있습니다.
        </p>

        <div style="margin:24px auto; width:96px; height:96px; border-radius:50%; background:#4cb6c5; display:flex; align-items:center; justify-content:center;">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14.5 7l-9 9L3 19l3-1 9-9"/>
                <path d="M14.5 4.5l5 5L17 12 12 7l2.5-2.5z"/>
                <path d="M19 16h4M21 14v4"/>
            </svg>
        </div>

        <a href="https://www.law.go.kr/" target="_blank" rel="noopener noreferrer"
           style="display:inline-flex; align-items:center; gap:6px; padding:10px 24px; color:#4cb6c5; font-size:15px; font-weight:600; text-decoration:none; border-bottom:1px solid #4cb6c5;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"/>
                <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            검색하기
        </a>
    </div>

    <p style="text-align:center; margin-top:18px; font-size:13px; color:#888;">
        국가법령정보센터(law.go.kr) 새 창으로 연결됩니다.
    </p>
</div>
@endsection
