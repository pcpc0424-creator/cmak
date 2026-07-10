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
    <p class="desc">The establishment of CMAK is based on Article 32 of the Civil Law (Non-profit Organization).</p>

    <ul>
        <li>To maintain dignity of CMAK members and protect their rights and interests</li>
        <li>To theorize CM and engage in expanding and distributing it</li>
        <li>To contribute to construction industry and domestic economy by CM</li>
    </ul>

    <h3>Projects &amp; Activities</h3>
    <ul>
        <li>Examine and research to make the CM body of knowledge</li>
        <li>Promote co-operation between industry and academy to devise the plan utilizing CM</li>
        <li>Examine, research and propose to improve the related laws and regulations</li>
        <li>Help develop and manage the workforce and technology related to CM</li>
        <li>Collect and distribute all kinds of data and information, and help establish the database of them</li>
        <li>Conduct the works entrusted from the government or other organizations</li>
        <li>Conduct the other works required for improving CM</li>
    </ul>
</div>
@endsection
