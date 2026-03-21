@extends('layouts.sub')

@section('title', '사진갤러리 - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', '사진갤러리')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">사진갤러리</h2>
    <p class="sub-content-desc">사진 갤러리입니다.</p>

    @include('components.board-list')
</div>
@endsection
