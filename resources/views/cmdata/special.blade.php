@extends('layouts.sub')

@section('title', '기획/특집 - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '기획/특집')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">기획/특집</h2>
    <p class="sub-content-desc">CM 기획특집 기사를 열람할 수 있습니다.</p>

    @include('components.board-list')
</div>
@endsection