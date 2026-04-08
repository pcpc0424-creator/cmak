@php $page = eng_page('ipma/education'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'IPMA Education') . ' - CMAK')
@section('hero', true)
@section('category', 'IPMA Korea')
@section('category-link', '/cmak/eng/ipma/about')
@section('page-title', $page->title ?? 'Education')
@section('side-menu')
    @include('eng.ipma._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'IPMA Korea Education' }}</h2>
    <p class="desc">{{ $page->description ?? 'Training programs to build project management competence.' }}</p>

    <p>IPMA Korea offers a structured set of education programmes designed to help candidates prepare for IPMA certification and to develop project management competence in real-world practice. Our programmes are aligned with the IPMA Individual Competence Baseline (ICB4).</p>

    <h3>Programme Catalogue</h3>
    <table class="eng-table">
        <thead>
            <tr><th>Programme</th><th>Target Audience</th><th>Duration</th></tr>
        </thead>
        <tbody>
            <tr><td>IPMA Level D Preparation</td><td>Entry-level PM team members</td><td>2 days (14 hours)</td></tr>
            <tr><td>IPMA Level C Preparation</td><td>Project managers</td><td>4 days (28 hours)</td></tr>
            <tr><td>IPMA Level B Preparation</td><td>Senior project managers</td><td>5 days (35 hours)</td></tr>
            <tr><td>Project Risk Management</td><td>All PM levels</td><td>2 days</td></tr>
            <tr><td>Stakeholder &amp; Leadership</td><td>All PM levels</td><td>2 days</td></tr>
            <tr><td>Agile Project Management</td><td>All PM levels</td><td>2 days</td></tr>
            <tr><td>Construction Project Management</td><td>CM professionals</td><td>3 days</td></tr>
        </tbody>
    </table>

    <h3>Delivery Modes</h3>
    <ul>
        <li><strong>Public Courses</strong> &mdash; scheduled programmes open to individual registration</li>
        <li><strong>In-house Training</strong> &mdash; customised programmes delivered at your organization</li>
        <li><strong>Online Learning</strong> &mdash; live virtual classroom and self-paced e-learning options</li>
        <li><strong>Blended Programmes</strong> &mdash; combinations of online and face-to-face learning</li>
    </ul>

    <h3>Instructors</h3>
    <p>All IPMA Korea instructors are accredited project management professionals with significant industry experience and IPMA certification. Many of our instructors are active CM practitioners, contributing real-world insights into the classroom.</p>
</div>
@endsection
