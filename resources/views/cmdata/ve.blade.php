@extends('layouts.sub')

@section('title', 'VE자료 - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', 'VE자료')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">VE자료</h2>
    <p class="sub-content-desc">VE(Value Engineering) 관련 자료입니다.</p>

    @include('components.board-list')
</div>
@endsection
