@extends('layouts.sub')

@section('title', '회원동향 - 한국CM협회')
@section('category', '새소식')
@section('category-link', '/cmak/news')
@section('page-title', '회원동향')

@section('side-menu')
    @include('news._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원동향</h2>
    <p class="sub-content-desc">한국CM협회 회원사의 주요 소식을 전합니다.</p>

    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <input type="text" placeholder="검색어를 입력하세요" style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </div>

    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                <th style="width:100px;">회사명</th>
                <th style="width:110px;">등록일</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['no' => 89, 'title' => '에티오피아 신규프로젝트 추진', 'company' => '현대건설', 'date' => '2026-03-05'],
                    ['no' => 88, 'title' => '싱가포르 복합건물 설계공모 도전', 'company' => '대우A&C', 'date' => '2026-02-28'],
                    ['no' => 87, 'title' => '말레이시아 신규프로젝트 선정', 'company' => '현대건설', 'date' => '2026-02-20'],
                    ['no' => 86, 'title' => '베트남 톤 누 프로젝트 공사비 계약', 'company' => '한솔건설', 'date' => '2026-02-15'],
                    ['no' => 85, 'title' => '사우디 네옴시티 CM 수주', 'company' => '희림건축', 'date' => '2026-02-08'],
                    ['no' => 84, 'title' => '국내 대형 복합개발 사업 수주', 'company' => '포스코A&C', 'date' => '2026-01-25'],
                    ['no' => 83, 'title' => '베트남 하노이 도시개발 참여', 'company' => '신화엔지니어링', 'date' => '2026-01-15'],
                    ['no' => 82, 'title' => '미국 텍사스 데이터센터 CM 수주', 'company' => '정림건축', 'date' => '2026-01-08'],
                ];
            @endphp
            @foreach($items as $item)
                <tr>
                    <td style="text-align:center;">{{ $item['no'] }}</td>
                    <td><a href="#" style="color:#333; text-decoration:none;">{{ $item['title'] }}</a></td>
                    <td style="text-align:center; font-size:13px;">{{ $item['company'] }}</td>
                    <td style="text-align:center; color:#888;">{{ $item['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
