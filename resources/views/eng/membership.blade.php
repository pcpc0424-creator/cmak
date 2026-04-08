@php $page = eng_page('membership'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Membership') . ' - CMAK')
@section('hero', true)
@section('category', 'Membership')
@section('category-link', '/cmak/eng/membership')
@section('page-title', $page->title ?? 'Membership')

@section('side-menu')
<a href="/cmak/eng/membership" class="active">Membership</a>
<a href="/cmak/eng/about/contact">Contact Us</a>
@endsection

@push('styles')
<style>
.eng-mem-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-top: 20px; }
.eng-mem-card { background: #fff; border: 2px solid #e8ecf1; border-radius: 16px; padding: 32px 28px; transition: all 0.25s; text-align: center; }
.eng-mem-card:hover { border-color: #0061c2; transform: translateY(-4px); box-shadow: 0 16px 32px rgba(10,61,124,0.10); }
.eng-mem-card.featured { border-color: #0061c2; background: linear-gradient(135deg, #0a3d7c, #0061c2); color: #fff; }
.eng-mem-card.featured h4, .eng-mem-card.featured p, .eng-mem-card.featured ul { color: #fff; }
.eng-mem-card.featured ul li::before { background: #fff; }
.eng-mem-card.featured .eng-mem-tag { background: #fff; color: #0061c2; }
.eng-mem-tag { display:inline-block; padding: 5px 14px; background: #0061c2; color:#fff; font-size: 11px; font-weight: 700; letter-spacing: 1px; border-radius: 999px; margin-bottom: 14px; }
.eng-mem-card h4 { font-size: 22px; font-weight: 800; color: #1a1a1a; margin: 0 0 6px; }
.eng-mem-card .desc { font-size: 13px; color: #888; margin-bottom: 22px; }
.eng-mem-card.featured .desc { color: rgba(255,255,255,0.85); }
.eng-mem-card ul { list-style: none; padding: 0; margin: 0; text-align: left; font-size: 14px; line-height: 1.7; color: #555; }
.eng-mem-card ul li { padding-left: 22px; position: relative; margin-bottom: 8px; }
.eng-mem-card ul li::before { content:''; position:absolute; left: 4px; top: 9px; width: 8px; height: 4px; border-left: 2px solid #0061c2; border-bottom: 2px solid #0061c2; transform: rotate(-45deg); }
@media (max-width: 900px) { .eng-mem-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'CMAK Membership' }}</h2>
    <p class="desc">{{ $page->description ?? 'Join the premier association for construction management professionals in Korea.' }}</p>

    <p>The Construction Management Association of Korea (CMAK) welcomes construction management firms, professionals, academic institutions and industry partners to join our growing community. Membership in CMAK connects you to the leading voice for CM in Korea and unlocks a wide range of services and benefits.</p>

    <h3>Why Join CMAK</h3>
    <ul>
        <li>Be part of the official voice of construction management in Korea</li>
        <li>Influence policy, regulation and best practice in the CM industry</li>
        <li>Access to professional development, certification and education programmes</li>
        <li>Inclusion in the CMAK member directory and CM capability disclosure</li>
        <li>Networking with peers across the Korean and global CM community</li>
        <li>Discounts on CMAK conferences, seminars and publications</li>
    </ul>

    <h3>Membership Categories</h3>
    <div class="eng-mem-grid">
        <div class="eng-mem-card">
            <span class="eng-mem-tag">REGULAR</span>
            <h4>Member Firm</h4>
            <p class="desc">For CM firms operating in Korea</p>
            <ul>
                <li>Listing in member directory</li>
                <li>Eligible for CM capability disclosure</li>
                <li>Voting rights at general meeting</li>
                <li>Discounted programme fees</li>
                <li>Member-only resources</li>
            </ul>
        </div>
        <div class="eng-mem-card featured">
            <span class="eng-mem-tag">PREMIUM</span>
            <h4>Corporate Sponsor</h4>
            <p class="desc">For CM firms and partners seeking elevated visibility</p>
            <ul>
                <li>All Member Firm benefits</li>
                <li>Premium directory listing</li>
                <li>Sponsor recognition at events</li>
                <li>Speaking opportunities</li>
                <li>Customized partnership benefits</li>
            </ul>
        </div>
        <div class="eng-mem-card">
            <span class="eng-mem-tag">ASSOCIATE</span>
            <h4>Individual / Academic</h4>
            <p class="desc">For individual professionals and academic institutions</p>
            <ul>
                <li>Newsletter and CM Herald</li>
                <li>Discounted education fees</li>
                <li>Access to research network</li>
                <li>Networking opportunities</li>
                <li>Member-only events</li>
            </ul>
        </div>
    </div>

    <h3>How to Apply</h3>
    <ol>
        <li>Contact the CMAK secretariat to request the membership application form</li>
        <li>Complete the application form and submit with supporting documents</li>
        <li>Application review by the CMAK secretariat (typically 1–2 weeks)</li>
        <li>Approval by the Board of Directors</li>
        <li>Pay annual membership dues and receive welcome package</li>
    </ol>

    <div class="eng-info-box">
        <dt>Email</dt><dd>cmak@cmak.or.kr</dd>
        <dt>Telephone</dt><dd>+82-2-585-4712 ~ 3</dd>
        <dt>Address</dt><dd>7F, Platinum Tower, 398 Seocho-daero, Seocho-gu, Seoul 06619, Republic of Korea</dd>
    </div>
</div>
@endsection
