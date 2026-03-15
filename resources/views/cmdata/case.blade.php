@extends('layouts.sub')

@section('title', '수행사례 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '수행사례')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">수행사례</h2>
    <p class="sub-content-desc">건설사업관리 수행사례를 열람할 수 있습니다.</p>

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
                    ['no' => 60, 'title' => '[ConsMa 2024] 제7회 세계CM경진대회', 'views' => 856, 'date' => '2025-12-10'],
                    ['no' => 59, 'title' => '서울 국제업무지구 CM 수행사례', 'views' => 723, 'date' => '2025-11-05'],
                    ['no' => 58, 'title' => '인천공항 제2터미널 확장 CM 사례', 'views' => 645, 'date' => '2025-10-15'],
                    ['no' => 57, 'title' => '세종시 행정중심복합도시 CM 수행사례', 'views' => 589, 'date' => '2025-09-20'],
                    ['no' => 56, 'title' => 'GTX-A 노선 건설사업관리 사례', 'views' => 712, 'date' => '2025-08-10'],
                    ['no' => 55, 'title' => '부산 에코델타시티 스마트시티 CM 사례', 'views' => 534, 'date' => '2025-07-25'],
                    ['no' => 54, 'title' => '해외 CM 수행사례 - 중동 플랜트 프로젝트', 'views' => 467, 'date' => '2025-06-15'],
                    ['no' => 53, 'title' => '공공주택 단지 시공책임형 CM 사례', 'views' => 398, 'date' => '2025-05-20'],
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
        @for($i = 2; $i <= 3; $i++)
            <a href="#" style="padding:6px 10px; font-size:13px; color:#666; text-decoration:none;">{{ $i }}</a>
        @endfor
    </div>
</div>
@endsection
