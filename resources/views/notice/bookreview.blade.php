@extends('layouts.sub')

@section('title', 'Book Review - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', 'Book Review')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">Book Review</h2>
    <p class="sub-content-desc">CM, 건설, 경영, 리더십 등 실무 역량 향상에 도움이 되는 우수 도서를 소개합니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '책제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '작성자', 'field' => 'author', 'style' => 'width:90px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '출판사', 'field' => 'metadata.publisher', 'style' => 'width:100px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:100px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '조회수', 'field' => 'view_count', 'style' => 'width:55px;', 'tdStyle' => 'text-align:center; color:#888;'],
        ],
    ])
</div>
@endsection
