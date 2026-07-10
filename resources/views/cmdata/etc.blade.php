@extends('layouts.sub')

@section('title', '기타자료 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '기타자료')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">기타자료</h2>
    <p class="sub-content-desc">기타자료방입니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:110px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
    ])
</div>
@endsection
