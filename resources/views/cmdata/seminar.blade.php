@extends('layouts.sub')

@section('title', '교육 및 세미나 자료 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '교육 및 세미나 자료')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">교육 및 세미나 자료</h2>
    <p class="sub-content-desc">CM 교육 및 세미나 자료를 열람할 수 있습니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '강사', 'field' => 'author', 'style' => 'width:100px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '소속', 'field' => 'metadata.affiliation', 'style' => 'width:120px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
        'searchFields' => [
            'title' => '제목',
            'author' => '강사',
        ],
    ])
</div>
@endsection
