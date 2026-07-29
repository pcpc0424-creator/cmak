@extends('layouts.sub')

@section('title', 'CM 관련 서식 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', 'CM 관련 서식')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM 관련 서식</h2>
    <p class="sub-content-desc">건설사업관리(CM) 업무 관련 각종 서식·안내 자료입니다.</p>

    @include('components.board-list')
</div>
@endsection
