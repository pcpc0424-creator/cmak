@extends('layouts.sub')

@section('title', '보도자료 - 한국CM협회')
@section('category', '소통공간')
@section('category-link', '/cmak/notice')
@section('page-title', '보도자료')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">보도자료</h2>
    <p class="sub-content-desc">한국CM협회의 보도자료를 확인하세요.</p>

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
                    ['no' => 520, 'title' => '2026년도 건설사업관리(CM)능력평가·공시 신청마감 안내', 'views' => 312, 'date' => '2026-01-07'],
                    ['no' => 519, 'title' => '건설사업관리사(CM) 제18회 자격검정 합격자 명단', 'views' => 567, 'date' => '2026-01-04'],
                    ['no' => 518, 'title' => '2026년도 제29차 정기총회 개최', 'views' => 234, 'date' => '2026-01-30'],
                    ['no' => 517, 'title' => '2026년도 연회비 납부 안내', 'views' => 189, 'date' => '2026-01-19'],
                    ['no' => 516, 'title' => '2026년도 새해인사 날 유공 정부포상 후보자 공모', 'views' => 145, 'date' => '2026-01-16'],
                    ['no' => 515, 'title' => 'CM Herald 2025년 12월호 발간', 'views' => 234, 'date' => '2025-12-20'],
                    ['no' => 514, 'title' => '2025년 CM전문교육 연간 실적 보고', 'views' => 178, 'date' => '2025-12-15'],
                    ['no' => 513, 'title' => '제7회 세계CM경진대회(CONSMA) 결과 보고', 'views' => 456, 'date' => '2025-12-10'],
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
