@php $page = eng_page('news/publications'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Publications') . ' - CMAK')
@section('hero', true)
@section('category', 'CMAK News')
@section('category-link', '/cmak/eng/news/publications')
@section('page-title', $page->title ?? 'Publications')
@section('side-menu')
    @include('eng.news._side')
@endsection

@push('styles')
<style>
.eng-pub-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 22px; margin-top: 18px; }
.eng-pub { background: #fff; border: 1px solid #e8ecf1; border-radius: 14px; overflow: hidden; transition: all 0.25s; }
.eng-pub:hover { transform: translateY(-4px); box-shadow: 0 16px 32px rgba(0,0,0,0.08); }
.eng-pub-cover { height: 220px; position: relative; overflow: hidden; background: #f0f4fa; }
.eng-pub-cover img { width: 100%; height: 100%; object-fit: cover; }
.eng-pub-cover::after { content:''; position:absolute; inset:0; background: linear-gradient(to top, rgba(0,0,0,0.3), transparent 50%); }
.eng-pub-body { padding: 22px 24px 26px; }
.eng-pub-tag { display: inline-block; padding: 4px 12px; background: #f0f4fa; color: #0061c2; font-size: 11px; font-weight: 700; border-radius: 999px; margin-bottom: 10px; }
.eng-pub h4 { font-size: 16px; font-weight: 700; color: #1a1a1a; margin: 0 0 6px; line-height: 1.4; }
.eng-pub p { font-size: 13px; color: #666; line-height: 1.6; margin: 0; }
@media (max-width: 900px) { .eng-pub-grid { grid-template-columns: 1fr 1fr; } }
@media (max-width: 600px) { .eng-pub-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Publications' }}</h2>
    <p class="desc">{{ $page->description ?? 'Magazines, reports and resources from CMAK.' }}</p>

    <p>CMAK regularly publishes a range of magazines, technical reports and reference materials to inform and educate the CM community. These publications capture the latest developments, research insights and best practices in construction management.</p>

    <div class="eng-pub-grid">
        @forelse($page?->activeItems ?? [] as $item)
            <div class="eng-pub">
                @if($item->image_path)
                    <div class="eng-pub-cover"><img src="{{ $item->image_path }}" alt="{{ $item->title }}"></div>
                @endif
                <div class="eng-pub-body">
                    @if($item->tag)<span class="eng-pub-tag">{{ $item->tag }}</span>@endif
                    <h4>{{ $item->title }}</h4>
                    @if($item->description)<p>{{ $item->description }}</p>@endif
                </div>
            </div>
        @empty
            <div class="eng-pub"><div class="eng-pub-body"><h4>No publications</h4></div></div>
        @endforelse
    </div>
</div>
@endsection
