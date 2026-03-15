@extends('layouts.sub')

@section('title', '언론관련기관 - 한국CM협회')
@section('category', '관련사이트')
@section('category-link', '/cmak/reference/domestic')
@section('page-title', '언론관련기관')

@section('side-menu')
    @include('reference._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">언론관련기관</h2>
    <p class="sub-content-desc">건설 관련 언론사 링크입니다.</p>

    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:12px;">
        <div class="sub-info-box" style="text-align:center; padding:30px;">
            <p style="color:#999; font-size:14px;">관련 기관 링크가 준비중입니다.</p>
        </div>
    </div>
</div>
@endsection