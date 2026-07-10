@extends('layouts.sub')

@section('title', '전문가 칼럼 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '전문가 칼럼')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">전문가 칼럼</h2>
    <p class="sub-content-desc">건설사업관리 분야 전문가의 인사이트를 만나보세요.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '글쓴이', 'field' => 'author', 'style' => 'width:100px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
        'searchFields' => [
            'title' => '제목',
            'author' => '글쓴이',
        ],
    ])
</div>
@endsection
