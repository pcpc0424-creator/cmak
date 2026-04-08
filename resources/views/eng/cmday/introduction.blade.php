@php $page = eng_page('cmday/introduction'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Introduction to International CM Day') . ' - CMAK')
@section('hero', true)
@section('category', 'International CM Day')
@section('category-link', '/cmak/eng/cmday/introduction')
@section('page-title', $page->title ?? 'Introduction')
@section('side-menu')
    @include('eng.cmday._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Introduction to International CM Day' }}</h2>
    <p class="desc">{{ $page->description ?? 'A global celebration of construction management.' }}</p>

    <p>International CM Day is a global celebration that recognizes and honours construction management professionals around the world. The day brings together CM associations, firms, academics and practitioners to share knowledge, celebrate achievements and shape the future of construction management.</p>

    <h3>Background</h3>
    <p>International CM Day was initiated by leading CM associations worldwide to promote the profession of construction management as an essential discipline for delivering successful built-environment projects. CMAK has actively participated as the Korean host association since the early years of the celebration.</p>

    <h3>Why International CM Day Matters</h3>
    <ul>
        <li>It raises public awareness of the value of construction management to society and industry.</li>
        <li>It strengthens the global community of CM professionals and associations.</li>
        <li>It promotes knowledge sharing across borders and disciplines.</li>
        <li>It celebrates the achievements of CM practitioners and firms worldwide.</li>
        <li>It inspires the next generation of CM professionals.</li>
    </ul>

    <h3>CMAK and International CM Day</h3>
    <p>As the official CM association of Korea, CMAK organizes a Korean celebration of International CM Day every year. The Korean event typically features keynote lectures, panel discussions, technical sessions, networking and recognition of outstanding CM achievements in Korea.</p>

    <div class="eng-info-box">
        <dt>When</dt><dd>Held annually — date announced each year</dd>
        <dt>Where</dt><dd>Major venues in Seoul, Korea</dd>
        <dt>Who can attend</dt><dd>CM professionals, CMAK members, partner organizations, students and the public</dd>
    </div>
</div>
@endsection
