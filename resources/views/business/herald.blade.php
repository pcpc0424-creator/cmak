@extends('layouts.sub')

@section('title', 'CM HERALD - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/herald')
@section('page-title', 'CM HERALD')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <div style="text-align:right; margin-bottom:14px;">
        <a href="https://www.cmak.or.kr/html/business/bcmhzine.asp" target="_blank" rel="noopener noreferrer" style="padding:6px 16px; background:#0061c2; color:white; border-radius:4px; text-decoration:none; font-size:13px;">CM Herald 웹진 보기</a>
    </div>

    <div class="sub-section">
        <p style="line-height:1.9;">
            우리 협회에서 발행하고 있는 월간 'CM Herald'는 우리나라 CM활성화를 목표로 이를 널리 알리기 위하여 2005년 2월부터 매회 3,000부씩 발간하여 현재 중앙부처, 지방자치단체(16개 시·도 및 234개 시·군·구) 및 교육청 등 공공기관, 연구소, 건설관련단체, 유관인사, 대학교 등 전국에 배포하고 있으며, CM전문지로서의 역할을 수행하고 있습니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">발행 정보</h3>
        <table class="sub-table">
            <tbody>
                <tr><td style="background:#EDEFDE; font-weight:bold; width:110px; text-align:center;">제호</td><td>CM Herald</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">간별</td><td>월간</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">규격(판형)</td><td>국배판(210×297㎜)</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">면수</td><td>평균 8면</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">부수</td><td>3,000부(무가지)</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">창간일</td><td>2005. 2.</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">발행처</td><td>한국CM협회(www.cmak.or.kr)</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">독자층</td><td>중앙부처, 지방자치단체(16개 시·도 및 234개 시·군·구) 및 교육청 등. 공공기관, 연구소, 건설관련단체, 유관인사, 대학교</td></tr>
                <tr><td style="background:#EDEFDE; font-weight:bold; text-align:center;">주소</td><td>(06673) 서울시 서초구 서초대로 88 유니온빌딩 4층</td></tr>
            </tbody>
        </table>
    </div>

    <h2 class="sub-content-title">· 원고 및 광고모집</h2>
    <div class="sub-section">
        <h3 class="sub-section-title">원고 모집 분야</h3>
        <table class="sub-table">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th>원고내용</th>
                    <th style="width:140px;">분량(A4)</th>
                </tr>
            </thead>
            <tbody>
                <tr><td>시의성 있는 주제의 특별기고 및 칼럼</td><td style="text-align:center;">2페이지 이내</td></tr>
                <tr><td>국내 CM관련 법령에 대한 의견 또는 자유기고문</td><td style="text-align:center;">1페이지</td></tr>
                <tr><td>국외동향</td><td style="text-align:center;">1페이지</td></tr>
                <tr><td>국내·외 CM사례</td><td style="text-align:center;">1페이지</td></tr>
                <tr><td>외국의 CM관련 법령</td><td style="text-align:center;">1페이지</td></tr>
                <tr><td>국내·외 CM관련 학술대회, 연구소 및 현장방문 체험기</td><td style="text-align:center;">1페이지</td></tr>
            </tbody>
        </table>

        <div style="margin-top:12px; padding:12px 16px; background:#f6f9fc; border-radius:6px; line-height:1.9;">
            <p style="margin:0;">※ 채택된 원고는 소정의 원고료를 지급하며, 원고는 지면의 사정에 따라 필자의 양해 하에 그 양을 조정할 수 있습니다.</p>
            <p style="margin:6px 0 0 0;">※ 원고는 A4 용지(200자 원고지 10장 내외의 분량)에 글자모양을 바탕체/10 point/160%로 작성하여 주시기 바랍니다.</p>
            <p style="margin:6px 0 0 0; font-weight:bold;">광고는 수시로 접수하며 원고는 매달 20일까지 접수합니다.</p>
        </div>

        <h3 class="sub-section-title" style="margin-top:24px;">광고 패키지</h3>
        <table class="sub-table" style="text-align:center;">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th>&nbsp;</th>
                    <th>광고위치</th>
                    <th>광고모집</th>
                    <th>이미지크기<br>(Pixel)</th>
                    <th>광고료/1년<br>(VAT별도)</th>
                    <th>이미지수</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2" style="background:#EDEFDE; font-weight:bold;">패키지 A</td>
                    <td>인터넷 메인A</td>
                    <td rowspan="2">4개사</td>
                    <td rowspan="2">500X370</td>
                    <td rowspan="2">500만원</td>
                    <td rowspan="2">1개</td>
                </tr>
                <tr><td>Herald 앞표지</td></tr>
                <tr>
                    <td rowspan="2" style="background:#EDEFDE; font-weight:bold;">패키지 B</td>
                    <td>인터넷 메인B</td>
                    <td rowspan="2">10개사</td>
                    <td rowspan="2">500X370</td>
                    <td rowspan="2">400만원</td>
                    <td rowspan="2">1개</td>
                </tr>
                <tr><td>Herald 앞표지</td></tr>
            </tbody>
        </table>
        <p style="margin-top:10px;"><strong>※ CM Herald 뒤표지(A4 전면)광고는 1회 100만원임.</strong></p>

        <div style="margin-top:12px; padding:12px 16px; background:#f6f9fc; border-radius:6px;">
            <a href="/cmak/legacy/upload/data/banner.pdf"><strong>📎 인터넷 광고신청서</strong></a>
        </div>
    </div>

    <h2 class="sub-content-title">· 객원기자 활동</h2>
    <div class="sub-section">
        <p style="line-height:1.9; margin-bottom:14px;">
            우리 협회는 보다 많은 자료 및 정보를 수집·보급하기 위하여 객원기자 15인을 위촉하여 활동케 함으로써 보다 나은 CM Herald를 발간하고자 노력하고 있습니다.
        </p>
        <ul style="padding-left:22px; line-height:2;">
            <li><a href="/cmak/legacy/html/business/bcmherald_pop.asp" target="_blank">객원기자 소개</a></li>
            <li><a href="/cmak/legacy/html/business/bcmherald2_pop.asp" target="_blank">객원기자 모집 안내</a></li>
            <li><a href="/cmak/legacy/html/business/bcmherald3_pop.asp" target="_blank">객원기자 신청</a></li>
        </ul>

        <h3 class="sub-section-title" style="margin-top:20px;">명예기자</h3>
        <ul style="padding-left:22px; line-height:2;">
            <li>제1기 명예기자 (2005.03.01 ~ 2007.02.28)</li>
            <li>제2기 명예기자 (2007.03.01 ~ 2009.02.28)</li>
            <li>제3기 명예기자 (2009.03.01 ~ 2011.02.28)</li>
        </ul>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>관련문의</dt>
        <dd>운영지원본부 &nbsp;☎&nbsp; 070-7510-1226 / 02-585-7092</dd>
    </div>
</div>
@endsection
