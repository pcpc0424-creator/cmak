@php $page = eng_page('ipma/membership'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'IPMA Membership') . ' - CMAK')
@section('hero', true)
@section('category', 'IPMA Korea')
@section('category-link', '/cmak/eng/ipma/about')
@section('page-title', $page->title ?? 'Membership')
@section('side-menu')
    @include('eng.ipma._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'IPMA Korea Membership' }}</h2>
    <p class="desc">{{ $page->description ?? 'Join the IPMA Korea community of project management professionals.' }}</p>

    <p>IPMA Korea welcomes individual project management professionals and organizations to join our community. Membership offers access to certification, education, networking and resources from the global IPMA federation.</p>

    <h3>Membership Categories</h3>
    <table class="eng-table">
        <thead>
            <tr><th>Category</th><th>Eligibility</th><th>Annual Fee</th></tr>
        </thead>
        <tbody>
            <tr><td>Individual Member</td><td>Any project management professional</td><td>Contact secretariat</td></tr>
            <tr><td>Student Member</td><td>Full-time students at recognized institutions</td><td>Reduced fee</td></tr>
            <tr><td>Corporate Member</td><td>Organizations operating in Korea</td><td>Tiered by company size</td></tr>
            <tr><td>Academic Member</td><td>Universities and research institutes</td><td>Special rate</td></tr>
        </tbody>
    </table>

    <h3>Member Benefits</h3>
    <ul>
        <li>Discounted IPMA certification fees</li>
        <li>Discounted education and seminar fees</li>
        <li>Access to IPMA Korea publications and knowledge base</li>
        <li>Exclusive networking events and member meetups</li>
        <li>Member directory listing</li>
        <li>Eligibility to vote at the annual general meeting</li>
        <li>Access to IPMA global resources and the worldwide IPMA member community</li>
    </ul>

    <h3>How to Apply</h3>
    <p>To apply for IPMA Korea membership, please contact the IPMA Korea secretariat by email or phone. Our team will guide you through the application process and provide the application form, fee information and required supporting documents.</p>

    <div class="eng-info-box">
        <dt>Email</dt><dd>cmak@cmak.or.kr</dd>
        <dt>Telephone</dt><dd>+82-2-585-4712 ~ 3</dd>
    </div>
</div>
@endsection
