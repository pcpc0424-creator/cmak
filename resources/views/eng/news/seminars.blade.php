@php $page = eng_page('news/seminars'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Educations & Seminars') . ' - CMAK')
@section('hero', true)
@section('category', 'CMAK News')
@section('category-link', '/cmak/eng/news/publications')
@section('page-title', $page->title ?? 'Educations & Seminars')
@section('side-menu')
    @include('eng.news._side')
@endsection

@include('eng.news._board-style')

@php $items = ($page?->activeItems ?? collect())->where('type','program')->values(); @endphp

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Educations &amp; Seminars' }}</h2>
    <p class="desc">{{ $page->description ?? 'Presentation materials and papers from CMAK educations and seminars.' }}</p>

    @include('eng.news._board-list', ['items' => $items, 'empty' => 'No seminar materials yet.'])
</div>
@endsection
