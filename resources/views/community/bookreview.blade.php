@extends('layouts.sub')

@section('title', 'BookReview - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', 'BookReview')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">BookReview</h2>
    <p class="sub-content-desc">CM 분야 도서 리뷰를 공유합니다.</p>

    @include('components.board-list')
</div>
@endsection