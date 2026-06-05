@extends('layouts.sub')

@section('title', '주요연혁 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/history')
@section('page-title', '주요연혁')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@php
    $history = [
        ['img' => 'intro2_2img19.gif', 'events' => [
            '07월 23일 : 방글라데시 주택공공사업부(MOHPW)와 MOU 체결',
            '04월 11일 : 연변조선족자치주건축업협회(YCIA)와 MOU 체결',
            '02월 20일 : 한국부동산개발협회와 MOU 체결',
        ]],
        ['img' => 'intro2_2img18.gif', 'events' => [
            '12월 21일 : 일본CM협회(CMAJ)와 MOU 체결',
            '09월 29일 : 국제CM협회(ICMPA)와 MOU 체결',
            '06월 05일 : 영국왕립건설협회(CIOB)와 MOU 연장',
            '02월 02일 : 주택도시보증공사와 MOU 체결',
        ]],
        ['img' => 'intro2_2img17.gif', 'events' => [
            '12월 20일 : 인도네시아 PM협회(IAMPI)와 MOU 체결',
            '11월 03일 : 중국 건설산업협회 공정항목관리위원회(CPMC) MOU 체결',
            '06월 07일 : 대한상사중재원과 MOU 체결',
            '04월 17일 : 대한토지신탁과 MOU 체결',
        ]],
        ['img' => 'intro2_2img16.gif', 'events' => [
            '11월 16일 : 베트남 부동산개발협회(VNREA)와 MOU 체결',
            '09월 22일 : 영국 왕립서베이어협회(RICS)와 MOU 체결',
            '04월 07일 : 한국건설관리학회-한국CM협회-한국건설기술관리협회 MOU 체결',
        ]],
        ['img' => 'intro2_2img15.gif', 'events' => [
            '07월 09일 : 한국CM협회, 기술사회, 건설기술교육원 등 3개 기관 자격통합 MOU 체결',
            '04월 10일 : 베트남 건설부(MOC)와 MOU 체결',
        ]],
        ['img' => 'intro2_2img13.gif', 'events' => [
            '05월 09일 : 미얀마 건설부(MOC) 양해각서 체결',
        ]],
        ['img' => 'intro2_2img12.gif', 'events' => [
            '06월 21일 : 캄보디아 건설부(MLMUPC) 양해각서 체결',
            '03월 17일 : 아시아-태평양PM연합회(APFPM) 회원 가입',
            '03월 13일 : 스페인CM협회(CMAS)와 MOU 체결',
        ]],
        ['img' => 'intro2_2img11.gif', 'events' => [
            '11월 07일 : 미국CM협회(CMAA)와 MOU 연장 체결',
        ]],
        ['img' => 'intro2_2img10.gif', 'events' => [
            '12월 15일 : 영국왕립건설협회(CIOB) 양해각서 체결',
            '04월 30일 : 세계CM의 날 제정 선포',
        ]],
        ['img' => 'intro2_2img9.gif', 'events' => [
            '02월 26일 : 정관 개정(건설사업관리협회→한국건설관리협회)',
        ]],
        ['img' => 'intro2_2img8.gif', 'events' => [
            '06월 09일 : 해외건설협회(ICAK) 양해각서 체결',
            '10월 17일 : 미국CM협회(CMAA) 양해각서 체결',
        ]],
        ['img' => 'intro2_2img5.gif', 'events' => [
            '11월 08일 : 건설교통부, CM능력평가공시업무수행기관 지정',
        ]],
        ['img' => 'intro2_2img4.gif', 'events' => [
            '12월 31일 : 건설교통부, CM용역수행실적확인기관 지정',
            '09월 03일 : 건설교통부, CM실적유지·관리업무기관 지정',
        ]],
        ['img' => 'intro2_2img2.gif', 'events' => [
            '07월 31일 : 정관 개정(한국건설사업관리협회→건설사업관리협회)',
            '06월 26일 : 건설교통부, 전문교육기관 지정',
        ]],
        ['img' => 'intro2_2img1.gif', 'events' => [
            '12월 30일 : 건설교통부, 건설기술자보수교육기관 지정',
            '07월 22일 : 건설교통부, 비영리법인 설립허가',
            '03월 27일 : 협회 창립',
        ]],
    ];
@endphp

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">주요 연혁</h2>

    <div class="history-list">
        @foreach($history as $year)
            <div class="history-block">
                <img src="/cmak/images/intro/history/{{ $year['img'] }}" alt="연도" class="history-year-img">
                <ul class="history-events">
                    @foreach($year['events'] as $event)
                        <li>{{ $event }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>

<style>
    .history-list { margin-top: 20px; }
    .history-block { margin-bottom: 28px; }
    .history-year-img { display: block; margin-bottom: 10px; max-width: 100%; }
    .history-events { padding-left: 40px; line-height: 2; list-style: none; margin: 0; }
    .history-events li { position: relative; padding-left: 14px; color: #333; }
    .history-events li::before {
        content: '';
        position: absolute;
        left: 0; top: 14px;
        width: 4px; height: 4px;
        background: #0061c2;
        border-radius: 50%;
    }
</style>
@endsection
