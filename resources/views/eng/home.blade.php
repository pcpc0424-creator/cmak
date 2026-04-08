@php $page = eng_page('home'); @endphp
@extends('layouts.eng')

@section('title', $page->title ?? 'CMAK - Construction Management Association of Korea')

@push('styles')
<style>
    /* === Main Visual Slider === */
    .eng-hero {
        position: relative;
        margin-top: 80px;
        height: calc(100vh - 80px);
        min-height: 560px;
        max-height: 760px;
        overflow: hidden;
        background: #0a3d7c;
    }
    .eng-hero-slide {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 1s ease;
    }
    .eng-hero-slide.active {
        opacity: 1;
        z-index: 1;
    }
    /* FOUC fallback: show first slide before Alpine initializes */
    .eng-hero-slide:first-child { opacity: 1; }
    [x-data] .eng-hero-slide:first-child:not(.active) { opacity: 0; }
    .eng-hero-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .eng-hero-slide::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(10,61,124,0.62) 0%, rgba(0,0,0,0.40) 60%, rgba(0,0,0,0.20) 100%);
    }
    .eng-hero-content {
        position: absolute;
        inset: 0;
        z-index: 5;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 0 30px;
        pointer-events: none;
    }
    .eng-hero-content > div {
        max-width: 980px;
        color: #fff;
    }
    .eng-hero-content .eyebrow {
        display: inline-block;
        padding: 8px 18px;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 24px;
    }
    .eng-hero-content h2 {
        font-size: 4rem;
        font-weight: 800;
        line-height: 1.15;
        letter-spacing: -1.5px;
        margin: 0 0 22px;
        text-shadow: 0 4px 30px rgba(0,0,0,0.3);
    }
    .eng-hero-content p {
        font-size: 1.15rem;
        line-height: 1.7;
        opacity: 0.95;
        max-width: 720px;
        margin: 0 auto 36px;
    }
    .eng-hero-cta {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 16px 32px;
        background: #fff;
        color: #0a3d7c;
        font-weight: 700;
        font-size: 15px;
        border-radius: 999px;
        text-decoration: none;
        pointer-events: auto;
        transition: all 0.25s;
        box-shadow: 0 12px 32px rgba(0,0,0,0.25);
    }
    .eng-hero-cta:hover {
        transform: translateY(-2px);
        background: #0061c2;
        color: #fff;
    }
    .eng-hero-nav {
        position: absolute;
        bottom: 40px; left: 0; right: 0;
        z-index: 6;
        display: flex;
        justify-content: center;
        gap: 12px;
    }
    .eng-hero-dot {
        width: 12px; height: 12px;
        border-radius: 50%;
        background: rgba(255,255,255,0.4);
        border: 1.5px solid rgba(255,255,255,0.6);
        cursor: pointer;
        transition: all 0.25s;
    }
    .eng-hero-dot.active {
        width: 36px;
        border-radius: 6px;
        background: #fff;
    }
    .eng-hero-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 6;
        width: 56px; height: 56px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.12);
        border: 1.5px solid rgba(255,255,255,0.25);
        backdrop-filter: blur(10px);
        border-radius: 50%;
        cursor: pointer;
        color: #fff;
        transition: all 0.25s;
    }
    .eng-hero-arrow:hover {
        background: rgba(255,255,255,0.25);
        border-color: rgba(255,255,255,0.5);
    }
    .eng-hero-arrow.prev { left: 30px; }
    .eng-hero-arrow.next { right: 30px; }

    @media (max-width: 768px) {
        .eng-hero { min-height: 480px; }
        .eng-hero-content h2 { font-size: 2.2rem; }
        .eng-hero-content p { font-size: 0.95rem; }
        .eng-hero-arrow { display: none; }
    }

    /* === Sections === */
    .eng-section {
        padding: 110px 20px;
    }
    .eng-section-inner {
        max-width: 1300px;
        margin: 0 auto;
    }
    .eng-section-head {
        text-align: center;
        margin-bottom: 70px;
    }
    .eng-section-head .eyebrow {
        display: inline-block;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 3px;
        color: #0061c2;
        text-transform: uppercase;
        margin-bottom: 14px;
    }
    .eng-section-head h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #1a1a1a;
        letter-spacing: -1px;
        margin: 0 0 18px;
        line-height: 1.2;
    }
    .eng-section-head p {
        font-size: 1.05rem;
        color: #666;
        line-height: 1.7;
        max-width: 720px;
        margin: 0 auto;
    }

    /* About cards */
    .eng-about-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .eng-about-card {
        background: #fff;
        border: 1px solid #e8ecf1;
        border-radius: 16px;
        padding: 38px 32px;
        text-decoration: none;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
    }
    .eng-about-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, #0a3d7c, #0061c2);
        opacity: 0;
        transition: opacity 0.3s;
        z-index: 0;
    }
    .eng-about-card > * { position: relative; z-index: 1; }
    .eng-about-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 24px 48px rgba(10,61,124,0.18);
    }
    .eng-about-card:hover::before { opacity: 1; }
    .eng-about-card:hover h3, .eng-about-card:hover p, .eng-about-card:hover .num { color: #fff; }
    .eng-about-card .num {
        font-size: 13px;
        font-weight: 800;
        color: #0061c2;
        letter-spacing: 2px;
        transition: color 0.3s;
    }
    .eng-about-card h3 {
        font-size: 22px;
        font-weight: 800;
        color: #1a1a1a;
        margin: 14px 0 14px;
        letter-spacing: -0.5px;
        transition: color 0.3s;
    }
    .eng-about-card p {
        font-size: 14.5px;
        line-height: 1.75;
        color: #666;
        margin: 0;
        transition: color 0.3s;
    }
    @media (max-width: 900px) {
        .eng-about-grid { grid-template-columns: 1fr; }
    }

    /* Highlight (CM Day) */
    .eng-highlight {
        background: linear-gradient(135deg, #0a3d7c 0%, #0061c2 100%);
        color: #fff;
        position: relative;
        overflow: hidden;
    }
    .eng-highlight::before {
        content: '';
        position: absolute; inset: 0;
        background: url('/cmak/images/eng/eng3.jpg') center/cover;
        opacity: 0.18;
    }
    .eng-highlight-inner {
        position: relative;
        max-width: 1300px;
        margin: 0 auto;
        padding: 100px 20px;
        display: grid;
        grid-template-columns: 1.2fr 1fr;
        gap: 60px;
        align-items: center;
    }
    .eng-highlight h2 {
        font-size: 2.6rem;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -1px;
        margin: 0 0 22px;
    }
    .eng-highlight .eyebrow {
        display: inline-block;
        padding: 7px 16px;
        background: rgba(255,255,255,0.18);
        border: 1px solid rgba(255,255,255,0.3);
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin-bottom: 22px;
    }
    .eng-highlight p {
        font-size: 1.05rem;
        line-height: 1.8;
        opacity: 0.95;
        margin-bottom: 30px;
    }
    .eng-highlight-cta {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 14px 28px;
        background: #fff;
        color: #0a3d7c;
        font-weight: 700;
        font-size: 14px;
        border-radius: 999px;
        text-decoration: none;
        transition: all 0.25s;
    }
    .eng-highlight-cta:hover {
        transform: translateX(4px);
    }
    .eng-highlight-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .eng-stat {
        background: rgba(255,255,255,0.10);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.18);
        border-radius: 14px;
        padding: 28px 24px;
        text-align: center;
    }
    .eng-stat .num {
        font-size: 2.4rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 8px;
    }
    .eng-stat .label {
        font-size: 12px;
        font-weight: 600;
        opacity: 0.85;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    @media (max-width: 900px) {
        .eng-highlight-inner { grid-template-columns: 1fr; }
        .eng-highlight h2 { font-size: 2rem; }
    }

    /* News grid */
    .eng-news-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 28px;
    }
    .eng-news-card {
        background: #fff;
        border-radius: 14px;
        overflow: hidden;
        text-decoration: none;
        border: 1px solid #e8ecf1;
        transition: all 0.3s;
    }
    .eng-news-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.10);
    }
    .eng-news-thumb {
        position: relative;
        height: 200px;
        overflow: hidden;
    }
    .eng-news-thumb img {
        width: 100%; height: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }
    .eng-news-card:hover .eng-news-thumb img { transform: scale(1.06); }
    .eng-news-thumb .tag {
        position: absolute;
        top: 16px; left: 16px;
        padding: 5px 12px;
        background: rgba(10,61,124,0.92);
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1px;
        text-transform: uppercase;
        border-radius: 999px;
    }
    .eng-news-body {
        padding: 24px 26px 28px;
    }
    .eng-news-body .date {
        font-size: 12px;
        color: #888;
        margin-bottom: 8px;
    }
    .eng-news-body h3 {
        font-size: 17px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.45;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    @media (max-width: 900px) {
        .eng-news-grid { grid-template-columns: 1fr; }
    }

    /* Quick links */
    .eng-quick {
        background: #f5f6f8;
    }
    .eng-quick-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
    }
    .eng-quick-item {
        background: #fff;
        border-radius: 14px;
        padding: 40px 28px;
        text-align: center;
        text-decoration: none;
        border: 1px solid #e8ecf1;
        transition: all 0.3s;
    }
    .eng-quick-item:hover {
        transform: translateY(-4px);
        border-color: #0061c2;
        box-shadow: 0 16px 36px rgba(0,97,194,0.12);
    }
    .eng-quick-icon {
        width: 64px; height: 64px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #e8f0fb, #d4e4f7);
        border-radius: 16px;
        color: #0061c2;
    }
    .eng-quick-item h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 6px;
    }
    .eng-quick-item p {
        font-size: 13px;
        color: #888;
        margin: 0;
    }
    @media (max-width: 900px) {
        .eng-quick-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
@endpush

@section('content')
{{-- Main visual slider --}}
@php $slideCount = $page?->activeItems?->count() ?: 1; @endphp
<section class="eng-hero" x-data="{
    current: 0,
    total: {{ $slideCount }},
    autoplay: null,
    init() {
        this.start();
    },
    start() {
        this.autoplay = setInterval(() => this.next(), 6500);
    },
    stop() { clearInterval(this.autoplay); },
    go(i) { this.current = i; this.stop(); this.start(); },
    next() { this.current = (this.current + 1) % this.total; },
    prev() { this.current = (this.current - 1 + this.total) % this.total; }
}" @mouseenter="stop()" @mouseleave="start()">
    @php
        $slides = ($page?->activeItems && count($page->activeItems)) ? $page->activeItems : collect([
            (object)['image_path' => '/cmak/images/eng/eng1.jpg', 'tag' => 'CMAK · Since 1996', 'title' => "Leading Korea's Construction Management", 'description' => 'For nearly three decades, the Construction Management Association of Korea has been at the forefront of advancing CM practice.', 'link' => null],
        ]);
    @endphp

    @foreach($slides as $i => $slide)
        <div class="eng-hero-slide" :class="{ 'active': current === {{ $i }} }">
            <img src="{{ $slide->image_path }}" alt="{{ $slide->title }}">
        </div>
    @endforeach

    <div class="eng-hero-content">
        @foreach($slides as $i => $slide)
            <div x-show="current === {{ $i }}" x-transition.opacity.duration.500ms x-cloak>
                @if($slide->tag) <span class="eyebrow">{{ $slide->tag }}</span> @endif
                <h2>{{ $slide->title }}</h2>
                @if($slide->description) <p>{{ $slide->description }}</p> @endif
                <a href="{{ $slide->link ?: '/cmak/eng/about/greeting' }}" class="eng-hero-cta">
                    Learn More
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        @endforeach
    </div>

    <button class="eng-hero-arrow prev" @click="prev(); stop(); start();">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 18l-6-6 6-6"/></svg>
    </button>
    <button class="eng-hero-arrow next" @click="next(); stop(); start();">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 18l6-6-6-6"/></svg>
    </button>

    <div class="eng-hero-nav">
        @foreach($slides as $i => $slide)
            <span class="eng-hero-dot" :class="{ 'active': current === {{ $i }} }" @click="go({{ $i }})"></span>
        @endforeach
    </div>
