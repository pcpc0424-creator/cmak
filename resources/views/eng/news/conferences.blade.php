@php $page = eng_page('news/conferences'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Conferences & Events') . ' - CMAK')
@section('hero', true)
@section('category', 'CMAK News')
@section('category-link', '/cmak/eng/news/publications')
@section('page-title', $page->title ?? 'Conferences & Events')
@section('side-menu')
    @include('eng.news._side')
@endsection

@include('eng.news._board-style')

@php $items = ($page?->activeItems ?? collect())->where('type','event')->values(); @endphp

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Conferences &amp; Events' }}</h2>
    <p class="desc">{{ $page->description ?? 'Conferences, forums and events organized and supported by CMAK.' }}</p>

    @include('eng.news._board-list', ['items' => $items, 'empty' => 'No events yet.'])
</div>
@endsection
