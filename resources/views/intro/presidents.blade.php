@extends('layouts.sub')

@section('title', '역대 회장단 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/presidents')
@section('page-title', '역대 회장단')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">역대 회장단</h2>

    <div class="sub-section">
        @php
            $presidents = [
                [
                    'photo' => '/cmak/images/intro/org/intro2_4img6.png',
                    'name' => '배영휘',
                    'title' => '회장 (6대~11대)',
                    'period' => '2009.03.27 ~ 2027.04.23',
                ],
                [
                    'photo' => '/cmak/images/intro/org/intro2_4img5.jpg',
                    'name' => '전세기',
                    'title' => '㈜토펙ENG 전세기 회장직무대행',
                    'period' => '1999.12.01 ~ 2000.03.26',
                    'title2' => '㈜토펙ENG 전세기 회장 (3대·4대·5대)',
                    'period2' => '2000.03.27 ~ 2009.03.26',
                ],
                [
                    'photo' => '/cmak/images/intro/org/intro2_4img4.jpg',
                    'name' => '김문한',
                    'title' => '서울대학교 김문한 회장 (2대)',
                    'period' => '1999.08.01 ~ 1999.11.30',
                ],
                [
                    'photo' => null,
                    'name' => '이배호',
                    'title' => '중앙대학교 이배호 회장직무대행',
                    'period' => '1999.06.01 ~ 1999.07.31',
                ],
                [
                    'photo' => null,
                    'name' => '민경훈',
                    'title' => '두산건설㈜ 민경훈 회장직무대행',
                    'period' => '1998.11.01 ~ 1999.05.31',
                ],
                [
                    'photo' => '/cmak/images/intro/org/intro2_4img1.jpg',
                    'name' => '이내훈',
                    'title' => '현대건설㈜ 이내훈 회장 (1대)',
                    'period' => '1997.03.27 ~ 1998.10.31',
                ],
            ];
        @endphp

        @foreach($presidents as $p)
        <div style="display:flex; align-items:stretch; margin-bottom:15px; border:1px solid #e0e0e0; border-radius:4px; overflow:hidden;">
            <div style="width:146px; min-height:120px; flex-shrink:0; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                @if($p['photo'])
                    <img src="{{ $p['photo'] }}" alt="{{ $p['name'] }}" style="width:146px; height:145px; object-fit:cover;">
                @else
                    <span style="color:#999; font-size:14px;">사진 없음</span>
                @endif
            </div>
            <div style="flex:1; padding:20px 25px; display:flex; flex-direction:column; justify-content:center; background:#f9fafb;">
                <p style="font-size:15px; font-weight:bold; color:#333; margin-bottom:5px;">{{ $p['title'] }}</p>
                <p style="font-size:13px; color:#666;">{{ $p['period'] }}</p>
                @if(!empty($p['title2']))
                    <p style="font-size:15px; font-weight:bold; color:#333; margin-top:10px; margin-bottom:5px;">{{ $p['title2'] }}</p>
                    <p style="font-size:13px; color:#666;">{{ $p['period2'] }}</p>
                @endif
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
