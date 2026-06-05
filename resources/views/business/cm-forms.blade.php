@extends('layouts.sub')

@section('title', 'CM관련서식 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/membership')
@section('page-title', 'CM관련서식')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM관련서식</h2>
    <p class="sub-content-desc">건설사업관리(CM) 업무 관련 각종 서식 자료입니다.</p>

    @include('components.board-list')
</div>
@endsection
