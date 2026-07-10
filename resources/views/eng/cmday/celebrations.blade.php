@php $page = eng_page('cmday/celebrations'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'CM Day Celebrations') . ' - CMAK')
@section('hero', true)
@section('category', 'International CM Day')
@section('category-link', '/cmak/eng/cmday/introduction')
@section('page-title', $page->title ?? 'Celebrations')
@section('side-menu')
    @include('eng.cmday._side')
@endsection

@include('eng.news._board-style')

@php $items = ($page?->activeItems ?? collect())->where('type','gallery')->values(); @endphp

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'International CM Day Celebrations' }}</h2>
    <p class="desc">{{ $page->description ?? 'CM case studies and materials from the International CM Day and Global CM Contest (ConsMa).' }}</p>

    @include('eng.news._board-list', ['items' => $items, 'empty' => 'No materials yet.'])
</div>
@endsection
