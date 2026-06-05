@extends('layouts.sub')

@section('title', '조직도 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/organization')
@section('page-title', '조직도')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">조직도</h2>

    <div class="sub-section" style="text-align:center; margin-top:20px;">
        <img src="/cmak/images/intro/org/intro2_3img1i.gif" alt="조직도 상단 - 총회, 회장, 이사회, 상임이사, 감사, 고문·자문위원회, 분야별 위원회, 전국지회" style="max-width:100%;">
        <img src="/cmak/images/intro/org/intro2_3img1j.gif" alt="조직도 하단 - 운영지원본부, 정책사업본부, 교육훈련본부, 사업지원본부, 건설산업연구센터" style="max-width:100%;">
    </div>
</div>
@endsection
