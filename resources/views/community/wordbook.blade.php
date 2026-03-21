@extends('layouts.sub')

@section('title', 'WordBook - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', 'WordBook')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">WordBook</h2>
    <p class="sub-content-desc">건설사업관리 용어사전입니다.</p>

    @include('components.board-list')
</div>
@endsection