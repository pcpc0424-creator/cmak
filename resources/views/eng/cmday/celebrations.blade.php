@php $page = eng_page('cmday/celebrations'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'CM Day Celebrations') . ' - CMAK')
@section('hero', true)
@section('category', 'International CM Day')
@section('category-link', '/cmak/eng/cmday/introduction')
@section('page-title', $page->title ?? 'Celebrations')
@section('side-menu')
    @include('eng.cmday._side')
@endsection

@push('styles')
<style>
.eng-celeb-hero { position: relative; height: 320px; border-radius: 14px; overflow: hidden; margin-bottom: 28px; }
.eng-celeb-hero img { width: 100%; height: 100%; object-fit: cover; }
.eng-celeb-hero::after { content:''; position:absolute; inset:0; background: linear-gradient(135deg, rgba(10,61,124,0.7), rgba(0,97,194,0.4)); }
.eng-celeb-hero-text { position:absolute; inset:0; display:flex; flex-direction:column; justify-content:center; padding: 0 40px; color:#fff; z-index:2; }
.eng-celeb-hero-text h3 { font-size: 28px; font-weight: 800; margin: 0 0 10px; border:none; padding:0; color:#fff; }
.eng-celeb-hero-text p { color: rgba(255,255,255,0.92); font-size: 15px; margin: 0; }

.eng-gallery { display: grid; grid-template-columns: repeat(3, 1fr); gap: 16px; margin: 18px 0; }
.eng-gallery-item { position: relative; height: 200px; border-radius: 12px; overflow: hidden; }
.eng-gallery-item img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s; }
.eng-gallery-item:hover img { transform: scale(1.08); }
.eng-gallery-item::after { content:''; position:absolute; inset:0; background:linear-gradient(to top, rgba(0,0,0,0.5), transparent 40%); }
.eng-gallery-item span { position:absolute; left:14px; bottom:12px; color:#fff; font-size:13px; font-weight:600; z-index:2; }
@media (max-width: 700px) { .eng-gallery { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'International CM Day Celebrations' }}</h2>
    <p class="desc">{{ $page->description ?? 'Highlights of past and upcoming CM Day events.' }}</p>

    <div class="eng-celeb-hero">
        <img src="/cmak/images/eng/eng4.jpg" alt="International CM Day">
        <div class="eng-celeb-hero-text">
            <h3>Celebrating Construction Management Worldwide</h3>
            <p>Bringing together CM professionals from around the globe to honour the discipline that builds our world.</p>
        </div>
    </div>

    <h3>Programme Highlights</h3>
    <p>Each annual celebration of International CM Day in Korea typically features the following programme elements:</p>
    <ul>
        <li><strong>Opening Ceremony</strong> &mdash; welcome by the CMAK Chairman and remarks from government, partner associations and international guests</li>
        <li><strong>Keynote Lectures</strong> &mdash; talks from leading CM experts on the future of CM, smart construction, sustainability and global trends</li>
        <li><strong>Technical Sessions</strong> &mdash; presentations and panel discussions on CM practice, BIM, project delivery and innovation</li>
        <li><strong>Awards &amp; Recognition</strong> &mdash; honouring outstanding CM projects, professionals and contributions</li>
        <li><strong>Networking Reception</strong> &mdash; an opportunity for CM professionals from Korea and abroad to connect</li>
    </ul>

    <h3>Photo Highlights</h3>
    <div class="eng-gallery">
        @forelse($page?->activeItems ?? [] as $item)
            <div class="eng-gallery-item">
                <img src="{{ $item->image_path }}" alt="{{ $item->title }}">
                <span>{{ $item->title }}</span>
            </div>
        @empty
            <div class="eng-gallery-item"><img src="/cmak/images/eng/eng5.jpg" alt=""><span>Opening Ceremony</span></div>
        @endforelse
    </div>

    <p style="margin-top: 24px;"><a href="/cmak/eng/cmday/registration" class="eng-lang-btn" style="border-color:#0061c2;color:#0061c2;">Register for CM Day &rarr;</a></p>
</div>
@endsection
