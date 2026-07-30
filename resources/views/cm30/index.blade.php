@extends('layouts.sub')

@section('title', 'CM30년 - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', 'CM30년')

@section('side-menu')
    {{-- 헤더 드롭다운과 동일하게 CM 소개 하위 항목이므로 같은 사이드메뉴를 쓴다 --}}
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM30년</h2>
    <p class="sub-content-desc">한국CM협회 30년의 발자취와 주요 기록을 소개합니다.</p>

    @include('components.board-list')
</div>
@endsection
