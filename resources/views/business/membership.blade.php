@extends('layouts.sub')

@section('title', '회원가입 - 한국CM협회')
@section('category', '협회사업')
@section('category-link', '/cmak/business/membership')
@section('page-title', '회원가입')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원가입 안내</h2>
    <p class="sub-content-desc">한국CM협회 회원가입 절차와 자격요건을 안내합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">가입자격</h3>
        <p>
            「건설산업기본법」 제2조에 따른 건설사업관리를 수행하는 법인으로서,
            건설사업관리 실적이 있는 기업이 가입할 수 있습니다.
        </p>
        <div style="margin-top:16px; display:grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap:12px;">
            <div class="sub-info-box">
                <dt>정회원</dt>
                <dd>건설사업관리 업무를 수행하는 건축사사무소, 엔지니어링 기업, 종합건설업체 등</dd>
            </div>
            <div class="sub-info-box">
                <dt>준회원</dt>
                <dd>건설사업관리 관련 업무를 수행하거나 관심이 있는 기업 및 단체</dd>
            </div>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">가입절차</h3>
        <div style="display:flex; align-items:center; gap:0; flex-wrap:wrap; justify-content:center; margin:20px 0;">
            @php
                $steps = ['가입신청서 작성', '구비서류 제출', '이사회 심의', '승인 통지', '연회비 납부', '가입 완료'];
            @endphp
            @foreach($steps as $i => $step)
                <div style="text-align:center; padding:16px 20px; background:{{ $i % 2 === 0 ? '#f0f4fa' : '#e3ecf7' }}; border-radius:8px; min-width:120px;">
                    <div style="font-size:12px; color:#0061c2; font-weight:700; margin-bottom:4px;">STEP {{ $i + 1 }}</div>
                    <div style="font-size:13px; font-weight:600; color:#1a1a1a;">{{ $step }}</div>
                </div>
                @if($i < count($steps) - 1)
                    <div style="color:#0061c2; font-size:20px; padding:0 4px;">→</div>
                @endif
            @endforeach
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">구비서류</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:50px;">No.</th>
                    <th>서류명</th>
                    <th style="width:100px;">비고</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="text-align:center;">1</td><td>회원가입 신청서 1부</td><td style="text-align:center;">소정양식</td></tr>
                <tr><td style="text-align:center;">2</td><td>사업자등록증 사본 1부</td><td style="text-align:center;">필수</td></tr>
                <tr><td style="text-align:center;">3</td><td>법인등기부등본 1부</td><td style="text-align:center;">필수</td></tr>
                <tr><td style="text-align:center;">4</td><td>건설사업관리 실적 증빙서류</td><td style="text-align:center;">해당시</td></tr>
            </tbody>
        </table>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">연회비</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>구분</th>
                    <th>연회비</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="text-align:center;">정회원</td><td style="text-align:center;">별도 문의</td></tr>
                <tr><td style="text-align:center;">준회원</td><td style="text-align:center;">별도 문의</td></tr>
            </tbody>
        </table>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>
            한국CM협회 기획부 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; FAX: 02-585-4714 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr
        </dd>
    </div>
</div>
@endsection
