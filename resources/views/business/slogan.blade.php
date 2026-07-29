@extends('layouts.sub')

@section('title', '건설사업관리(CM)표어 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/membership')
@section('page-title', '건설사업관리(CM)표어')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">건설사업관리(CM)표어</h2>
    <p class="sub-content-desc">매년 선정되는 건설사업관리(CM) 표어입니다.</p>

    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(300px, 1fr)); gap:20px; margin-top:24px;">
        @php
            $slogans = [];
            for ($y = 2025; $y >= 2006; $y--) {
                $files = glob(public_path("images/slogan/slogan_{$y}*.jpg"));
                // 같은 연도에 여러 회차가 있으면 최신 회차가 먼저 오도록 역순 정렬
                // (2024: slogan_2024_1=제18회, slogan_2024_2=제19회)
                rsort($files, SORT_NATURAL);
                foreach ($files as $f) {
                    $slogans[] = ['year' => $y, 'file' => basename($f)];
                }
            }
        @endphp

        @foreach($slogans as $slogan)
            <div style="border:1px solid #e8ecf1; border-radius:8px; overflow:hidden; text-align:center;">
                <div style="background:#f0f4fa; padding:10px; font-weight:700; font-size:15px; color:#064277;">{{ $slogan['year'] }}년</div>
                <div style="padding:16px;">
                    <img src="/cmak/images/slogan/{{ $slogan['file'] }}" alt="{{ $slogan['year'] }}년 CM표어" style="max-width:100%; height:auto; border-radius:4px;">
                </div>
            </div>
        @endforeach
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>한국CM협회 &nbsp;|&nbsp; TEL: 02-585-4712~4 &nbsp;|&nbsp; FAX: 02-585-2689 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr</dd>
    </div>
</div>
@endsection
