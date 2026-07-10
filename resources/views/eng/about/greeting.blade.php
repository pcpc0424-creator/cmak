@php $page = eng_page('about/greeting'); @endphp
@extends('layouts.eng')

@section('title', "Chairman's Message - CMAK")
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', "Chairman's Message")
@section('side-menu')
    @include('eng.about._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>CM is not an option, it's a necessity</h2>
    <p class="desc">Welcome to the homepage of the Construction Management Association of Korea.</p>

    <div style="display:flex; gap:36px; flex-wrap:wrap;">
        <div style="flex-shrink:0; text-align:center;">
            <img src="/cmak/images/eng/eng2.jpg"
                 alt="Chairman of CMAK"
                 style="max-width:300px; border-radius:12px; box-shadow: 0 6px 24px rgba(0,0,0,0.12);">
        </div>
        <div style="flex:1; min-width:300px;">
            <p>In life, we strive to do our best at everything we undertake but many times, in our effort to achieve the results, we are careless in the process, namely the means and the methods and thereby bring about outcomes that are unrecoverable.</p>
            <p>Consequently, we at CMAK, with the support of our members and all those who visit this website, will play a leading role in expanding essential CM, to minimize the risks to secure the optimal outcome in all constructions projects undertaken by our members. We will do our utmost to assist our members to partake in active construction process by planning programs following accurate predictions of the future. We shall work tirelessly until the day CM is recognized as one of the 3 main areas of construction along with designing and building.</p>
            <p>We look forward to working with everyone in achieving those goals.</p>
            <p style="margin-top:24px; text-align:right; color:#1a1a1a;">
                The Construction Management Association of Korea<br>
                <span style="font-size:17px; font-weight:700; color:#0061c2;">Chairman&nbsp;&nbsp;Bae, Yung Hwi</span>
            </p>
        </div>
    </div>
</div>
@endsection
