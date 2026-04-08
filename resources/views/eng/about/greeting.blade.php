@php $page = eng_page('about/greeting'); @endphp
@extends('layouts.eng')

@section('title', "Chairman's Message - CMAK")
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', "Chairman's Message")
@section('side-menu')
    @include('eng.about._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Chairman\'s Message' }}</h2>
    <p class="desc">{{ $page->description ?? 'A welcome message from the Chairman of the Construction Management Association of Korea.' }}</p>

    <div style="display:flex; gap:36px; flex-wrap:wrap;">
        <div style="flex:1; min-width:300px;">
            <p><strong>Welcome to the Construction Management Association of Korea.</strong></p>
            <p>It is my great pleasure to welcome you to the official website of the Construction Management Association of Korea (CMAK). On behalf of our members and staff, thank you for your interest in our association and in the construction management profession in Korea.</p>
            <p>Since its establishment in 1996, CMAK has continuously worked to advance the discipline of construction management, raise professional standards, and contribute to the sound development of the Korean construction industry. As construction projects grow ever more complex and global in scope, the role of construction management has become increasingly indispensable.</p>
            <p>Through our wide-ranging activities — including CM capability evaluation and disclosure, the Construction Manager qualification exam, professional education, policy research, publications, and international cooperation — CMAK strives to strengthen the competitiveness of CM firms, protect the rights and interests of our members, and serve the public interest.</p>
            <p>We are also committed to embracing innovation and digital transformation, including BIM, smart construction, and sustainable practices, so that the construction industry can meet the challenges of the future.</p>
            <p>I sincerely invite you to explore our website to learn more about CMAK and our work. CMAK will continue to grow together with our members and partners, and we look forward to walking with you on this journey.</p>
            <p style="margin-top:24px; font-weight:700; color:#1a1a1a;">Thank you.</p>
            <p style="margin-top:18px; text-align:right; font-size:16px; font-weight:700; color:#0061c2;">
                Chairman, Construction Management Association of Korea
            </p>
        </div>
        <div style="flex-shrink:0; text-align:center;">
            <img src="/cmak/images/eng/eng2.jpg"
                 alt="Chairman's Message"
                 style="max-width:300px; border-radius:12px; box-shadow: 0 6px 24px rgba(0,0,0,0.12);">
        </div>
    </div>
</div>
@endsection
