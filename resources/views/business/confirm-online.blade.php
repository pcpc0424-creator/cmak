@extends('layouts.sub')

@section('title', '온라인 CM실적확인서 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/confirm-online')
@section('page-title', '온라인 CM실적확인서')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">· G4B회원가입 및 기관회원가입</h2>
    <div style="margin-bottom:20px;">
        <a href="http://www.g4b.go.kr/svc/bcs/ptu/pul/Login.do" target="_blank" style="display:inline-block; padding:10px 18px; background:#0061c2; color:white; border-radius:4px; text-decoration:none; font-weight:600;">G4B 바로가기</a>
    </div>

    <div class="sub-section">
        <ol style="padding-left:24px; line-height:2;">
            <li>온라인 CM실적확인서를 신청하기 위해서는 G4B 회원가입 후 한국CM협회 기관회원 가입을 하여야 합니다.</li>
            <li>기존에 협회에 신고한 실적들 이외 신규실적과 변경사항들의 증빙서류를 제출하여야 합니다.<br>
                <span style="color:#666;">- 기존실적 변경 및 신규실적 포함시 해당됨.</span>
            </li>
            <li>발급기관에서 한국CM협회를 선택하여 실적확인서 신청정보를 입력 후 신청합니다. 실적확인서를 신청하기 위해서는 법인공인인증서 인증을 받아야 합니다.</li>
            <li>실적확인서 신청시 발급수수료를 계좌이체로 납부하여야 합니다.</li>
            <li>신청하신 실적확인서는 실적확인서 발급조회 메뉴에 들어가시면 발급상태를 확인하실 수 있습니다.<br>
                <span style="color:#666;">- 발급수수료 입금확인시 출력가능상태로 변경됨</span>
            </li>
            <li>발급이 완료된 실적확인서는 사용하시는 프린터를 이용하여 출력할 수 있습니다.</li>
        </ol>
        <p style="margin-top:12px;">※ 오프라인으로도 기존과 동일하게 발급 가능함.</p>
    </div>

    <h2 class="sub-content-title">· 온라인 CM실적확인서 사용자매뉴얼</h2>
    <div style="margin-bottom:20px;">
        <a href="/cmak/legacy/html/business/온라인%20CM실적확인서%20사용자매뉴얼.pdf" target="_blank" style="display:inline-block; padding:8px 16px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:4px; text-decoration:none; color:#0061c2; font-weight:600;">📄 사용자매뉴얼 다운로드</a>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">1. 회원가입</h3>
        <p>우측 상단 <span style="color:#0000FF;">"회원가입"</span> 버튼을 클릭합니다.</p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">2. 로그인 및 실적확인서 신청</h3>
        <p>G4B 기업지원플러스(<a href="http://www.g4b.go.kr" target="_blank" style="color:#0000FF;">http://www.g4b.go.kr</a>) 로그인 &gt; 상단메뉴 <span style="color:#0000FF;">"시험·인증·실적 &gt; 실적"</span></p>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>관련문의</dt>
        <dd>사업지원본부 &nbsp;☎&nbsp; 02-585-4712~4</dd>
    </div>
</div>
@endsection
