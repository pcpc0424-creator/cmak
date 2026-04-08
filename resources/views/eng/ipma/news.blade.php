@php $page = eng_page('ipma/news'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'IPMA News & Events') . ' - CMAK')
@section('hero', true)
@section('category', 'IPMA Korea')
@section('category-link', '/cmak/eng/ipma/about')
@section('page-title', $page->title ?? 'News & Events')
@section('side-menu')
    @include('eng.ipma._side')
@endsection

@push('styles')
<style>
.eng-news-list { margin-top: 18px; }
.eng-news-row { display: flex; gap: 22px; padding: 22px 0; border-bottom: 1px solid #f0f0f0; }
.eng-news-row:last-child { border-bottom: none; }
.eng-news-date { flex-shrink: 0; width: 84px; text-align: center; padding-right: 22px; border-right: 1px solid #e8ecf1; }
.eng-news-date .day { display: block; font-size: 28px; font-weight: 800; color: #0061c2; line-height: 1; }
.eng-news-date .my { display: block; font-size: 12px; color: #888; margin-top: 4px; }
.eng-news-body h4 { font-size: 16px; font-weight: 700; color: #1a1a1a; margin: 0 0 6px; }
.eng-news-body p { font-size: 13.5px; color: #666; line-height: 1.6; margin: 0; }
.eng-news-tag { display: inline-block; padding: 3px 10px; background: #f0f4fa; color: #0061c2; font-size: 11px; font-weight: 700; border-radius: 999px; margin-bottom: 6px; }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'News &amp; Events' }}</h2>
    <p class="desc">{{ $page->description ?? 'Latest news and upcoming events from IPMA Korea.' }}</p>

    <div class="eng-news-list">
        @forelse($page?->activeItems ?? [] as $item)
            @php
                // Parse "15 APR 2026" -> day "15", my "APR 2026"
                $parts = explode(' ', trim($item->date_text ?? ''), 2);
                $day = $parts[0] ?? '';
                $my = $parts[1] ?? '';
            @endphp
            <div class="eng-news-row">
                <div class="eng-news-date">
                    <span class="day">{{ $day }}</span>
                    <span class="my">{{ $my }}</span>
                </div>
                <div class="eng-news-body">
                    @if($item->tag) <span class="eng-news-tag">{{ $item->tag }}</span> @endif
                    <h4>{{ $item->title }}</h4>
                    @if($item->description) <p>{{ $item->description }}</p> @endif
                </div>
            </div>
        @empty
            <div class="eng-news-row"><div class="eng-news-body"><p>No news available.</p></div></div>
        @endforelse
    </div>
</div>
@endsection
