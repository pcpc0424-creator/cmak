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
.eng-scheme-list { columns: 2; column-gap: 40px; margin-top: 18px; }
.eng-scheme-list li { break-inside: avoid; margin-bottom: 11px; font-size: 14.5px; color: #444; line-height: 1.7; padding-left: 4px; }
@media (max-width: 700px) { .eng-scheme-list { columns: 1; } }
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Scheme of Work' }}</h2>
    <p class="desc">{{ $page->description ?? 'The scope of work carried out by the Construction Management Association of Korea.' }}</p>

    <ul class="eng-scheme-list">
        <li>Devise the middle·long-term schemes in order to develop CM</li>
        <li>Put the related laws and regulations in order as well as improving them</li>
        <li>Devise the improvement in CM delivery system</li>
        <li>Devise the fruitful education·training and evaluation system</li>
        <li>Help analyze and utilize the case studies of CM projects</li>
        <li>Develop the managing system of professionals</li>
        <li>Promote the related events in order to initiate techniques</li>
        <li>Operate the promoting group of CM</li>
        <li>Conduct the research and development work</li>
        <li>Develop the related laws and regulations in order to increase the CM work scope, etc.</li>
        <li>Research and study the foreign laws, regulations and policies</li>
        <li>Help export CM to LDDC (least developed among developing countries)</li>
        <li>Hold the seminars and educations for the purpose of promoting CM all over the country</li>
        <li>Hold the meeting of practitioners in order to monitor CM projects</li>
        <li>Train the professionals up</li>
        <li>Have the strategy meeting in order to promote CM</li>
        <li>Help increase the use of CM</li>
        <li>Build the database consisting of a variety of information</li>
        <li>Build the system in order to provide information and data</li>
        <li>Co-host the international conferences</li>
        <li>Reinforce PR activities in order for more use of CM</li>
        <li>Operate a CM-related consulting center at all times</li>
        <li>Publish the CM brochure</li>
        <li>Publish the CM handbook</li>
        <li>Supply the related information and data</li>
        <li>Appraise and make public the capacity of CM firms</li>
        <li>Maintain and manage the results of CM practices in public projects</li>
        <li>Confirm and publish the official documents of the CM services execution</li>
        <li>Help reinforce the activities of the five regional chapters</li>
        <li>Plan and arrange a variety of conferences and events</li>
        <li>Put in order the related regulations to promote the activities of CMAK</li>
    </ul>
</div>
@endsection
