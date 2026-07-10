@extends('layouts.sub')

@section('title', 'ConsMa - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/consma')
@section('page-title', 'ConsMa')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">ConsMa</h2>
    <p class="sub-content-desc">연도별 ConsMa 포스터입니다. 포스터를 클릭하시면 자세히 보실 수 있습니다.</p>

    @if($editions->isEmpty())
        <p style="text-align:center; padding:40px; color:#999;">등록된 포스터가 없습니다.</p>
    @else
        <div class="consma-grid">
            @foreach($editions as $e)
                <a href="/cmak/business/consma/{{ $e->year }}" class="consma-card">
                    <div class="consma-thumb">
                        @if($e->thumb_path)
                            <img src="/cmak/{{ ltrim($e->thumb_path, '/') }}" alt="ConsMa {{ $e->year }}" loading="lazy">
                        @else
                            <span class="consma-noimg">{{ $e->year }}</span>
                        @endif
                    </div>
                    <div class="consma-caption">
                        <strong>{{ $e->main_text ?: 'ConsMa ' . $e->year }}</strong>
                        @if($e->sub_text)<span>{{ $e->sub_text }}</span>@endif
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

<style>
    .consma-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 22px;
        margin-top: 24px;
    }
    .consma-card {
        display: block;
        text-decoration: none;
        color: inherit;
        border: 1px solid #e8ecf1;
        border-radius: 8px;
        overflow: hidden;
        background: #fff;
        transition: box-shadow .2s, transform .2s;
    }
    .consma-card:hover {
        box-shadow: 0 8px 24px rgba(0,0,0,.12);
        transform: translateY(-3px);
    }
    .consma-thumb {
        width: 100%;
        aspect-ratio: 3 / 4;
        background: #f4f6f9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    .consma-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .consma-noimg { color: #b8c1cd; font-size: 24px; font-weight: 700; }
    .consma-caption { padding: 12px 14px; }
    .consma-caption strong { display: block; font-size: 15px; color: #1a2b45; }
    .consma-caption span { display: block; font-size: 13px; color: #7a8699; margin-top: 3px; }
    @media (max-width: 520px) {
        .consma-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }
</style>
@endsection
