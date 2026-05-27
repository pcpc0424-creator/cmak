@extends('layouts.sub')

@section('title', '기획/특집 - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '기획/특집')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">기획/특집</h2>
    <p class="sub-content-desc">CM 기획특집 기사를 열람할 수 있습니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '출처', 'field' => 'author', 'style' => 'width:100px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:110px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
        'searchFields' => [
            'title' => '제목',
            'author' => '출처',
        ],
    ])
</div>
@endsection
