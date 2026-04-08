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
            <dd>7F, Platinum Tower, 398 Seocho-daero, Seocho-gu, Seoul 06619, Republic of Korea</dd>
            <dt>Telephone</dt>
            <dd>+82-2-585-4712 ~ 3</dd>
            <dt>Fax</dt>
            <dd>+82-2-585-4714</dd>
            <dt>Email</dt>
            <dd>cmak@cmak.or.kr</dd>
            <dt>Office Hours</dt>
            <dd>Monday – Friday, 09:00 – 18:00 (KST)<br>Closed on weekends and Korean public holidays</dd>
        </dl>
    </div>

    <h3>How to Reach Us</h3>
    <div class="eng-contact-grid">
        <div>
            <p><strong>By Subway</strong><br>
            Gangnam Station (Line 2 / Shinbundang Line), Exit 7. Approximately 5 minutes' walk along Seocho-daero toward Gyodae Station.</p>
            <p><strong>By Bus</strong><br>
            Numerous city bus routes serve the Gangnam area. Get off at the "Gangnam Station" bus stop and walk approximately 5 minutes.</p>
            <p><strong>From Incheon International Airport</strong><br>
            Take the Airport Limousine Bus 6020 / 6009 (approximately 80 minutes), or use the AREX express train + subway transfer at Seoul Station.</p>
        </div>
        <div class="eng-map">
            <iframe src="https://maps.google.com/maps?q=398+Seocho-daero,+Seocho-gu,+Seoul,+South+Korea&hl=en&gl=us&z=17&output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
    </div>
</div>
@endsection
