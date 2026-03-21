@extends('layouts.sub')

@section('title', '주요행사일정 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', '주요행사일정')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">주요행사일정</h2>
    <p class="sub-content-desc">한국CM협회 주요 행사 일정입니다.</p>

    @include('components.board-list')
</div>
@endsection
