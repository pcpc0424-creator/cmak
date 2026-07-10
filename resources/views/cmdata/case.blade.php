@extends('layouts.sub')

@section('title', '수행사례 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '수행사례')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">수행사례</h2>
    <p class="sub-content-desc">건설사업관리 수행사례를 열람할 수 있습니다.</p>

    @include('components.board-list', [
        'columns' => [
            ['label' => '사업명', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '발주자', 'field' => 'metadata.orderer', 'style' => 'width:120px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '건설사업관리자', 'field' => 'metadata.cm_manager', 'style' => 'width:130px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:110px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
        'searchFields' => [
            'title' => '사업명',
            'metadata.orderer' => '발주자',
            'metadata.cm_manager' => '건설사업관리자',
        ],
    ])
</div>
@endsection
