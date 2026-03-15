@extends('layouts.sub')

@section('title', '공지사항 - 한국CM협회')
@section('category', '소통공간')
@section('category-link', '/cmak/notice')
@section('page-title', '공지사항')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">공지사항</h2>
    <p class="sub-content-desc">한국CM협회의 공지사항을 확인하세요.</p>

    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <select style="padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
            <option>전체</option><option>제목</option><option>내용</option>
        </select>
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
                    ['no' => 3888, 'title' => '제16회 세계CM의 날 유공 정부포상 후보자 공모', 'views' => 245, 'date' => '2026-03-10', 'new' => true],
                    ['no' => 3887, 'title' => '2026년도 건설사업관리(CM)능력평가·공시 안내', 'views' => 534, 'date' => '2026-01-07', 'new' => true],
                    ['no' => 3886, 'title' => '2026년 상반기 CM 전문교육 일정 공고', 'views' => 423, 'date' => '2026-01-05', 'new' => false],
                    ['no' => 3885, 'title' => '제30회 정기총회 개최 안내', 'views' => 312, 'date' => '2026-01-03', 'new' => false],
                    ['no' => 3884, 'title' => '2025년 연차보고서 발간 안내', 'views' => 267, 'date' => '2025-12-28', 'new' => false],
                    ['no' => 3883, 'title' => '신년사 - 한국CM협회장', 'views' => 356, 'date' => '2025-12-26', 'new' => false],
                    ['no' => 3882, 'title' => '2025년도 제29차 정기총회 결과 보고', 'views' => 289, 'date' => '2025-12-20', 'new' => false],
                    ['no' => 3881, 'title' => '건설사업관리사(CMP) 제18회 자격검정 합격자 발표', 'views' => 678, 'date' => '2025-12-15', 'new' => false],
                    ['no' => 3880, 'title' => '2025년도 CM능력평가 결과 공시', 'views' => 445, 'date' => '2025-12-10', 'new' => false],
                    ['no' => 3879, 'title' => '2025년 하반기 CM전문교육 수료 안내', 'views' => 198, 'date' => '2025-12-05', 'new' => false],
                ];
            @endphp
            @foreach($items as $item)
                <tr>
                    <td style="text-align:center;">{{ $item['no'] }}</td>
                    <td>
                        <a href="#" style="color:#333; text-decoration:none;">{{ $item['title'] }}</a>
                        @if($item['new'])<span style="display:inline-block; background:#e53e3e; color:#fff; font-size:10px; padding:1px 5px; border-radius:3px; margin-left:6px; font-weight:600;">N</span>@endif
                    </td>
                    <td style="text-align:center; color:#888;">{{ $item['views'] }}</td>
                    <td style="text-align:center; color:#888;">{{ $item['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display:flex; justify-content:center; gap:4px; margin-top:24px;">
        <span style="padding:6px 10px; font-size:13px; background:#0061c2; color:#fff; border-radius:4px; font-weight:600;">1</span>
        @for($i = 2; $i <= 10; $i++)
            <a href="#" style="padding:6px 10px; font-size:13px; color:#666; text-decoration:none;">{{ $i }}</a>
        @endfor
    </div>
</div>
@endsection
