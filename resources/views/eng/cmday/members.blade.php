@php $page = eng_page('cmday/members'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Participating Members') . ' - CMAK')
@section('hero', true)
@section('category', 'International CM Day')
@section('category-link', '/cmak/eng/cmday/introduction')
@section('page-title', $page->title ?? 'Participating Members')
@section('side-menu')
    @include('eng.cmday._side')
@endsection

@push('styles')
<style>
.eng-assoc-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin-top: 20px; }
.eng-assoc-card { background: #f8f9fb; border: 1px solid #e8ecf1; border-radius: 14px; padding: 24px 26px; }
.eng-assoc-card h4 { font-size: 17px; font-weight: 800; color: #0061c2; margin: 0 0 4px; }
.eng-assoc-card .full { font-size: 13px; color: #888; margin: 0 0 14px; }
.eng-assoc-card dl { display: grid; grid-template-columns: 92px 1fr; row-gap: 6px; margin: 0; font-size: 13.5px; }
.eng-assoc-card dt { color: #999; font-weight: 600; }
.eng-assoc-card dd { margin: 0; color: #444; word-break: break-all; }
@media (max-width: 700px) { .eng-assoc-grid { grid-template-columns: 1fr; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Participating Members' }}</h2>
    <p class="desc">{{ $page->description ?? 'Participating members of the International CM Day.' }}</p>

    <div class="eng-assoc-grid">
        <div class="eng-assoc-card">
            <h4>CIOB</h4>
            <p class="full">The Chartered Institute of Building</p>
            <dl>
                <dt>Establishment</dt><dd>1834</dd>
                <dt>Location</dt><dd>Berkshire, UK</dd>
                <dt>Tel</dt><dd>44 (0) 1344 630700</dd>
                <dt>E-mail</dt><dd>reception@ciob.org.uk</dd>
                <dt>Website</dt><dd><a href="http://www.ciob.org.uk" target="_blank">www.ciob.org.uk</a></dd>
            </dl>
        </div>
        <div class="eng-assoc-card">
            <h4>CMAA</h4>
            <p class="full">Construction Management Association of America</p>
            <dl>
                <dt>Establishment</dt><dd>1982</dd>
                <dt>Location</dt><dd>Virginia, USA</dd>
                <dt>Tel</dt><dd>703 356 2622</dd>
                <dt>E-mail</dt><dd>info@cmaanet.org</dd>
                <dt>Website</dt><dd><a href="http://www.cmaanet.org" target="_blank">www.cmaanet.org</a></dd>
            </dl>
        </div>
        <div class="eng-assoc-card">
            <h4>CMAJ</h4>
            <p class="full">Construction Management Association of Japan</p>
            <dl>
                <dt>Establishment</dt><dd>2001</dd>
                <dt>Location</dt><dd>Tokyo, Japan</dd>
                <dt>Tel</dt><dd>81 3 5730 7791</dd>
                <dt>E-mail</dt><dd>hq@cmaj.org</dd>
                <dt>Website</dt><dd><a href="http://www.cmaj.org" target="_blank">www.cmaj.org</a></dd>
            </dl>
        </div>
        <div class="eng-assoc-card">
            <h4>CMAK</h4>
            <p class="full">Construction Management Association of Korea</p>
            <dl>
                <dt>Establishment</dt><dd>1997</dd>
                <dt>Location</dt><dd>Seoul, Korea</dd>
                <dt>Tel</dt><dd>82 70 7510 1226</dd>
                <dt>E-mail</dt><dd>margaretwon@cmak.or.kr</dd>
                <dt>Website</dt><dd><a href="http://www.cmak.or.kr" target="_blank">www.cmak.or.kr</a></dd>
            </dl>
        </div>
        <div class="eng-assoc-card">
            <h4>IPMA</h4>
            <p class="full">International Project Management Association</p>
            <dl>
                <dt>Establishment</dt><dd>1965</dd>
                <dt>Location</dt><dd>Nijkerk, Netherlands</dd>
                <dt>Tel</dt><dd>31 33 247 3430</dd>
                <dt>E-mail</dt><dd>info@ipma.ch</dd>
                <dt>Website</dt><dd><a href="http://www.ipma.ch" target="_blank">www.ipma.ch</a></dd>
            </dl>
        </div>
        <div class="eng-assoc-card">
            <h4>CMAS</h4>
            <p class="full">Construction Management Association of Spain</p>
            <dl>
                <dt>Establishment</dt><dd>2010</dd>
                <dt>Location</dt><dd>Madrid, Spain</dd>
                <dt>Tel</dt><dd>34 91 189 0516</dd>
                <dt>E-mail</dt><dd>secretaria@cmasnet.org</dd>
                <dt>Website</dt><dd><a href="http://www.cmasnet.org" target="_blank">www.cmasnet.org</a></dd>
            </dl>
        </div>
    </div>
</div>
@endsection
