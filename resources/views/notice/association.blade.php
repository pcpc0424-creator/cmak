@extends('layouts.sub')

@section('title', '협회소식 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', '협회소식')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">협회소식</h2>
    <p class="sub-content-desc">한국CM협회의 주요 소식입니다.</p>

    @include('components.board-list')
</div>
@endsection