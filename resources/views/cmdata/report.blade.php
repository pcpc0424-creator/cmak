@extends('layouts.sub')

@section('title', '논문/연구보고서 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '논문/연구보고서')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">논문/연구보고서</h2>
    <p class="sub-content-desc">건설사업관리 관련 논문 및 연구보고서를 열람할 수 있습니다.</p>

    @include('components.board-list')
</div>
@endsection
