@extends('layouts.sub')

@section('title', 'CM실적확인 - 한국CM협회')
@section('category', '협회사업')
@section('category-link', '/cmak/business/membership')
@section('page-title', 'CM실적확인')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM실적 유지관리 및 실적확인</h2>
    <p class="sub-content-desc">건설사업관리 실적의 등록·관리 및 확인서 발급 업무를 안내합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">제도 개요</h3>
        <p>
            CM실적확인제도는 건설사업관리 기업이 수행한 CM 실적을 체계적으로 관리하고,
            실적확인서를 발급하여 입찰참가 및 적격심사 등에 활용할 수 있도록 하는 제도입니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">실적등록 대상</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:12px;">
            <div class="sub-info-box">
                <dt>건설사업관리 용역</dt>
                <dd>「건설산업기본법」에 따른 건설사업관리 업무 수행 실적</dd>
            </div>
            <div class="sub-info-box">
                <dt>감리 업무</dt>
                <dd>「건설기술 진흥법」에 따른 건설사업관리(감리) 업무 수행 실적</dd>
            </div>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">신청방법</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>구분</th>
                    <th>내용</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center; width:150px;">신청방법</td>
                    <td>온라인 신청 (협회 홈페이지)</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">제출서류</td>
                    <td>실적확인 신청서, 계약서 사본, 준공확인서 등</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">처리기간</td>
                    <td>접수일로부터 7일 이내 (보완 요청 시 제외)</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">수수료</td>
                    <td>별도 문의</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>
            한국CM협회 정책부 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr
        </dd>
    </div>
</div>
@endsection
