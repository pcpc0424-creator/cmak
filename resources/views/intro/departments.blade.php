@extends('layouts.sub')

@section('title', '부서별 업무안내 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/greeting')
@section('page-title', '부서별 업무안내')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">부서별 업무안내</h2>
    <p class="sub-content-desc">한국CM협회의 부서별 업무를 안내합니다.</p>

    <div class="sub-section">
        <p>페이지 콘텐츠가 준비중입니다.</p>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>한국CM협회 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr</dd>
    </div>
</div>
@endsection