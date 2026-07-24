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
        ['year' => '2019', 'events' => [
            '07월 23일 : 방글라데시 주택공공사업부(MOHPW)와 MOU 체결',
            '04월 11일 : 연변조선족자치주건축업협회(YCIA)와 MOU 체결',
            '02월 20일 : 한국부동산개발협회와 MOU 체결',
        ]],
        ['year' => '2018', 'events' => [
            '12월 21일 : 일본CM협회(CMAJ)와 MOU 체결',
            '09월 29일 : 국제CM협회(ICMPA)와 MOU 체결',
            '06월 05일 : 영국왕립건설협회(CIOB)와 MOU 연장',
            '02월 02일 : 주택도시보증공사와 MOU 체결',
        ]],
        ['year' => '2017', 'events' => [
            '12월 20일 : 인도네시아 PM협회(IAMPI)와 MOU 체결',
            '11월 03일 : 중국 건설산업협회 공정항목관리위원회(CPMC) MOU 체결',
            '06월 07일 : 대한상사중재원과 MOU 체결',
            '04월 17일 : 대한토지신탁과 MOU 체결',
        ]],
        ['year' => '2016', 'events' => [
            '11월 16일 : 베트남 부동산개발협회(VNREA)와 MOU 체결',
            '09월 22일 : 영국 왕립서베이어협회(RICS)와 MOU 체결',
            '04월 07일 : 한국건설관리학회-한국CM협회-한국건설기술관리협회 MOU 체결',
        ]],
        ['year' => '2015', 'events' => [
            '07월 09일 : 한국CM협회, 기술사회, 건설기술교육원 등 3개 기관 자격통합 MOU 체결',
            '04월 10일 : 베트남 건설부(MOC)와 MOU 체결',
        ]],
        ['year' => '2013', 'events' => [
            '05월 09일 : 미얀마 건설부(MOC) 양해각서 체결',
        ]],
        ['year' => '2012', 'events' => [
            '06월 21일 : 캄보디아 건설부(MLMUPC) 양해각서 체결',
            '03월 17일 : 아시아-태평양PM연합회(APFPM) 회원 가입',
            '03월 13일 : 스페인CM협회(CMAS)와 MOU 체결',
        ]],
        ['year' => '2011', 'events' => [
            '11월 07일 : 미국CM협회(CMAA)와 MOU 연장 체결',
        ]],
        ['year' => '2010', 'events' => [
            '12월 15일 : 영국왕립건설협회(CIOB) 양해각서 체결',
            '04월 30일 : 세계CM의 날 제정 선포',
        ]],
        ['year' => '2007', 'events' => [
            '02월 26일 : 정관 개정(건설사업관리협회→한국건설관리협회)',
        ]],
        ['year' => '2006', 'events' => [
            '10월 17일 : 미국CM협회(CMAA) 양해각서 체결',
            '06월 09일 : 해외건설협회(ICAK) 양해각서 체결',
        ]],
        ['year' => '2002', 'events' => [
            '11월 08일 : 건설교통부, CM능력평가공시업무수행기관 지정',
        ]],
        ['year' => '2001', 'events' => [
            '12월 31일 : 건설교통부, CM용역수행실적확인기관 지정',
            '09월 03일 : 건설교통부, CM실적유지·관리업무기관 지정',
        ]],
        ['year' => '1999', 'events' => [
            '07월 31일 : 정관 개정(한국건설사업관리협회→건설사업관리협회)',
            '06월 26일 : 건설교통부, 전문교육기관 지정',
        ]],
        ['year' => '1997', 'events' => [
            '12월 30일 : 건설교통부, 건설기술자보수교육기관 지정',
            '07월 22일 : 건설교통부, 비영리법인 설립허가',
            '03월 27일 : 협회 창립',
        ]],
    ];
@endphp

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">주요 연혁</h2>

    <div class="history-timeline">
        @foreach($history as $year)
            <div class="history-timeline-item">
                <div class="history-timeline-year">{{ $year['year'] }}</div>
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
    .history-timeline { position: relative; padding-left: 30px; margin-top: 24px; }
    .history-timeline::before {
        content: ''; position: absolute; left: 8px; top: 8px; bottom: 8px;
        width: 2px; background: linear-gradient(to bottom, #0061c2, #e8ecf1);
    }
    .history-timeline-item { position: relative; margin-bottom: 30px; padding-left: 24px; }
    .history-timeline-item::before {
        content: ''; position: absolute; left: -26px; top: 5px;
        width: 14px; height: 14px; border-radius: 50%;
        background: #0061c2; border: 3px solid #fff; box-shadow: 0 0 0 2px #0061c2;
    }
    .history-timeline-year { font-size: 19px; font-weight: 800; color: #0a3d7c; margin-bottom: 8px; }
    .history-events { padding-left: 2px; line-height: 1.9; list-style: none; margin: 0; }
    .history-events li { position: relative; padding-left: 14px; color: #333; font-size: 14.5px; }
    .history-events li::before {
        content: ''; position: absolute; left: 0; top: 13px;
        width: 4px; height: 4px; background: #0061c2; border-radius: 50%;
    }
</style>
@endsection
