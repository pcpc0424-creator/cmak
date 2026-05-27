@extends('layouts.sub')

@section('title', 'CM실적 관리 및 확인서 발급 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/confirm')
@section('page-title', 'CM실적 관리 및 확인서 발급')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">· CM실적 관리 및 확인서 발급</h2>
    <p class="sub-content-desc">
        우리 협회에서는 건설사업관리용역의 내용 및 실적에 대해서 발주자나 건설사업관리용역 수행자의 요청이 있는 경우
        그의 내용 및 실적에 대한 확인서 발급업무를 하고 있습니다.
    </p>

    <div class="sub-section">
        <h3 class="sub-section-title" style="color:#339999;">- 관련규정</h3>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>건설산업기본법 제2조제8호 및 제9호(건설사업관리 및 시공책임형 건설사업관리 정의)</li>
            <li>건설산업기본법 제23조의2(건설사업관리능력의 평가 및 공시)</li>
            <li>건설기술진흥법 제39조(건설사업관리 등의 시행)</li>
            <li>국토교통부장관의 위탁업무 수행기관 등 지정
                <div style="padding-left:10px; color:#666; font-size:13px;">
                    (국토교통부 고시 제2014-445호, 2014.7.17 / 제2008-785호, 2008.12.29.)
                </div>
            </li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">1. CM용역수행실적확인서 발급 절차</h3>
        <div style="text-align:center; margin:20px 0;">
            <img src="/cmak/images/business/confirm-flow.gif" alt="실적확인 신청서 FAX(02-585-2689) 제출 → 수수료 온라인 입금(KEB하나은행 064-22-00743-0) → 신청서 접수 및 심사 → 확인서 발급" style="max-width:100%;">
        </div>
        <div style="margin-top:14px; display:flex; gap:16px; flex-wrap:wrap; align-items:center; padding:14px; background:#f6f9fc; border-radius:6px;">
            <a href="/cmak/legacy/upload/data/건설사업관리용역내용확인신청서.hwp" style="font-weight:600;">
                📎 건설사업관리용역 실적확인 신청서 (HWP)
            </a>
            <a href="http://www.g4b.go.kr/svc/bcs/ptu/pul/Login.do" target="_blank" rel="noopener noreferrer" style="font-weight:600; color:#0061c2;">
                ▶ G4B 실적확인서 발급
            </a>
            <a href="/cmak/legacy/html/business/온라인%20CM실적확인서%20사용자매뉴얼.pdf" target="_blank" rel="noopener noreferrer" style="font-weight:600;">
                📄 G4B 실적확인서 매뉴얼 다운로드
            </a>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">2. 작성요령</h3>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>용역개요는 개조식으로 주요사업개요 및 과업내용을 요약 기입.<br>
                <span style="color:#666;">&nbsp;&nbsp;&nbsp;※ 주상복합인 경우 주거 부문 면적과 주거외 부문 면적 기입.</span>
            </li>
            <li>총 용역금액 및 기성액은 천원 단위로 기입.</li>
            <li>용역기간 및 계약일은 년월일 까지 기입.</li>
        </ol>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">3. 신규 실적확인 구비서류</h3>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>건설사업관리용역내용 확인 신청서 1부(법인도장 날인) Fax(02-585-2689) 제출.</li>
            <li>발주자 기성실적증명서 원본 1부(기성금액변경시 제출)</li>
            <li>사업개요를 확인 할 수 있는 서류 (건축허가서 또는 사업계획서)</li>
            <li>진행중인 사업이 완료되었을 경우<br>
                <span style="color:#666;">&nbsp;&nbsp;&nbsp;(건축물 대장 또는 사용승인서 1부, 준공필증(확인서) 1부, 기성실적 완납증명서 원본 1부)</span>
            </li>
        </ol>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">4. 변경계약 실적확인 구비서류</h3>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>건설사업관리용역내용 확인 신청서 1부(법인도장 날인) Fax(02-585-2689) 제출</li>
            <li>변경계약서 제출(변경된 계약금액 통상회비 납부)</li>
            <li>변경 후 기성실적증명서 제출</li>
        </ol>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">5. CM용역수행실적확인 수수료</h3>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>◆ 발급 수수료 : 50,000원</li>
            <li>◆ 납부계좌번호 : KEB하나은행 064-22-00743-0 (예금주 : 한국건설관리협회)</li>
        </ul>
    </div>

    <hr style="margin:36px 0; border:none; border-top:1px solid #e5e8ee;">

    <h2 class="sub-content-title">· 실적확인서 온라인 발급서비스 이용시 유의사항</h2>

    <div class="sub-section">
        <h3 class="sub-section-title">G4B 회원가입 및 기관회원 가입</h3>
        <div style="margin-bottom:14px;">
            <a href="http://www.g4b.go.kr/svc/bcs/ptu/pul/Login.do" target="_blank" rel="noopener noreferrer" style="display:inline-block; padding:10px 18px; background:#0061c2; color:white; border-radius:4px; text-decoration:none; font-weight:600;">G4B 바로가기</a>
            <a href="/cmak/legacy/html/business/온라인%20CM실적확인서%20사용자매뉴얼.pdf" target="_blank" rel="noopener noreferrer" style="display:inline-block; margin-left:6px; padding:10px 16px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:4px; text-decoration:none; color:#0061c2; font-weight:600;">📄 G4B 실적확인서 매뉴얼</a>
        </div>
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

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>관련문의</dt>
        <dd>사업지원본부 &nbsp;☎&nbsp; 02-585-4712~4</dd>
    </div>
</div>
@endsection
