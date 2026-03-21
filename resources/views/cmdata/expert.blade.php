@extends('layouts.sub')

@section('title', '전문가칼럼 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '전문가칼럼')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">전문가칼럼</h2>
    <p class="sub-content-desc">건설사업관리 분야 전문가의 인사이트를 만나보세요.</p>

    @include('components.board-list')
</div>
@endsection
