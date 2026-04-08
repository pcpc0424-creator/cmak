@php $page = eng_page('ipma/certification'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'IPMA Certification') . ' - CMAK')
@section('hero', true)
@section('category', 'IPMA Korea')
@section('category-link', '/cmak/eng/ipma/about')
@section('page-title', $page->title ?? 'Certification')
@section('side-menu')
    @include('eng.ipma._side')
@endsection

@push('styles')
<style>
.eng-cert-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; margin-top: 18px; }
.eng-cert { background: #fff; border: 1px solid #e8ecf1; border-radius: 14px; padding: 28px 30px; transition: all 0.25s; }
.eng-cert:hover { border-color: #0061c2; transform: translateY(-3px); box-shadow: 0 14px 28px rgba(10,61,124,0.10); }
.eng-cert-level { display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; background: linear-gradient(135deg, #0a3d7c, #0061c2); color:#fff; border-radius: 999px; font-size: 11px; font-weight: 800; letter-spacing: 1.5px; margin-bottom: 14px; }
.eng-cert h4 { font-size: 18px; font-weight: 800; color: #1a1a1a; margin: 0 0 8px; }
.eng-cert .sub { font-size: 13px; color: #888; margin-bottom: 14px; }
.eng-cert p { font-size: 14px; color: #555; line-height: 1.7; margin: 0; }
@media (max-width: 700px) { .eng-cert-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'IPMA Certification' }}</h2>
    <p class="desc">{{ $page->description ?? 'Globally recognized, competence-based project management certification.' }}</p>

    <p>IPMA offers a four-level certification system that recognizes project management competence at different career stages. IPMA Korea, operated under CMAK, manages the application, assessment and certification process for candidates in the Republic of Korea.</p>

    <h3>The Four-Level Certification System</h3>
    <div class="eng-cert-grid">
        <div class="eng-cert">
            <span class="eng-cert-level">LEVEL D</span>
            <h4>Certified Project Management Associate</h4>
            <div class="sub">For entry-level project team members</div>
            <p>Demonstrates broad knowledge of project management. No specific experience required. Assessed by written examination.</p>
        </div>
        <div class="eng-cert">
            <span class="eng-cert-level">LEVEL C</span>
            <h4>Certified Project Manager</h4>
            <div class="sub">For project managers of moderate-complexity projects</div>
            <p>Requires at least 3 years of PM experience. Assessed by written examination, project report and interview.</p>
        </div>
        <div class="eng-cert">
            <span class="eng-cert-level">LEVEL B</span>
            <h4>Certified Senior Project Manager</h4>
            <div class="sub">For senior PMs of complex projects</div>
            <p>Requires at least 5 years of senior PM experience. Assessed by written examination, executive summary, project report and interview.</p>
        </div>
        <div class="eng-cert">
            <span class="eng-cert-level">LEVEL A</span>
            <h4>Certified Projects Director</h4>
            <div class="sub">For directors of project portfolios or programmes</div>
            <p>Requires at least 5 years of programme/portfolio management experience. Assessed by extensive evaluation including portfolio report and panel interview.</p>
        </div>
    </div>

    <h3>Application Process</h3>
    <ol>
        <li>Submit application form and supporting documents to IPMA Korea</li>
        <li>Application review and eligibility confirmation</li>
        <li>Written examination</li>
        <li>(Levels A–C) Submit project / portfolio report</li>
        <li>(Levels A–C) Assessor interview</li>
        <li>Certification decision and award</li>
    </ol>

    <h3>Validity &amp; Recertification</h3>
    <p>IPMA certifications are valid for 5 years. Recertification requires evidence of continued PM practice and professional development during the certification period.</p>
</div>
@endsection