</section>

{{-- About cards --}}
<section class="eng-section">
    <div class="eng-section-inner">
        <div class="eng-section-head">
            <span class="eyebrow">About CMAK</span>
            <h2>The Voice of CM in Korea</h2>
            <p>Founded in 1996, CMAK represents construction management firms and professionals committed to advancing the practice and elevating industry standards across Korea.</p>
        </div>

        <div class="eng-about-grid">
            <a href="/cmak/eng/about/greeting" class="eng-about-card">
                <div class="num">01</div>
                <h3>Chairman's Message</h3>
                <p>A welcome message from the chairman of the Construction Management Association of Korea.</p>
            </a>
            <a href="/cmak/eng/about/purpose" class="eng-about-card">
                <div class="num">02</div>
                <h3>Purpose & Vision</h3>
                <p>Our mission to promote construction management as a recognized profession and advance the industry.</p>
            </a>
            <a href="/cmak/eng/about/history" class="eng-about-card">
                <div class="num">03</div>
                <h3>History</h3>
                <p>Nearly three decades of milestones, growth and contribution to the Korean construction industry.</p>
            </a>
            <a href="/cmak/eng/about/organization" class="eng-about-card">
                <div class="num">04</div>
                <h3>Organization</h3>
                <p>Meet the leadership, board of directors, committees and staff that guide CMAK's work.</p>
            </a>
            <a href="/cmak/eng/about/scheme" class="eng-about-card">
                <div class="num">05</div>
                <h3>Scheme of Work</h3>
                <p>Our core programs in policy, research, education, certification and international cooperation.</p>
            </a>
            <a href="/cmak/eng/about/contact" class="eng-about-card">
                <div class="num">06</div>
                <h3>Contact Us</h3>
                <p>Get in touch with the CMAK secretariat in Seoul, Korea — we welcome inquiries from members and partners.</p>
            </a>
        </div>
    </div>
