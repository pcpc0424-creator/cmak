@extends('layouts.sub')

@section('title', '해외CM - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '해외CM')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">해외CM</h2>
    <p class="sub-content-desc">CM 해외공급사업 관련 자료를 열람할 수 있습니다.</p>

    @include('components.board-list')
</div>
@endsection