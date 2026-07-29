@php $page = eng_page('about/history'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'History') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'History')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.eng-timeline { position: relative; padding-left: 30px; margin-top: 16px; }
.eng-timeline::before { content:''; position:absolute; left:8px; top:8px; bottom:0; width:2px; background: linear-gradient(to bottom, #0061c2, #e8ecf1); }
.eng-timeline-item { position: relative; margin-bottom: 32px; padding-left: 24px; }
.eng-timeline-item::before { content:''; position:absolute; left:-26px; top:6px; width:14px; height:14px; border-radius:50%; background:#0061c2; border:3px solid #fff; box-shadow: 0 0 0 2px #0061c2; }
.eng-timeline-year { font-size: 18px; font-weight: 800; color: #0a3d7c; margin-bottom: 6px; }
.eng-timeline-text { font-size: 14.5px; color: #444; line-height: 1.7; }
.eng-timeline-text ul { margin: 4px 0 0; padding-left: 18px; }
.eng-timeline-text li { margin-bottom: 4px; }
</style>
@endpush

@php
    $timeline = [
        ['year' => '2019', 'events' => [
            'July 23 : MOU with the Ministry of Housing and Public Works (MOHPW), Bangladesh',
            'April 11 : MOU with the Yanbian Korean Autonomous Prefecture Construction Industry Association (YCIA)',
            'February 20 : MOU with the Korea Real Estate Developers Association',
        ]],
        ['year' => '2018', 'events' => [
            'December 21 : MOU with the Construction Management Association of Japan (CMAJ)',
            'September 29 : MOU with the International Construction Project Management Association (ICMPA)',
            'June 5 : Renewal of MOU with the Chartered Institute of Building (CIOB), UK',
            'February 2 : MOU with the Korea Housing & Urban Guarantee Corporation (HUG)',
        ]],
        ['year' => '2017', 'events' => [
            'December 20 : MOU with the Indonesian Society of Project Management Professionals (IAMPI)',
            'November 3 : MOU with the Project Management Committee of the China Construction Industry Association (CPMC)',
            'June 7 : MOU with the Korean Commercial Arbitration Board',
            'April 17 : MOU with the Korea Land Trust',
        ]],
        ['year' => '2016', 'events' => [
            'November 16 : MOU with the Vietnam National Real Estate Association (VNREA)',
            'September 22 : MOU with the Royal Institution of Chartered Surveyors (RICS), UK',
            'April 7 : MOU among the Korea Institute of Construction Engineering and Management, CMAK, and the Korea Construction Engineering Management Association',
        ]],
        ['year' => '2015', 'events' => [
            'July 9 : Qualification integration MOU among three organizations — CMAK, the Korean Professional Engineers Association, and the Construction Engineering Education Institute',
            'April 10 : MOU with the Ministry of Construction (MOC), Vietnam',
        ]],
        ['year' => '2013', 'events' => [
            'May 9 : MOU with the Ministry of Construction (MOC), Myanmar',
        ]],
        ['year' => '2012', 'events' => [
            'June 21 : MOU with the Ministry of Land Management, Urban Planning and Construction (MLMUPC), Cambodia',
            'March 17 : Becomes a member of the Asia Pacific Federation of Project Management (APFPM)',
            'March 13 : MOU with the Construction Management Association of Spain (CMAS)',
        ]],
        ['year' => '2011', 'events' => [
            'November 7 : Renewal of MOU with the Construction Management Association of America (CMAA)',
        ]],
        ['year' => '2010', 'events' => [
            'December 15 : MOU with the Chartered Institute of Building (CIOB), UK',
            'April 30 : Declaration of International CM Day',
        ]],
        ['year' => '2007', 'events' => [
            'February 26 : Amendment of the Articles of Association (Construction Management Association → Korea Construction Management Association)',
        ]],
        ['year' => '2006', 'events' => [
            'October 17 : MOU with the Construction Management Association of America (CMAA)',
            'June 9 : MOU with the Overseas Construction Association of Korea (ICAK)',
        ]],
        // 구 영문홈 History(eng/html1/in_history.html) 원문 복원
        ['year' => '2003', 'events' => [
            'March 6 : Designated by the Ministry of Education Science and Technology as the agency for elective professional education',
            'January 21 : Designated by the Ministry of Public Administration and Security as the agency for elective professional education for regional public servants',
        ]],
        ['year' => '2002', 'events' => [
            'November 8 : Designated by the Ministry of Construction and Transportation as the agency for CM capability evaluation and public disclosure',
        ]],
        ['year' => '2001', 'events' => [
            'December 31 : Designated by the Ministry of Construction and Transportation as the agency to confirm CM service performance records',
            'September 3 : Designated by the Ministry of Construction and Transportation as the agency for CM performance maintenance and management',
        ]],
        ['year' => '1999', 'events' => [
            'July 31 : Amendment of the Articles of Association (Korea Construction Management Association → Construction Management Association)',
            'June 26 : Designated by the Ministry of Construction and Transportation as a professional education agency',
        ]],
        ['year' => '1997', 'events' => [
            'December 30 : Designated by the Ministry of Construction and Transportation as a refresher education agency for construction engineers',
            'July 22 : Permitted by the Ministry of Construction and Transportation to be established as a non-profit corporation',
            'March 27 : The Construction Management Association of Korea is founded',
        ]],
    ];
@endphp

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'History' }}</h2>
    <p class="desc">{{ $page->description ?? 'The milestones of the Construction Management Association of Korea.' }}</p>

    <div class="eng-timeline">
        @foreach($timeline as $group)
            <div class="eng-timeline-item">
                <div class="eng-timeline-year">{{ $group['year'] }}</div>
                <div class="eng-timeline-text">
                    <ul>
                        @foreach($group['events'] as $ev)
                            <li>{{ $ev }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
