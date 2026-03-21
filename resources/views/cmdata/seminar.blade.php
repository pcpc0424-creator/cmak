@extends('layouts.sub')

@section('title', '교육/세미나 - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '교육/세미나')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">교육/세미나</h2>
    <p class="sub-content-desc">CM 교육 및 세미나 자료를 열람할 수 있습니다.</p>

    @include('components.board-list')
</div>
@endsection