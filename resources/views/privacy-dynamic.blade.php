@extends('layouts.sub')

@section('title', ($page->browser_title ?: $page->page_title . ' - 한국CM협회'))
@section('category', $page->category ?: '개인정보처리방침')
@section('category-link', $page->category_link ?: '/privacy')
@section('page-title', $page->page_title)

@section('content')
{!! $page->content !!}
@endsection
