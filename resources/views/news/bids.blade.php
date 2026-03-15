@extends('layouts.sub')

@section('title', '입낙찰정보 - 한국CM협회')
@section('category', '새소식')
@section('category-link', '/cmak/news')
@section('page-title', '입낙찰정보')

@section('side-menu')
    @include('news._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">입낙찰정보</h2>
    <p class="sub-content-desc">건설사업관리 관련 입찰·낙찰 정보를 안내합니다.</p>

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
                    ['no' => 4521, 'title' => '2026년도 용역비(계획, 용역비조정) 공고', 'views' => 189, 'date' => '2026-03-12'],
                    ['no' => 4520, 'title' => '홍콩 정부청사 신축사업 기본설계용역 공고', 'views' => 234, 'date' => '2026-03-10'],
                    ['no' => 4519, 'title' => '광주 광산역세권 도시개발사업 기본설계용역 공고', 'views' => 156, 'date' => '2026-03-08'],
                    ['no' => 4518, 'title' => '청년스마트빌리지 조성사업 건설사업관리용역', 'views' => 278, 'date' => '2026-03-05'],
                    ['no' => 4517, 'title' => '세종시 행정중심복합도시 6-4생활권 CM용역', 'views' => 345, 'date' => '2026-02-28'],
                    ['no' => 4516, 'title' => '인천국제공항 제4활주로 건설공사 CM용역', 'views' => 423, 'date' => '2026-02-20'],
                    ['no' => 4515, 'title' => 'GTX-C노선 건설사업관리 용역 입찰공고', 'views' => 567, 'date' => '2026-02-15'],
                    ['no' => 4514, 'title' => '부산 에코델타시티 기반시설 CM용역', 'views' => 234, 'date' => '2026-02-08'],
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
        @for($i = 2; $i <= 10; $i++)
            <a href="#" style="padding:6px 10px; font-size:13px; color:#666; text-decoration:none;">{{ $i }}</a>
        @endfor
    </div>
</div>
@endsection
