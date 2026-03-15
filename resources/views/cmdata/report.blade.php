@extends('layouts.sub')

@section('title', '논문/연구보고서 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '논문/연구보고서')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">논문/연구보고서</h2>
    <p class="sub-content-desc">건설사업관리 관련 논문 및 연구보고서를 열람할 수 있습니다.</p>

    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <input type="text" placeholder="검색어를 입력하세요" style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </div>

    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                <th style="width:100px;">조회</th>
                <th style="width:110px;">등록일</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['no' => 135, 'title' => 'ENR 순위로 본 미국 건설산업 발주방식 동향', 'views' => 342, 'date' => '2026-01-15'],
                    ['no' => 134, 'title' => '국내 건설사업관리(CM) 시장 현황 분석', 'views' => 289, 'date' => '2025-12-20'],
                    ['no' => 133, 'title' => '스마트건설 기술의 CM 적용 방안 연구', 'views' => 512, 'date' => '2025-11-15'],
                    ['no' => 132, 'title' => '해외 CM 제도 비교 연구 - 미국, 영국, 일본', 'views' => 478, 'date' => '2025-10-28'],
                    ['no' => 131, 'title' => 'BIM 기반 건설사업관리 효율화 방안', 'views' => 623, 'date' => '2025-09-15'],
                    ['no' => 130, 'title' => '공공건설사업 CM 발주현황 및 개선방안', 'views' => 356, 'date' => '2025-08-20'],
                    ['no' => 129, 'title' => '건설산업 디지털 전환과 CM의 역할', 'views' => 445, 'date' => '2025-07-10'],
                    ['no' => 128, 'title' => '시공책임형 CM 활성화를 위한 제도개선 연구', 'views' => 387, 'date' => '2025-06-25'],
                    ['no' => 127, 'title' => '건설사업관리 인력 수급 현황 및 전망', 'views' => 298, 'date' => '2025-05-18'],
                    ['no' => 126, 'title' => 'ESG 경영과 건설사업관리의 연계방안', 'views' => 534, 'date' => '2025-04-22'],
                ];
            @endphp
            @foreach($items as $item)
                <tr>
                    <td style="text-align:center;">{{ $item['no'] }}</td>
                    <td><a href="#" style="color:#333; text-decoration:none;">{{ $item['title'] }}</a></td>
                    <td style="text-align:center; color:#888;">{{ $item['views'] }}</td>
                    <td style="text-align:center; color:#888;">{{ $item['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display:flex; justify-content:center; gap:4px; margin-top:24px;">
        <span style="padding:6px 10px; font-size:13px; background:#0061c2; color:#fff; border-radius:4px; font-weight:600;">1</span>
        @for($i = 2; $i <= 5; $i++)
            <a href="#" style="padding:6px 10px; font-size:13px; color:#666; text-decoration:none;">{{ $i }}</a>
        @endfor
    </div>
</div>
@endsection
