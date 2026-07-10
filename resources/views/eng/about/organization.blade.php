@php $page = eng_page('about/organization'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Organization') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'Organization')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.eng-org-chart { display: flex; flex-direction: column; align-items: center; padding: 30px 0 10px; }
.eng-org-box { background: linear-gradient(135deg, #0a3d7c, #0061c2); color: #fff; padding: 16px 32px; border-radius: 10px; font-weight: 700; font-size: 16px; box-shadow: 0 8px 20px rgba(10,61,124,0.18); min-width: 200px; text-align:center; }
.eng-org-box.sub { background: #fff; color:#0a3d7c; border: 2px solid #0061c2; min-width: 180px; padding: 13px 22px; font-size: 14px; }
.eng-org-line { width: 2px; height: 28px; background: #0061c2; }
.eng-org-row { display: flex; flex-wrap: wrap; gap: 18px; justify-content: center; }
.eng-org-bracket { width: 80%; max-width: 720px; height: 2px; background: #0061c2; margin: 0 auto; }
.eng-dept-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-top: 24px; }
.eng-dept { background: #f8f9fb; border: 1px solid #e8ecf1; border-radius: 12px; padding: 24px 26px; }
.eng-dept h4 { font-size: 16px; font-weight: 700; color: #0061c2; margin: 0 0 8px; }
.eng-dept p { font-size: 14px; color: #555; line-height: 1.7; margin: 0; }
@media (max-width: 700px) { .eng-dept-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Organization' }}</h2>
    <p class="desc">{{ $page->description ?? 'The organizational structure of the Construction Management Association of Korea.' }}</p>

    <div class="eng-org-chart">
        <div class="eng-org-box">General Assembly</div>
        <div class="eng-org-line"></div>
        <div class="eng-org-row" style="align-items:center;">
            <div class="eng-org-box sub">Board of Directors</div>
            <div class="eng-org-box">Chairman</div>
            <div class="eng-org-box sub">Auditor</div>
            <div class="eng-org-box sub">Advisory Committee</div>
        </div>
        <div class="eng-org-line"></div>
        <div class="eng-org-box">Standing Director</div>
        <div class="eng-org-line"></div>
        <div class="eng-org-bracket"></div>
        <div style="height:18px;"></div>
        <div class="eng-org-row">
            <div class="eng-org-box sub">Operation Support Division</div>
            <div class="eng-org-box sub">Policy &amp; Projects Division</div>
            <div class="eng-org-box sub">Education &amp; Training Division</div>
            <div class="eng-org-box sub">Business Support Division</div>
            <div class="eng-org-box sub">Construction Industry Research Center</div>
        </div>
    </div>

    <h3>Committees</h3>
    <div class="eng-dept-grid">
        <div class="eng-dept"><h4>Operation &amp; PR Committee</h4></div>
        <div class="eng-dept"><h4>Education &amp; Training Committee</h4></div>
        <div class="eng-dept"><h4>Survey &amp; Research Committee</h4></div>
        <div class="eng-dept"><h4>Contract, Claim &amp; Risk Management Committee</h4></div>
        <div class="eng-dept"><h4>Construction VE &amp; LCC Committee</h4></div>
        <div class="eng-dept"><h4>Construction Informatization Committee</h4></div>
        <div class="eng-dept"><h4>Overseas Expansion Committee</h4></div>
        <div class="eng-dept"><h4>CM Future Strategy Special Committee</h4></div>
    </div>

    <h3>National Chapters</h3>
    <div class="eng-org-row" style="justify-content:flex-start;">
        <div class="eng-org-box sub">Seoul</div>
        <div class="eng-org-box sub">Jungbu (Central)</div>
        <div class="eng-org-box sub">Chungcheong</div>
        <div class="eng-org-box sub">Honam</div>
        <div class="eng-org-box sub">Yeongnam 1</div>
        <div class="eng-org-box sub">Yeongnam 2</div>
    </div>
</div>
@endsection
