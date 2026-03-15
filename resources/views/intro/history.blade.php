@extends('layouts.sub')

@section('title', '연혁 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/intro/greeting')
@section('page-title', '연혁')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">연혁</h2>
    <p class="sub-content-desc">한국CM협회의 발자취를 소개합니다.</p>

    <div style="position:relative; padding-left:30px;">
        {{-- 타임라인 세로선 --}}
        <div style="position:absolute; left:8px; top:0; bottom:0; width:2px; background:linear-gradient(180deg, #0061c2, #e1e1e1);"></div>

        @php
            $timeline = [
                ['year' => '2025', 'events' => [
                    '제28차 정기총회 개최',
                    '건설사업관리사(CMP) 제18회 자격검정 시행',
                    'CM능력평가·공시 실시',
                ]],
                ['year' => '2024', 'events' => [
                    '제27차 정기총회 개최',
                    '제7회 세계CM경진대회(CONSMA) 개최',
                    'CM전문교육 과정 운영',
                ]],
                ['year' => '2023', 'events' => [
                    '제26차 정기총회 개최',
                    '건설사업관리사 자격검정 시행',
                    'CM Herald 발간',
                ]],
                ['year' => '2020', 'events' => [
                    '제23차 정기총회 개최',
                    'CM능력평가·공시 제도 개선',
                ]],
                ['year' => '2015', 'events' => [
                    '제18차 정기총회 개최',
                    'CM전문교육 체계 개편',
                    '건설사업관리 발전 포럼 개최',
                ]],
                ['year' => '2010', 'events' => [
                    '제13차 정기총회 개최',
                    '건설사업관리사 자격검정 제도 도입',
                ]],
                ['year' => '2005', 'events' => [
                    '제8차 정기총회 개최',
                    'CM능력평가·공시 제도 시행',
                ]],
                ['year' => '2000', 'events' => [
                    '제3차 정기총회 개최',
                    'CM전문교육 과정 개설',
                ]],
                ['year' => '1996', 'events' => [
                    '한국CM협회 설립 (건설산업기본법 제50조)',
                    '초대 회장 취임',
                ]],
            ];
        @endphp

        @foreach($timeline as $item)
            <div style="position:relative; margin-bottom:32px;">
                {{-- 원형 마커 --}}
                <div style="position:absolute; left:-26px; top:2px; width:16px; height:16px; border-radius:50%; background:#0061c2; border:3px solid #fff; box-shadow: 0 0 0 2px #0061c2;"></div>

                <div style="margin-bottom:8px;">
                    <span style="font-size:20px; font-weight:800; color:#0061c2;">{{ $item['year'] }}</span>
                </div>
                <ul style="margin:0; padding:0; list-style:none;">
                    @foreach($item['events'] as $event)
                        <li style="padding:4px 0; font-size:14px; color:#444; line-height:1.6; padding-left:16px; position:relative;">
                            <span style="position:absolute; left:0; color:#0061c2;">·</span>
                            {{ $event }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>
@endsection
