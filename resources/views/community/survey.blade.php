@extends('layouts.sub')

@section('title', '설문조사 - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', '설문조사')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">설문조사</h2>
    <p class="sub-content-desc">설문조사 목록입니다.</p>

    @include('components.board-list')
</div>
@endsection
