@extends('layouts.sub')

@section('title', 'CM이란 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', 'CM이란')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM이란</h2>
    <p class="sub-content-desc">건설사업관리(Construction Management)의 개념과 역할을 소개합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">건설사업관리(CM)의 정의</h3>
        <p>
            건설사업관리(Construction Management, CM)란 건설공사에 관한 기획, 타당성 조사,
            분석, 설계, 조달, 계약, 시공관리, 감리, 평가 또는 사후관리 등에 관한 관리업무의
            전부 또는 일부를 건설사업 발주자로부터 위탁받아 수행하는 것을 말합니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 역할</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:12px;">
            <div class="sub-info-box">
                <dt>기획단계</dt>
                <dd>사업 타당성 분석, 기본계획 수립, 예산 산정, 일정계획 수립</dd>
            </div>
            <div class="sub-info-box">
                <dt>설계단계</dt>
                <dd>설계 검토 및 VE, 설계 품질관리, 공사비 검토, 인허가 관리</dd>
            </div>
            <div class="sub-info-box">
                <dt>시공단계</dt>
                <dd>공정관리, 원가관리, 품질관리, 안전관리, 환경관리</dd>
            </div>
            <div class="sub-info-box">
                <dt>준공 후</dt>
                <dd>하자관리, 시설물 유지관리, 사후평가</dd>
            </div>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 유형</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:180px;">유형</th>
                    <th>설명</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:600; text-align:center;">시공책임형 CM<br><small style="color:#888;">(CM at Risk)</small></td>
                    <td>CM사가 시공에 대한 책임을 지고, 공사비 초과분에 대해 리스크를 부담하는 방식</td>
                </tr>
                <tr>
                    <td style="font-weight:600; text-align:center;">관리용역형 CM<br><small style="color:#888;">(CM for Fee)</small></td>
                    <td>CM사가 발주자를 대리하여 사업 전반을 관리하고, 관리 용역비를 받는 방식</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">관련 법령</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>법령명</th>
                    <th>관련 조항</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>건설산업기본법</td><td>제2조(정의), 제26조(건설사업관리)</td></tr>
                <tr><td>건설기술 진흥법</td><td>제39조(건설사업관리)</td></tr>
                <tr><td>건설산업기본법 시행령</td><td>제31조의2~31조의6</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
