@extends('layouts.sub')

@section('title', ($page->browser_title ?: $page->page_title . ' - 한국CM협회'))
@section('category', $page->category ?: 'CM 소개')
@section('category-link', $page->category_link ?: '/cmak/cmdata/about')
@section('page-title', $page->page_title)

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
{!! $page->content !!}
@endsection
