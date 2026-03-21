@extends('layouts.sub')

@section('title', '보도자료 - 한국CM협회')
@section('category', '소통공간')
@section('category-link', '/cmak/notice')
@section('page-title', '보도자료')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">보도자료</h2>
    <p class="sub-content-desc">한국CM협회의 보도자료를 확인하세요.</p>

    @include('components.board-list')
</div>
@endsection
