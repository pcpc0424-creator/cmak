@extends('layouts.eng')

@section('title', ($page->title ?: 'CMAK') . ' - CMAK')
@section('hero', true)
@section('category', $category)
@section('category-link', $categoryLink)
@section('page-title', $page->title ?: '')

@section('side-menu')
    @include($sideMenu)
@endsection

@section('content')
{!! $page->content !!}
@endsection
