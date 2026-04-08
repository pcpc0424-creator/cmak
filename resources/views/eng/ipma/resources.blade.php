@php $page = eng_page('ipma/resources'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'IPMA Resources') . ' - CMAK')
@section('hero', true)
@section('category', 'IPMA Korea')
@section('category-link', '/cmak/eng/ipma/about')
@section('page-title', $page->title ?? 'Resources')
@section('side-menu')
    @include('eng.ipma._side')
@endsection

@push('styles')
<style>
.eng-res-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-top: 18px; }
.eng-res { display:flex; gap: 18px; padding: 22px 24px; background: #f8f9fb; border: 1px solid #e8ecf1; border-radius: 12px; text-decoration:none; color: inherit; transition: all 0.25s; }
.eng-res:hover { background:#fff; border-color: #0061c2; transform: translateY(-3px); box-shadow: 0 12px 24px rgba(10,61,124,0.10); }
.eng-res-icon { flex-shrink:0; width:48px; height:48px; display:flex; align-items:center; justify-content:center; background: linear-gradient(135deg, #e8f0fb, #d4e4f7); color:#0061c2; border-radius: 12px; }
.eng-res h4 { font-size: 15px; font-weight: 700; color: #1a1a1a; margin: 0 0 4px; }
.eng-res p { font-size: 13px; color: #666; line-height: 1.6; margin: 0; }
@media (max-width: 700px) { .eng-res-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Resources' }}</h2>
    <p class="desc">{{ $page->description ?? 'Tools, guides and references for the IPMA Korea community.' }}</p>

    <p>Explore the resources below to learn more about IPMA certification, project management competence and the global IPMA community. All resources are made available to support practitioners and IPMA Korea members.</p>

    <div class="eng-res-grid">
        <a href="#" class="eng-res">
            <div class="eng-res-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><path d="M14 2v6h6M16 13H8M16 17H8M10 9H8"/></svg>
            </div>
            <div>
                <h4>IPMA Individual Competence Baseline (ICB4)</h4>
                <p>The global standard for project management competence — the foundation of IPMA certification.</p>
            </div>
        </a>
        <a href="#" class="eng-res">
            <div class="eng-res-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/></svg>
            </div>
            <div>
                <h4>IPMA Korea Certification Handbook</h4>
                <p>Step-by-step guide to applying for and achieving IPMA Level A, B, C and D certification in Korea.</p>
            </div>
        </a>
        <a href="#" class="eng-res">
            <div class="eng-res-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M2 12h20M12 2a15 15 0 010 20M12 2a15 15 0 000 20"/></svg>
            </div>
            <div>
                <h4>IPMA Global Network</h4>
                <p>Connect with the worldwide IPMA federation, partner associations and member groups in 70+ countries.</p>
            </div>
        </a>
        <a href="#" class="eng-res">
            <div class="eng-res-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6L9 17l-5-5"/></svg>
            </div>
            <div>
                <h4>Sample Examination Papers</h4>
                <p>Sample questions and assessment materials for candidates preparing for IPMA certification examinations.</p>
            </div>
        </a>
        <a href="#" class="eng-res">
            <div class="eng-res-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><path d="M17 21v-8H7v8M7 3v5h8"/></svg>
            </div>
            <div>
                <h4>Application Forms</h4>
                <p>Downloadable application forms for IPMA certification, education programmes and IPMA Korea membership.</p>
            </div>
        </a>
        <a href="#" class="eng-res">
            <div class="eng-res-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 01-.9 3.8 8.5 8.5 0 01-7.6 4.7 8.38 8.38 0 01-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 01-.9-3.8 8.5 8.5 0 014.7-7.6 8.38 8.38 0 013.8-.9h.5a8.48 8.48 0 018 8v.5z"/></svg>
            </div>
            <div>
                <h4>Frequently Asked Questions</h4>
                <p>Answers to common questions about IPMA certification, recertification, education and membership.</p>
            </div>
        </a>
    </div>
</div>
@endsection
