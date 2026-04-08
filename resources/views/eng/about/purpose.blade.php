@php $page = eng_page('about/purpose'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Purpose of Establishment') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'Purpose of Establishment')
@section('side-menu')
    @include('eng.about._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Purpose of Establishment' }}</h2>
    <p class="desc">{{ $page->description ?? 'Our mission, vision and the founding purpose of CMAK.' }}</p>

    <h3>Founding Purpose</h3>
    <p>The Construction Management Association of Korea (CMAK) was founded in 1996 with the purpose of promoting the sound development of construction management (CM) in Korea, advancing CM as a recognized profession, and contributing to the modernization and competitiveness of the Korean construction industry. CMAK is the official association representing CM firms and professionals in Korea.</p>

    <h3>Our Mission</h3>
    <p>CMAK exists to advance construction management as an integrated, value-creating discipline; to set and uphold professional standards; to develop talent; to promote innovation; and to represent the interests of the CM industry to the public, government and the international community.</p>

    <h3>Our Vision</h3>
    <ul>
        <li>To be the leading authority on construction management in Korea</li>
        <li>To be a trusted partner for the public and private construction sectors</li>
        <li>To connect Korean CM professionals to the global CM community</li>
        <li>To promote sustainable, innovative, and responsible construction practice</li>
    </ul>

    <h3>Core Activities</h3>
    <table class="eng-table">
        <thead>
            <tr><th style="width:30%;">Area</th><th>Activities</th></tr>
        </thead>
        <tbody>
            <tr><td><strong>Policy & Research</strong></td><td>Policy research, government engagement, CM standards and guidelines</td></tr>
            <tr><td><strong>Capability Evaluation</strong></td><td>Annual CM capability evaluation and public disclosure of CM firms</td></tr>
            <tr><td><strong>Certification</strong></td><td>Construction Manager qualification examination and IPMA certification</td></tr>
            <tr><td><strong>Education</strong></td><td>Professional development courses, seminars and workshops</td></tr>
            <tr><td><strong>Publications</strong></td><td>CM Herald, research reports, technical papers, member directory</td></tr>
            <tr><td><strong>International</strong></td><td>International CM Day, IPMA Korea, partnerships with global CM bodies</td></tr>
        </tbody>
    </table>
</div>
@endsection
