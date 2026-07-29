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
            // 회차 기준 내림차순. 제1회(2006)부터 회차 = 연도 - 2005 로 이어짐.
            // 제16~18회는 이미지 파일명·이미지 상단 연도표기가 한 해씩 밀려 있어
            // 파일명으로 연도를 추정하지 않고 아래 표를 기준으로 함.
            //   제18회 = 2023년(파일 slogan_2024_1), 제17회 = 2022년(slogan_2023),
            //   제16회 = 2021년(slogan_2022)
            $slogans = [
                ['no' => 20, 'year' => 2025, 'file' => 'slogan_2025.jpg'],
                ['no' => 19, 'year' => 2024, 'file' => 'slogan_2024_2.jpg'],
                ['no' => 18, 'year' => 2023, 'file' => 'slogan_2024_1.jpg'],
                ['no' => 17, 'year' => 2022, 'file' => 'slogan_2023.jpg'],
                ['no' => 16, 'year' => 2021, 'file' => 'slogan_2022.jpg'],
                ['no' => 15, 'year' => 2020, 'file' => 'slogan_2020.jpg'],
                ['no' => 14, 'year' => 2019, 'file' => 'slogan_2019.jpg'],
                ['no' => 13, 'year' => 2018, 'file' => 'slogan_2018.jpg'],
                ['no' => 12, 'year' => 2017, 'file' => 'slogan_2017.jpg'],
                ['no' => 11, 'year' => 2016, 'file' => 'slogan_2016.jpg'],
                ['no' => 10, 'year' => 2015, 'file' => 'slogan_2015.jpg'],
                ['no' => 9,  'year' => 2014, 'file' => 'slogan_2014.jpg'],
                ['no' => 8,  'year' => 2013, 'file' => 'slogan_2013.jpg'],
                ['no' => 7,  'year' => 2012, 'file' => 'slogan_2012.jpg'],
                ['no' => 6,  'year' => 2011, 'file' => 'slogan_2011.jpg'],
                ['no' => 5,  'year' => 2010, 'file' => 'slogan_2010.jpg'],
                ['no' => 4,  'year' => 2009, 'file' => 'slogan_2009.jpg'],
                ['no' => 3,  'year' => 2008, 'file' => 'slogan_2008.jpg'],
                ['no' => 2,  'year' => 2007, 'file' => 'slogan_2007.jpg'],
                ['no' => 1,  'year' => 2006, 'file' => 'slogan_2006.jpg'],
            ];
        @endphp

        @foreach($slogans as $slogan)
            <div style="border:1px solid #e8ecf1; border-radius:8px; overflow:hidden; text-align:center;">
                <div style="background:#f0f4fa; padding:10px; font-weight:700; font-size:15px; color:#064277;">제{{ $slogan['no'] }}회 <span style="font-weight:500; color:#4a6785;">({{ $slogan['year'] }}년)</span></div>
                <div style="padding:16px;">
                    <img src="/cmak/images/slogan/{{ $slogan['file'] }}" alt="제{{ $slogan['no'] }}회 건설사업관리(CM)표어 수상작 ({{ $slogan['year'] }}년)" style="max-width:100%; height:auto; border-radius:4px;">
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
