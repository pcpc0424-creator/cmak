@extends('layouts.sub')

@section('title', '국내외소식 - 한국CM협회')
@section('category', '새소식')
@section('category-link', '/cmak/news')
@section('page-title', '국내외소식')

@section('side-menu')
    @include('news._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">국내외소식</h2>
    <p class="sub-content-desc">건설사업관리 관련 국내외 최신 소식을 전합니다.</p>

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
                    ['no' => 61412, 'title' => "서울시, 대형 굴착공사장 6곳에 '지반침하 예측시스템' 가동", 'views' => 234, 'date' => '2026-03-10', 'new' => true],
                    ['no' => 61411, 'title' => "한중, 도심 항공교통 6개사와 '항공협력 업무협약'", 'views' => 312, 'date' => '2026-03-08', 'new' => true],
                    ['no' => 61410, 'title' => '국토교통부, 건설산업 혁신방안 발표', 'views' => 456, 'date' => '2026-03-05', 'new' => false],
                    ['no' => 61409, 'title' => '스마트건설 기술개발 로드맵 수립', 'views' => 389, 'date' => '2026-02-28', 'new' => false],
                    ['no' => 61408, 'title' => 'UAM 도심항공교통 인프라 구축 본격화', 'views' => 534, 'date' => '2026-02-20', 'new' => false],
                    ['no' => 61407, 'title' => '2026 건설산업 전망 세미나 개최', 'views' => 267, 'date' => '2026-02-15', 'new' => false],
                    ['no' => 61406, 'title' => '디지털 전환 시대 건설사업관리의 역할', 'views' => 378, 'date' => '2026-02-08', 'new' => false],
                    ['no' => 61405, 'title' => '글로벌 인프라 투자 동향 분석', 'views' => 445, 'date' => '2026-01-28', 'new' => false],
                    ['no' => 61404, 'title' => '건설현장 안전관리 강화 대책 발표', 'views' => 356, 'date' => '2026-01-20', 'new' => false],
                    ['no' => 61403, 'title' => 'ESG 경영과 건설산업의 미래', 'views' => 412, 'date' => '2026-01-15', 'new' => false],
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
