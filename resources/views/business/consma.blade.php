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
                    {{-- 포스터는 background-image로 출력: 전역 img 규칙(height:auto !important 등)의
                         영향을 받지 않아 어떤 화면 폭·브라우저에서도 동일하게 보임 --}}
                    <div class="consma-thumb"
                         @if($e->thumb_path) style="background-image:url('/cmak/{{ ltrim($e->thumb_path, '/') }}');" @endif
                         role="img" aria-label="ConsMa {{ $e->year }} 포스터">
                        @unless($e->thumb_path)
                            <span class="consma-noimg">{{ $e->year }}</span>
                        @endunless
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
    /* 3:4 비율 유지 - aspect-ratio 미지원 브라우저에서 높이가 0이 되어
       썸네일이 안 보이는 문제가 있어 padding 방식으로 높이를 잡음 */
    .consma-thumb {
        position: relative;
        width: 100%;
        height: 0;
        padding-top: 133.3333%;   /* 3:4 비율(aspect-ratio 미지원 브라우저 대응) */
        background-color: #f4f6f9;
        background-position: center top;
        background-repeat: no-repeat;
        background-size: cover;
        overflow: hidden;
    }
    .consma-noimg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #b8c1cd;
        font-size: 24px;
        font-weight: 700;
    }
    .consma-caption { padding: 12px 14px; }
    .consma-caption strong { display: block; font-size: 15px; color: #1a2b45; }
    .consma-caption span { display: block; font-size: 13px; color: #7a8699; margin-top: 3px; }
    @media (max-width: 520px) {
        .consma-grid { grid-template-columns: repeat(2, 1fr); gap: 14px; }
    }
</style>
@endsection
