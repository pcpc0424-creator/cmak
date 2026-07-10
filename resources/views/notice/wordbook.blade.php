@extends('layouts.sub')

@section('title', 'CM을 부탁해 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', 'CM을 부탁해')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM을 부탁해</h2>
    <p class="sub-content-desc">건설, 정책, 경제, 시사 분야의 주요 용어와 개념을 쉽고 알기 쉽게 정리한 단어 모음입니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '내용', 'field' => 'excerpt', 'style' => 'width:300px;', 'tdStyle' => 'color:#888; font-size:12px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:300px;'],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:110px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
        ],
    ])
</div>
@endsection
