@extends('layouts.sub')

@section('title', '구직 - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', '구직')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">구직</h2>
    <p class="sub-content-desc">구직 정보입니다.</p>

    @include('components.board-list')
</div>
@endsection
