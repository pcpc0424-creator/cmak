@php $page = eng_page('about/history'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'History') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'History')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.eng-timeline { position: relative; padding-left: 30px; margin-top: 16px; }
.eng-timeline::before { content:''; position:absolute; left:8px; top:8px; bottom:0; width:2px; background: linear-gradient(to bottom, #0061c2, #e8ecf1); }
.eng-timeline-item { position: relative; margin-bottom: 32px; padding-left: 24px; }
.eng-timeline-item::before { content:''; position:absolute; left:-26px; top:6px; width:14px; height:14px; border-radius:50%; background:#0061c2; border:3px solid #fff; box-shadow: 0 0 0 2px #0061c2; }
.eng-timeline-year { font-size: 18px; font-weight: 800; color: #0a3d7c; margin-bottom: 6px; }
.eng-timeline-text { font-size: 14.5px; color: #444; line-height: 1.7; }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'History' }}</h2>
    <p class="desc">{{ $page->description ?? 'Nearly three decades of milestones and growth.' }}</p>

    <div class="eng-timeline">
        @forelse($page?->activeItems ?? [] as $item)
            <div class="eng-timeline-item">
                <div class="eng-timeline-year">{{ $item->date_text }}</div>
                <div class="eng-timeline-text">{{ $item->description }}</div>
            </div>
        @empty
            {{-- fallback --}}
            <div class="eng-timeline-item"><div class="eng-timeline-year">1996</div><div class="eng-timeline-text">Construction Management Association of Korea (CMAK) founded.</div></div>
        @endforelse
    </div>
</div>
@endsection
