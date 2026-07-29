@extends('layouts.sub')

@section('title', 'CM Herald - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/herald')
@section('page-title', 'CM Herald')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM Herald</h2>
    <p class="sub-content-desc">한국CM협회가 매월 발행하는 소식지입니다. 표지를 클릭하면 웹진으로 볼 수 있습니다.</p>

    @if($issues->isEmpty())
        <div style="padding:60px 20px; text-align:center; color:#999; font-size:14px;">
            등록된 CM Herald가 없습니다.
        </div>
    @else
        <div class="herald-shelf">
            @foreach($issues as $issue)
                @php
                    $cover = $issue->cover_image ? '/cmak/' . ltrim($issue->cover_image, '/') : null;
                    $webzine = $issue->webzine_url
                        ? (\Illuminate\Support\Str::startsWith($issue->webzine_url, ['http://', 'https://']) ? $issue->webzine_url : '/cmak/' . ltrim($issue->webzine_url, '/'))
                        : null;
                @endphp
                <div class="herald-book">
                    <a href="{{ $webzine ?: '#' }}" {{ $webzine ? 'target=_blank rel=noopener' : '' }} class="herald-cover-link">
                        <div class="herald-cover">
                            @if($cover)
                                <img src="{{ $cover }}" alt="{{ $issue->title }}">
                            @else
                                <div class="herald-cover-placeholder">
                                    <span>CM Herald</span>
                                    <strong>{{ $issue->title }}</strong>
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="herald-meta">
                        <div class="herald-title">{{ $issue->title }}</div>
                        @if($issue->issue_date)
                            <div class="herald-date">{{ $issue->issue_date->format('Y.m') }}</div>
                        @endif
                    </div>
                    @if($webzine)
                        <a href="{{ $webzine }}" target="_blank" rel="noopener" class="herald-webzine-btn">웹진보기</a>
                    @else
                        <span class="herald-webzine-btn disabled">준비중</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.herald-shelf {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 28px 20px;
    margin-top: 24px;
}
.herald-book { display: flex; flex-direction: column; align-items: center; }
.herald-cover-link { display: block; width: 100%; }
/* 3:4 비율 유지 - aspect-ratio 미지원 브라우저 대응(높이 0 방지) */
.herald-cover {
    position: relative;
    width: 100%;
    height: 0;
    padding-top: 133.3333%;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0 8px 20px rgba(0,0,0,0.18);
    border: 1px solid #e5e7eb;
    background: #f3f4f6;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.herald-cover-link:hover .herald-cover { transform: translateY(-6px); box-shadow: 0 16px 32px rgba(0,0,0,0.25); }
.herald-cover img,
.herald-cover-placeholder { position: absolute; top: 0; left: 0; }
.herald-cover img { width: 100%; height: 100%; object-fit: cover; }
.herald-cover-placeholder {
    width: 100%; height: 100%;
    display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px;
    background: linear-gradient(135deg, #1a3a5c, #2d6da8); color: #fff; text-align: center; padding: 14px;
}
.herald-cover-placeholder span { font-size: 12px; letter-spacing: 1px; opacity: 0.85; }
.herald-cover-placeholder strong { font-size: 15px; font-weight: 700; }
.herald-meta { text-align: center; margin-top: 12px; }
.herald-title { font-size: 14px; font-weight: 600; color: #222; }
.herald-date { font-size: 12px; color: #888; margin-top: 2px; }
.herald-webzine-btn {
    margin-top: 10px;
    display: inline-block;
    padding: 7px 18px;
    background: #265de8; color: #fff;
    border-radius: 18px; font-size: 12.5px; font-weight: 600; text-decoration: none;
    transition: background 0.2s;
}
.herald-webzine-btn:hover { background: #1b49c0; }
.herald-webzine-btn.disabled { background: #c4c9d4; cursor: default; }

@media (max-width: 1024px) { .herald-shelf { grid-template-columns: repeat(3, 1fr); } }
@media (max-width: 640px)  { .herald-shelf { grid-template-columns: repeat(2, 1fr); gap: 22px 14px; } }
</style>
@endsection
