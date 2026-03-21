@extends('layouts.sub')

@section('title', '국내외소식 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', '국내외소식')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">국내외소식</h2>
    <p class="sub-content-desc">건설사업관리 관련 국내외 최신 소식입니다.</p>

    @include('components.board-list')
</div>
@endsection