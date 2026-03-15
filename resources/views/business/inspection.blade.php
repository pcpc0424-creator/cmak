@extends('layouts.sub')

@section('title', '자격검정 - 한국CM협회')
@section('category', '협회사업')
@section('category-link', '/cmak/business/membership')
@section('page-title', '자격검정')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">건설사업관리사(CMP) 자격검정</h2>
    <p class="sub-content-desc">건설사업관리 전문가 양성을 위한 자격검정 시험을 주관합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">자격검정 개요</h3>
        <p>
            건설사업관리사(Construction Management Professional, CMP) 자격검정은
            건설사업관리 분야의 전문지식과 실무능력을 갖춘 인재를 양성하기 위해
            한국CM협회가 주관하는 자격시험입니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">시험 구성</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>구분</th>
                    <th>시험과목</th>
                    <th style="width:100px;">문항수</th>
                    <th style="width:100px;">시험시간</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center; font-weight:600;" rowspan="4">1교시</td>
                    <td>건설사업관리 일반</td>
                    <td style="text-align:center;">25문항</td>
                    <td style="text-align:center;" rowspan="4">150분</td>
                </tr>
                <tr>
                    <td>건설사업관리 계약 및 법규</td>
                    <td style="text-align:center;">25문항</td>
                </tr>
                <tr>
                    <td>공정관리</td>
                    <td style="text-align:center;">25문항</td>
                </tr>
                <tr>
                    <td>원가관리</td>
                    <td style="text-align:center;">25문항</td>
                </tr>
                <tr>
                    <td style="text-align:center; font-weight:600;" rowspan="2">2교시</td>
                    <td>품질 및 안전관리</td>
                    <td style="text-align:center;">25문항</td>
                    <td style="text-align:center;" rowspan="2">90분</td>
                </tr>
                <tr>
                    <td>사업관리 실무</td>
                    <td style="text-align:center;">25문항</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">응시자격</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:12px;">
            <div class="sub-info-box">
                <dt>학력 요건</dt>
                <dd>건설 관련 학과 학사 이상 또는 동등 학력 보유자</dd>
            </div>
            <div class="sub-info-box">
                <dt>경력 요건</dt>
                <dd>건설사업관리 관련 업무 실무경력 3년 이상</dd>
            </div>
            <div class="sub-info-box">
                <dt>교육 요건</dt>
                <dd>협회 지정 CM전문교육 이수자 (가점 부여)</dd>
            </div>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">시험 일정</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>구분</th>
                    <th>일정</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">원서접수</td>
                    <td>매년 상반기 공고 (홈페이지 공지)</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">시험일</td>
                    <td>매년 하반기 시행</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">합격발표</td>
                    <td>시험일로부터 약 60일 이내</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">합격기준</td>
                    <td>전 과목 평균 60점 이상, 과목당 40점 이상</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>
            한국CM협회 사업부 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr
        </dd>
    </div>
</div>
@endsection
