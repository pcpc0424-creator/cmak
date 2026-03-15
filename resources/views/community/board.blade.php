@extends('layouts.sub')

@section('title', '자유게시판 - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', '자유게시판')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">자유게시판</h2>
    <p class="sub-content-desc">건설사업관리에 관한 자유로운 의견을 나누는 공간입니다.</p>

    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <input type="text" placeholder="검색어를 입력하세요" style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </div>

    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                <th style="width:80px;">작성자</th>
                <th style="width:100px;">조회</th>
                <th style="width:110px;">등록일</th>
            </tr>
        </thead>
        <tbody>
            @php
                $items = [
                    ['no' => 156, 'title' => 'CM전문교육 수강 후기 공유합니다', 'author' => '김**', 'views' => 89, 'date' => '2026-03-08'],
                    ['no' => 155, 'title' => 'CMP 자격검정 준비 스터디 모집', 'author' => '이**', 'views' => 134, 'date' => '2026-03-01'],
                    ['no' => 154, 'title' => '해외 CM 프로젝트 경험 공유', 'author' => '박**', 'views' => 212, 'date' => '2026-02-20'],
                    ['no' => 153, 'title' => 'BIM 활용 CM 업무 효율화 관련 문의', 'author' => '최**', 'views' => 167, 'date' => '2026-02-15'],
                    ['no' => 152, 'title' => '시공책임형 CM 실무 경험담', 'author' => '정**', 'views' => 198, 'date' => '2026-02-08'],
                ];
            @endphp
            @foreach($items as $item)
                <tr>
                    <td style="text-align:center;">{{ $item['no'] }}</td>
                    <td><a href="#" style="color:#333; text-decoration:none;">{{ $item['title'] }}</a></td>
                    <td style="text-align:center;">{{ $item['author'] }}</td>
                    <td style="text-align:center; color:#888;">{{ $item['views'] }}</td>
                    <td style="text-align:center; color:#888;">{{ $item['date'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
