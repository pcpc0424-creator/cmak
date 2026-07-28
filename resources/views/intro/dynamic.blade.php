@extends('layouts.sub')

@section('title', ($page->browser_title ?: $page->page_title . ' - 한국CM협회'))
@section('category', $page->category ?: '협회소개')
@section('category-link', $page->category_link ?: '/cmak/intro/greeting')
@section('page-title', $page->page_title)

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
{!! $page->content !!}
@endsection
