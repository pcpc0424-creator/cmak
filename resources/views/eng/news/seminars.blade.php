@php $page = eng_page('news/seminars'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Educations & Seminars') . ' - CMAK')
@section('hero', true)
@section('category', 'CMAK News')
@section('category-link', '/cmak/eng/news/publications')
@section('page-title', $page->title ?? 'Educations & Seminars')
@section('side-menu')
    @include('eng.news._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Educations &amp; Seminars' }}</h2>
    <p class="desc">{{ $page->description ?? 'Professional development opportunities for the CM community.' }}</p>

    <p>CMAK delivers a year-round programme of educations and seminars to help CM professionals stay current with the latest knowledge, skills and trends. From foundational CM courses to advanced technical seminars, our programmes serve all career stages.</p>

    <h3>Education Programmes</h3>
    <table class="eng-table">
        <thead>
            <tr><th>Programme</th><th>Target</th><th>Duration</th><th>Frequency</th></tr>
        </thead>
        <tbody>
            @forelse($page?->activeItems ?? [] as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->subtitle }}</td>
                    <td>{{ $item->date_text }}</td>
                    <td>{{ $item->description }}</td>
                </tr>
            @empty
                <tr><td colspan="4">No programmes available.</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Technical Seminars</h3>
    <p>CMAK regularly hosts technical seminars on topics of importance to the CM community, including:</p>
    <ul>
        <li>CM industry trends and outlook</li>
        <li>Public procurement and construction policy updates</li>
        <li>BIM, modular construction and OSC (Off-Site Construction)</li>
        <li>Risk management and dispute resolution</li>
        <li>International CM practice and global benchmarking</li>
        <li>ESG, sustainability and net-zero construction</li>
    </ul>

    <h3>Registration</h3>
    <p>Most CMAK programmes are open to both members and non-members, with discounted fees for CMAK members. To register or to learn more about upcoming programmes, please contact the CMAK secretariat or visit the Korean website for the latest schedule.</p>
</div>
@endsection
