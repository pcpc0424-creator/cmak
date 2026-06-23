@extends('layouts.sub')

@section('title', 'CM30년 - 한국CM협회')
@section('category', 'CM30년')
@section('category-link', '/cmak/cm30')
@section('page-title', 'CM30년')

@section('side-menu')
    <a href="{{ url('/cm30') }}" class="{{ request()->is('cmak/cm30') || request()->is('cm30') ? 'active' : '' }}">CM30년</a>
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM30년</h2>
    <p class="sub-content-desc">한국CM협회 30년의 발자취와 주요 기록을 소개합니다.</p>

    @include('components.board-list')
</div>
@endsection