</section>

{{-- International CM Day highlight --}}
<section class="eng-highlight">
    <div class="eng-highlight-inner">
        <div>
            <span class="eyebrow">International CM Day</span>
            <h2>Celebrating Construction Management Worldwide</h2>
            <p>International CM Day brings together construction management professionals from around the globe to celebrate the value of CM and to share knowledge, achievements and best practices that shape the built environment.</p>
            <a href="/cmak/eng/cmday/introduction" class="eng-highlight-cta">
                Learn About CM Day
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </a>
        </div>
        <div class="eng-highlight-stats">
            <div class="eng-stat">
                <div class="num">28+</div>
                <div class="label">Years of CMAK</div>
            </div>
            <div class="eng-stat">
                <div class="num">300+</div>
                <div class="label">Member Firms</div>
            </div>
            <div class="eng-stat">
                <div class="num">20+</div>
                <div class="label">Partner Countries</div>
            </div>
            <div class="eng-stat">
                <div class="num">1996</div>
                <div class="label">Established</div>
            </div>
        </div>
    </div>
</section>

{{-- News --}}
<section class="eng-section">
    <div class="eng-section-inner">
        <div class="eng-section-head">
            <span class="eyebrow">CMAK News</span>
            <h2>What's Happening at CMAK</h2>
            <p>Stay up to date with our latest publications, educations and events from CMAK and the global CM community.</p>
        </div>

        <div class="eng-news-grid">
            <a href="/cmak/eng/news/publications" class="eng-news-card">
                <div class="eng-news-thumb">
                    <img src="/cmak/images/eng/eng2.jpg" alt="Publications">
                    <span class="tag">Publications</span>
                </div>
                <div class="eng-news-body">
                    <div class="date">Latest Issue</div>
                    <h3>CM Herald Magazine and CMAK Annual Reports</h3>
                </div>
            </a>
            <a href="/cmak/eng/news/seminars" class="eng-news-card">
                <div class="eng-news-thumb">
                    <img src="/cmak/images/eng/eng5.jpg" alt="Educations">
                    <span class="tag">Education</span>
                </div>
                <div class="eng-news-body">
                    <div class="date">Ongoing Programs</div>
                    <h3>Educations and Seminars for CM Professionals</h3>
                </div>
            </a>
            <a href="/cmak/eng/news/conferences" class="eng-news-card">
                <div class="eng-news-thumb">
                    <img src="/cmak/images/eng/eng4.jpg" alt="Conferences">
                    <span class="tag">Events</span>
                </div>
                <div class="eng-news-body">
                    <div class="date">Annual</div>
                    <h3>CMAK International Conferences and Forums</h3>
                </div>
            </a>
        </div>
    </div>
