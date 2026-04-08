@php $page = eng_page('about/scheme'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Scheme of Work') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'Scheme of Work')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.eng-scheme-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 22px; margin-top: 18px; }
.eng-scheme-card { background: #f8f9fb; border: 1px solid #e8ecf1; border-radius: 14px; padding: 28px 30px; transition: all 0.25s; }
.eng-scheme-card:hover { background: #fff; border-color: #0061c2; box-shadow: 0 14px 28px rgba(10,61,124,0.10); transform: translateY(-3px); }
.eng-scheme-num { display:inline-block; padding: 5px 12px; background: #0061c2; color:#fff; font-size:11px; font-weight:700; letter-spacing:1px; border-radius:999px; margin-bottom:14px; }
.eng-scheme-card h4 { font-size: 18px; font-weight: 800; color: #1a1a1a; margin: 0 0 10px; }
.eng-scheme-card p { font-size: 14.5px; color: #555; line-height: 1.75; margin: 0; }
@media (max-width: 700px) { .eng-scheme-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Scheme of Work' }}</h2>
    <p class="desc">{{ $page->description ?? 'CMAK\'s core programs and how we serve the construction management profession.' }}</p>

    <p>CMAK's scheme of work covers six major program areas, each designed to advance construction management practice in Korea and to serve our members, the industry and the public.</p>

    <div class="eng-scheme-grid">
        <div class="eng-scheme-card">
            <span class="eng-scheme-num">01 POLICY</span>
            <h4>Policy &amp; Advocacy</h4>
            <p>Policy research and government engagement to promote sound CM-friendly policies, public procurement reform and industry best practices.</p>
        </div>
        <div class="eng-scheme-card">
            <span class="eng-scheme-num">02 EVALUATION</span>
            <h4>CM Capability Evaluation</h4>
            <p>Annual evaluation and public disclosure of construction management firms' capabilities, conducted in cooperation with the Korean government.</p>
        </div>
        <div class="eng-scheme-card">
            <span class="eng-scheme-num">03 CERTIFICATION</span>
            <h4>Qualification &amp; Certification</h4>
            <p>Construction Manager (CM) qualification examination and IPMA international project management certification through IPMA Korea.</p>
        </div>
        <div class="eng-scheme-card">
            <span class="eng-scheme-num">04 EDUCATION</span>
            <h4>Professional Education</h4>
            <p>Continuing education courses, technical seminars and workshops covering CM, BIM, smart construction and emerging topics for CM professionals.</p>
        </div>
        <div class="eng-scheme-card">
            <span class="eng-scheme-num">05 PUBLICATION</span>
            <h4>Publications &amp; Knowledge</h4>
            <p>CM Herald magazine, research reports, technical guidelines, member directory and best-practice case studies for the CM community.</p>
        </div>
        <div class="eng-scheme-card">
            <span class="eng-scheme-num">06 INTERNATIONAL</span>
            <h4>International Cooperation</h4>
            <p>International CM Day, IPMA Korea activities and partnerships with global CM associations to bring world-class knowledge into Korea and showcase Korean CM abroad.</p>
        </div>
    </div>
</div>
@endsection
