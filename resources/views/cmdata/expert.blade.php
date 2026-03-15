@extends('layouts.sub')

@section('title', '전문가칼럼 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '전문가칼럼')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">전문가칼럼</h2>
    <p class="sub-content-desc">건설사업관리 분야 전문가의 인사이트를 만나보세요.</p>

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
                    ['no' => 87, 'title' => '플래닛 건축학 전문가에게 듣는다', 'views' => 423, 'date' => '2026-03-10'],
                    ['no' => 86, 'title' => '도시속을 누비는 하이스피드 모빌리티 CM이다', 'views' => 367, 'date' => '2026-03-05'],
                    ['no' => 85, 'title' => '도시의 CM은 삶의 질향상', 'views' => 312, 'date' => '2026-02-28'],
                    ['no' => 84, 'title' => '한국CM, 해외수주전 개척', 'views' => 456, 'date' => '2026-02-20'],
                    ['no' => 83, 'title' => '디지털 트윈과 건설사업관리의 미래', 'views' => 534, 'date' => '2026-01-15'],
                    ['no' => 82, 'title' => 'ESG 시대의 건설 프로젝트 관리', 'views' => 489, 'date' => '2025-12-20'],
                    ['no' => 81, 'title' => '스마트건설과 CM의 역할 변화', 'views' => 567, 'date' => '2025-11-15'],
                    ['no' => 80, 'title' => '글로벌 인프라 시장과 한국 CM의 도전', 'views' => 412, 'date' => '2025-10-28'],
                    ['no' => 79, 'title' => 'AI가 바꾸는 건설사업관리', 'views' => 678, 'date' => '2025-09-15'],
                    ['no' => 78, 'title' => '건설산업 인력난 해소를 위한 CM의 역할', 'views' => 345, 'date' => '2025-08-20'],
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
