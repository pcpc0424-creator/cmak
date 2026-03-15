@extends('layouts.sub')

@section('title', 'CM Herald - 한국CM협회')
@section('category', '협회사업')
@section('category-link', '/cmak/business/membership')
@section('page-title', 'CM Herald')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM HERALD</h2>
    <p class="sub-content-desc">한국CM협회의 월간 소식지 CM Herald를 소개합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">CM Herald 소개</h3>
        <p>
            CM Herald는 한국CM협회가 발행하는 월간 소식지로,
            건설사업관리 분야의 최신 동향, 정책 변화, 회원사 소식, 전문가 칼럼 등
            CM산업 관련 주요 정보를 제공합니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">주요 내용</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:12px;">
            <div class="sub-info-box">
                <dt>업계 동향</dt>
                <dd>국내외 건설사업관리 시장 동향 및 트렌드 분석</dd>
            </div>
            <div class="sub-info-box">
                <dt>정책/제도</dt>
                <dd>건설사업관리 관련 법령·제도 변경사항 안내</dd>
            </div>
            <div class="sub-info-box">
                <dt>전문가 칼럼</dt>
                <dd>CM 분야 전문가의 인사이트와 전망</dd>
            </div>
            <div class="sub-info-box">
                <dt>회원사 소식</dt>
                <dd>회원사의 주요 프로젝트 및 수상 소식</dd>
            </div>
            <div class="sub-info-box">
                <dt>협회 활동</dt>
                <dd>교육, 세미나, 국제교류 등 협회 주요 활동</dd>
            </div>
            <div class="sub-info-box">
                <dt>기획특집</dt>
                <dd>매월 특정 주제에 대한 심층 분석 기사</dd>
            </div>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">발간 현황</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:50px;">No.</th>
                    <th>호수</th>
                    <th>발행일</th>
                    <th style="width:100px;">보기</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center;">1</td>
                    <td>2026년 3월호 (통권 제350호)</td>
                    <td style="text-align:center;">2026-03-01</td>
                    <td style="text-align:center;"><a href="#" style="color:#0061c2;">PDF</a></td>
                </tr>
                <tr>
                    <td style="text-align:center;">2</td>
                    <td>2026년 2월호 (통권 제349호)</td>
                    <td style="text-align:center;">2026-02-01</td>
                    <td style="text-align:center;"><a href="#" style="color:#0061c2;">PDF</a></td>
                </tr>
                <tr>
                    <td style="text-align:center;">3</td>
                    <td>2026년 1월호 (통권 제348호)</td>
                    <td style="text-align:center;">2026-01-01</td>
                    <td style="text-align:center;"><a href="#" style="color:#0061c2;">PDF</a></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>구독 문의</dt>
        <dd>
            한국CM협회 기획부 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr
        </dd>
    </div>
</div>
@endsection
