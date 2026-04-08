@php $page = eng_page('ipma/about'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'About IPMA Korea') . ' - CMAK')
@section('hero', true)
@section('category', 'IPMA Korea')
@section('category-link', '/cmak/eng/ipma/about')
@section('page-title', $page->title ?? 'About IPMA Korea')
@section('side-menu')
    @include('eng.ipma._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'About IPMA Korea' }}</h2>
    <p class="desc">{{ $page->description ?? 'The Korean chapter of the International Project Management Association.' }}</p>

    <p>IPMA Korea is the official Korean chapter of the International Project Management Association (IPMA), one of the world's leading project management certification bodies. IPMA Korea is operated under the Construction Management Association of Korea (CMAK) to bring world-class project management certification, education and community to professionals in Korea.</p>

    <h3>About IPMA</h3>
    <p>The International Project Management Association (IPMA), headquartered in Switzerland, is a federation of more than 70 national project management associations worldwide. IPMA is widely recognized for its competence-based, four-level certification system used by hundreds of thousands of project managers across the globe.</p>

    <h3>Our Mission</h3>
    <ul>
        <li>To deliver world-class IPMA certification in Korea</li>
        <li>To develop project management competence across Korean industry</li>
        <li>To connect Korean PM professionals to the global IPMA community</li>
        <li>To support research, knowledge sharing and best practice in project management</li>
    </ul>

    <h3>Why IPMA Certification</h3>
    <table class="eng-table">
        <thead>
            <tr><th>Benefit</th><th>Description</th></tr>
        </thead>
        <tbody>
            <tr><td>Internationally Recognized</td><td>Accepted by employers and clients in over 70 countries.</td></tr>
            <tr><td>Competence-Based</td><td>Assesses real PM competence — knowledge, experience and behaviour — not just exam scores.</td></tr>
            <tr><td>Four-Level Path</td><td>Clear progression from Certified Project Management Associate to Certified Projects Director.</td></tr>
            <tr><td>Industry Neutral</td><td>Applicable to construction, IT, engineering, manufacturing and beyond.</td></tr>
        </tbody>
    </table>
</div>
@endsection
