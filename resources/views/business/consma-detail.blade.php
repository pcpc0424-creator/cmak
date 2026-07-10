@extends('layouts.sub')

@section('title', ($edition->main_text ?: 'ConsMa ' . $edition->year) . ' - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/consma')
@section('page-title', 'ConsMa')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <h2 class="sub-content-title" style="margin:0;">{{ $edition->main_text ?: 'ConsMa ' . $edition->year }}</h2>
        <a href="/cmak/business/consma" style="font-size:13px; color:#0061c2; text-decoration:none;">← 목록으로</a>
    </div>
    @if($edition->sub_text)
        <p class="sub-content-desc">{{ $edition->sub_text }}</p>
    @endif

    <div class="consma-detail">
        @if($edition->full_path)
            <img src="/cmak/{{ ltrim($edition->full_path, '/') }}" alt="{{ $edition->main_text ?: 'ConsMa ' . $edition->year }}">
        @endif

        @if($edition->detail_content)
            <div class="consma-detail-body">{!! $edition->detail_content !!}</div>
        @endif

        @if($edition->detail_url)
            <div style="text-align:center; margin-top:24px;">
                <a href="{{ $edition->detail_url }}" target="_blank" rel="noopener noreferrer" class="consma-detail-btn">자세히 보기</a>
            </div>
        @endif
    </div>
</div>

<style>
    .consma-detail { margin-top: 20px; text-align: center; }
    .consma-detail img {
        max-width: 100%;
        height: auto;
        border: 1px solid #e8ecf1;
        border-radius: 6px;
    }
    .consma-detail-body { text-align: left; margin-top: 24px; line-height: 1.8; color: #333; }
    .consma-detail-btn {
        display: inline-block;
        padding: 10px 26px;
        background: #0061c2;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 600;
    }
    .consma-detail-btn:hover { background: #004e9c; }
</style>
@endsection