</section>

{{-- Quick links --}}
<section class="eng-section eng-quick">
    <div class="eng-section-inner">
        <div class="eng-section-head">
            <span class="eyebrow">Quick Links</span>
            <h2>Explore CMAK</h2>
        </div>

        <div class="eng-quick-grid">
            <a href="/cmak/eng/ipma/about" class="eng-quick-item">
                <div class="eng-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 010 20M12 2a15 15 0 000 20"/></svg>
                </div>
                <h3>IPMA Korea</h3>
                <p>International project management certification</p>
            </a>
            <a href="/cmak/eng/ipma/certification" class="eng-quick-item">
                <div class="eng-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M12 15l-2-2m4 0l-2 2m0 0v6"/><circle cx="12" cy="9" r="6"/></svg>
                </div>
                <h3>Certification</h3>
                <p>Become an internationally certified PM</p>
            </a>
            <a href="/cmak/eng/membership" class="eng-quick-item">
                <div class="eng-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>
                </div>
                <h3>Membership</h3>
                <p>Join the CMAK community</p>
            </a>
            <a href="/cmak/eng/about/contact" class="eng-quick-item">
                <div class="eng-quick-icon">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3>Contact Us</h3>
                <p>Visit or reach out to CMAK</p>
            </a>
        </div>
    </div>
</section>
@endsection
