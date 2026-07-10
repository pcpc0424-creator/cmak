@php $page = eng_page('news/publications'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Publications') . ' - CMAK')
@section('hero', true)
@section('category', 'CMAK News')
@section('category-link', '/cmak/eng/news/publications')
@section('page-title', $page->title ?? 'Publications')
@section('side-menu')
    @include('eng.news._side')
@endsection

@include('eng.news._board-style')

@php $items = ($page?->activeItems ?? collect())->where('type','publication')->values(); @endphp

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Publications' }}</h2>
    <p class="desc">{{ $page->description ?? 'ConsMa presentation materials, papers and resources from CMAK.' }}</p>

    @include('eng.news._board-list', ['items' => $items, 'empty' => 'No publications yet.'])
</div>
@endsection
