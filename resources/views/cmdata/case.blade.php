@extends('layouts.sub')

@section('title', '수행사례 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '수행사례')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">수행사례</h2>
    <p class="sub-content-desc">건설사업관리 수행사례를 열람할 수 있습니다.</p>

    @include('components.board-list')
</div>
@endsection
