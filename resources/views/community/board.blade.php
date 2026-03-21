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

    @include('components.board-list')
</div>
@endsection
