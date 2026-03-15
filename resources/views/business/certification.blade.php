@extends('layouts.sub')

@section('title', 'CM능력평가 공시 - 한국CM협회')
@section('category', '협회사업')
@section('category-link', '/cmak/business/membership')
@section('page-title', 'CM능력평가 공시')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM능력평가 · 공시</h2>
    <p class="sub-content-desc">건설사업관리 기업의 능력을 객관적으로 평가하고 공시합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">제도 개요</h3>
        <p>
            CM능력평가·공시제도는 건설사업관리(CM)를 수행하는 기업의 시공전·시공·시공후 단계별
            수행능력을 종합적으로 평가하여 그 결과를 공시하는 제도입니다.
            발주자가 CM사를 선정할 때 객관적인 판단기준을 제공하고,
            CM기업의 건전한 경쟁과 발전을 도모합니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">평가항목</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th>평가분야</th>
                    <th>평가항목</th>
                    <th style="width:100px;">배점</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center; font-weight:600;" rowspan="3">경영능력</td>
                    <td>자본금</td>
                    <td style="text-align:center;">10점</td>
                </tr>
                <tr>
                    <td>매출액</td>
                    <td style="text-align:center;">15점</td>
                </tr>
                <tr>
                    <td>경영평가</td>
                    <td style="text-align:center;">10점</td>
                </tr>
                <tr>
                    <td style="text-align:center; font-weight:600;" rowspan="2">기술능력</td>
                    <td>기술인력 보유현황</td>
                    <td style="text-align:center;">30점</td>
                </tr>
                <tr>
                    <td>CM 수행실적</td>
                    <td style="text-align:center;">25점</td>
                </tr>
                <tr>
                    <td style="text-align:center; font-weight:600;">신인도</td>
                    <td>수상·감점 등</td>
                    <td style="text-align:center;">10점</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center; font-weight:700; background:#f0f4fa;">합계</td>
                    <td style="text-align:center; font-weight:700; background:#f0f4fa;">100점</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">신청 절차</h3>
        <div style="display:flex; align-items:center; gap:0; flex-wrap:wrap; justify-content:center; margin:20px 0;">
            @php
                $steps = ['공고 확인', '온라인 신청', '서류 제출', '평가 심사', '결과 공시'];
            @endphp
            @foreach($steps as $i => $step)
                <div style="text-align:center; padding:16px 24px; background:{{ $i % 2 === 0 ? '#f0f4fa' : '#e3ecf7' }}; border-radius:8px;">
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
        <h3 class="sub-section-title">공시 현황</h3>
        <p>
            매년 평가 결과를 협회 홈페이지 및 관보를 통해 공시하며,
            발주기관 및 관련 기관에 통보합니다.
        </p>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>문의처</dt>
        <dd>
            한국CM협회 사업부 &nbsp;|&nbsp; TEL: 02-585-4712~3 &nbsp;|&nbsp; E-mail: cm@cmak.or.kr
        </dd>
    </div>
</div>
@endsection
