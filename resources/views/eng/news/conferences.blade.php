@php $page = eng_page('news/conferences'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Conferences & Events') . ' - CMAK')
@section('hero', true)
@section('category', 'CMAK News')
@section('category-link', '/cmak/eng/news/publications')
@section('page-title', $page->title ?? 'Conferences & Events')
@section('side-menu')
    @include('eng.news._side')
@endsection

@push('styles')
<style>
.eng-event-list { margin-top: 18px; display: flex; flex-direction: column; gap: 18px; }
.eng-event { display: flex; gap: 24px; padding: 26px; background: #f8f9fb; border: 1px solid #e8ecf1; border-radius: 14px; transition: all 0.25s; }
.eng-event:hover { background: #fff; border-color: #0061c2; box-shadow: 0 14px 28px rgba(10,61,124,0.10); transform: translateY(-2px); }
.eng-event-thumb { flex-shrink: 0; width: 200px; height: 140px; border-radius: 10px; overflow: hidden; }
.eng-event-thumb img { width: 100%; height: 100%; object-fit: cover; }
.eng-event-info h4 { font-size: 18px; font-weight: 800; color: #1a1a1a; margin: 0 0 10px; }
.eng-event-meta { display: flex; flex-wrap: wrap; gap: 16px; font-size: 13px; color: #666; margin-bottom: 10px; }
.eng-event-meta span { display: flex; align-items: center; gap: 5px; }
.eng-event-info p { font-size: 14px; color: #555; line-height: 1.65; margin: 0; }
@media (max-width: 700px) { .eng-event { flex-direction: column; } .eng-event-thumb { width: 100%; height: 180px; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Conferences &amp; Events' }}</h2>
    <p class="desc">{{ $page->description ?? 'Major conferences, forums and events organized by CMAK.' }}</p>

    <p>CMAK hosts and supports a range of conferences, forums and special events throughout the year, both in Korea and internationally. These gatherings serve as the premier platforms for the CM community to share knowledge, network and shape the future of construction management.</p>

    <div class="eng-event-list">
        @forelse($page?->activeItems ?? [] as $item)
            <div class="eng-event">
                @if($item->image_path)
                    <div class="eng-event-thumb"><img src="{{ $item->image_path }}" alt="{{ $item->title }}"></div>
                @endif
                <div class="eng-event-info">
                    <h4>{{ $item->title }}</h4>
                    <div class="eng-event-meta">
                        @if($item->date_text) <span>📅 {{ $item->date_text }}</span> @endif
                        @if($item->subtitle) <span>📍 {{ $item->subtitle }}</span> @endif
                    </div>
                    @if($item->description) <p>{{ $item->description }}</p> @endif
                </div>
            </div>
        @empty
            <div class="eng-event"><div class="eng-event-info"><p>No events scheduled.</p></div></div>
        @endforelse
    </div>
</div>
@endsection
