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
    <p class="desc">{{ $page->description ?? 'The second Monday in March each year is the International Construction Management Day.' }}</p>

    <h3>History</h3>
    <ul>
        <li><strong>October 25 ~ 29, 2009</strong> : The Chairman of CMAK is invited to the CMAA National Conference held in Orlando, US. On October 25, Chairman Bae attends the CMAA board meeting and gives a presentation on the topic of 'CM : The present and the future in Korea' and on the same day, proposes the establishment of an International CM Day. CMAA International Committee suggests a detailed discussion be held on the topic of the International CM Day at the IDCM Forum in Bangkok, Thailand in March 2010.</li>
        <li><strong>March 7, 2010</strong> : At the IDCM Forum in Bangkok, Thailand, representatives from CMAK, CMAA and CIOB agree to designate the second Monday of March each year as the International CM Day. IPMA and CMAJ express interest in the participation of the International CM Day and become participating members of the International CM Day.</li>
        <li><strong>April 30, 2010</strong> : At the 2010 CM Seoul Forum &amp; Global CM Contest, 5 CM related associations, CMAK, CMAA, CMAJ, CIOB and IPMA proclaim the second Monday of March each year to be the International CM Day and all parties sign "The Declaration of International CM Day". All parties agree to work together to encourage as many construction related associations around the world as possible to participate in the International CM Day. All celebrations for the day are to take place in respective countries.</li>
    </ul>

    <h3>Purpose</h3>
    <ul>
        <li>Establish CM identity and promote its expansion around the world</li>
        <li>Establish a network to share and exchange CM related information and resources</li>
        <li>Encourage a sense of belonging and responsibility and thereby boost the morale of all participants</li>
    </ul>

    <h3>The Declaration of International CM Day</h3>
    <p>The construction industry has grown along with mankind, from the earliest basic shelters to today's most complex designs. Today the industry is challenged to respond positively to a rapidly changing industrial environment. Construction processes have also been transformed, from merely erecting structures to complete management of built environments based on extensive knowledge, experience and management skill. We call this comprehensive group of services Construction Management, and it has become a global center of attention.</p>
    <p>CM is being recognized worldwide as the ideal tool to assure the best possible outcome by managing construction systematically and efficiently throughout its life cycle. We, as the professionals of the world construction community, should exert our efforts to promote the effectiveness of CM more widely and facilitate the broadest adoption of CM for the perfect construction of our global village.</p>
    <p>Keeping all these trends and sentiments in mind, we need to create an opportunity for the construction industry to play its role as a leader in promoting prosperity for mankind, especially by taking the initiative ourselves in this noble mission. We therefore hereby declare that the second Monday in March of each year will be the "International Construction Management Day."</p>
</div>
@endsection
