@extends('layouts.sub')

@section('title', 'CM업무절차서 - 한국CM협회')
@section('category', 'CM자료방')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', 'CM업무절차서')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM업무절차서</h2>
    <p class="sub-content-desc">CM업무절차서를 다운로드할 수 있습니다.</p>

    <div style="margin-top:20px; padding:20px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:8px;">
        <a href="/cmak/legacy/upload/data/CM1.hwp" style="display:inline-block; padding:10px 20px; background:#0061c2; color:#fff; border-radius:4px; text-decoration:none; font-weight:600;">📄 CM업무절차서 다운로드 (HWP)</a>
    </div>
</div>
@endsection
