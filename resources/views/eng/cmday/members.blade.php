@php $page = eng_page('cmday/members'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Participating Members') . ' - CMAK')
@section('hero', true)
@section('category', 'International CM Day')
@section('category-link', '/cmak/eng/cmday/introduction')
@section('page-title', $page->title ?? 'Participating Members')
@section('side-menu')
    @include('eng.cmday._side')
@endsection

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Participating Members' }}</h2>
    <p class="desc">{{ $page->description ?? 'Global CM associations and partner organizations participating in International CM Day.' }}</p>

    <p>International CM Day is a truly global celebration. The following construction management associations and industry partners participate in or support the celebration each year. CMAK proudly represents the Republic of Korea in this international community.</p>

    <h3>Founding & Partner Associations</h3>
    <table class="eng-table">
        <thead>
            <tr><th>Country / Region</th><th>Association</th></tr>
        </thead>
        <tbody>
            @forelse($page?->activeItems ?? [] as $item)
                <tr><td>{{ $item->subtitle }}</td><td>{{ $item->title }}</td></tr>
            @empty
                <tr><td>Republic of Korea</td><td>Construction Management Association of Korea (CMAK)</td></tr>
            @endforelse
        </tbody>
    </table>

    <h3>Korean Participants</h3>
    <p>CMAK welcomes participation from member firms, government bodies, academic institutions and industry partners across Korea. Each year a wide range of organizations contribute speakers, sponsorships and delegations.</p>
    <ul>
        <li>CMAK member CM firms</li>
        <li>Major Korean construction companies</li>
        <li>Government and public agencies (MOLIT, KICT, KISTEP and others)</li>
        <li>Universities and research institutes</li>
        <li>Industry associations and standards bodies</li>
    </ul>
</div>
@endsection
