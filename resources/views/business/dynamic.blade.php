@extends('layouts.sub')

@section('title', ($page->browser_title ?: $page->page_title . ' - 한국CM협회'))
@section('category', $page->category ?: '협회업무')
@section('category-link', $page->category_link ?: '/cmak/business/membership')
@section('page-title', $page->page_title)

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
{!! $page->content !!}
@endsection
