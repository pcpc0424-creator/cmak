@php $page = eng_page('about/contact'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Contact Us') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'Contact Us')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.eng-contact-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; margin-top: 18px; }
.eng-map { width: 100%; height: 380px; border-radius: 12px; overflow: hidden; border: 1px solid #e8ecf1; background:#f0f4fa; display:flex; align-items:center; justify-content:center; color:#888; font-size:13px; }
.eng-map iframe { width: 100%; height: 100%; border: 0; }
@media (max-width: 800px) { .eng-contact-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Contact Us' }}</h2>
    <p class="desc">{{ $page->description ?? 'Get in touch with the CMAK secretariat in Seoul, Korea.' }}</p>

    <div class="eng-info-box">
        <dl>
            <dt>Address</dt>
            <dd>(06673) 4F, Union Bldg. 88, Seocho-daero, Seocho-gu, Seoul, Republic of Korea</dd>
            <dt>Telephone</dt>
            <dd>(+82)10-2858-8788</dd>
            <dt>Fax</dt>
            <dd>(+82)2-585-2689</dd>
            <dt>Email</dt>
            <dd>margaretwon@cmak.or.kr</dd>
            <dt>Homepage</dt>
            <dd>www.cmak.or.kr</dd>
            <dt>Office Hours</dt>
            <dd>Monday – Friday, 09:00 – 18:00 (KST)<br>Closed on weekends and Korean public holidays</dd>
        </dl>
    </div>

    <h3>How to Reach Us</h3>
    <div class="eng-contact-grid">
        <div>
            <p><strong>By Subway</strong><br>
            100m from Exit 4 of Naebang Station on Subway Line No. 7</p>
        </div>
        <div class="eng-map">
            <iframe src="https://www.google.com/maps?q=서울특별시+서초구+서초대로+88+유니온빌딩&output=embed&hl=en" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection
