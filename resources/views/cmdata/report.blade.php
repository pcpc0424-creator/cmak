@extends('layouts.sub')

@section('title', '논문/연구보고서 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '논문/연구보고서')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">논문/연구보고서</h2>
    <p class="sub-content-desc">건설사업관리 관련 논문 및 연구보고서를 열람할 수 있습니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '저자', 'field' => 'author', 'style' => 'width:100px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '발표일', 'field' => 'published_at', 'style' => 'width:110px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
        'searchFields' => [
            'title' => '논문명',
            'author' => '저자',
        ],
    ])
</div>
@endsection
