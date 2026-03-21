@extends('layouts.sub')

@section('title', '법령정보 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '법령정보')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">법령정보</h2>
    <p class="sub-content-desc">건설사업관리 관련 법령 및 제도 정보를 제공합니다.</p>

    @include('components.board-list')
</div>
@endsection
