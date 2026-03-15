@extends('layouts.sub')

@section('title', 'CM전문교육 - 한국CM협회')
@section('category', '협회사업')
@section('category-link', '/cmak/business/membership')
@section('page-title', 'CM전문교육')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM전문교육 및 출장교육</h2>
    <p class="sub-content-desc">건설사업관리 전문인력 양성을 위한 체계적인 교육 프로그램을 운영합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">교육 개요</h3>
        <p>
            한국CM협회는 건설사업관리 전문인력의 역량 강화를 위해
            정규교육과정, 특별교육과정, 출장교육 등 다양한 교육 프로그램을 운영하고 있습니다.
            교육 이수 시 CMP 자격검정 응시 가점 및 건설기술인 교육학점(CPD)이 인정됩니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">교육과정</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>과정명</th>
                    <th style="width:80px;">기간</th>
                    <th style="width:80px;">대상</th>
                    <th>주요내용</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:600;">CM기본과정</td>
                    <td style="text-align:center;">3일</td>
                    <td style="text-align:center;">신입</td>
                    <td>CM 개론, 관련 법규, 계약관리 기초</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">CM심화과정</td>
                    <td style="text-align:center;">5일</td>
                    <td style="text-align:center;">경력자</td>
                    <td>공정관리, 원가관리, 품질/안전관리, 사업관리 실무</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">CM특별과정</td>
                    <td style="text-align:center;">2일</td>
                    <td style="text-align:center;">전체</td>
                    <td>최신 CM 트렌드, BIM/스마트건설, 해외 CM 사례</td>
                </tr>
                <tr>
                    <td style="font-weight:600;">출장교육</td>
                    <td style="text-align:center;">협의</td>
                    <td style="text-align:center;">기업</td>
                    <td>기업 맞춤형 교육, 현장 실무 교육</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">교육 혜택</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:12px;">
            <div class="sub-info-box">
                <dt>CMP 자격검정 가점</dt>
                <dd>CM전문교육 이수 시 자격검정 응시 가점 부여</dd>
            </div>
            <div class="sub-info-box">
                <dt>CPD 학점 인정</dt>
                <dd>건설기술인 계속교육(CPD) 학점으로 인정</dd>
            </div>
            <div class="sub-info-box">
                <dt>회원사 할인</dt>
                <dd>한국CM협회 회원사 소속 교육생 수강료 할인</dd>
            </div>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">교육일정</h3>
        <p>
            교육일정은 매년 초 연간 계획으로 공지하며, 상세 일정은 협회 홈페이지 공지사항을 통해 안내합니다.
        </p>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>
            한국CM협회 교육부 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr
        </dd>
    </div>
</div>
@endsection
