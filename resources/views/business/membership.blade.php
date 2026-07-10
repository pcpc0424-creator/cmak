@extends('layouts.sub')

@section('title', '일반·특별회원 가입 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/membership')
@section('page-title', '일반·특별회원 가입')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">일반·특별회원 가입 안내</h2>

    <div class="sub-section" style="text-align:center;">
        <img src="/cmak/images/business/membership/member_type.png" alt="회원구분" style="max-width:100%; margin-bottom:20px;">
    </div>

    <div class="sub-section" style="text-align:center;">
        <img src="/cmak/images/business/membership/join_process.png" alt="입회절차" style="max-width:100%; margin-bottom:20px;">
    </div>

    <div class="sub-section" style="text-align:center;">
        <img src="/cmak/images/business/membership/join_form.png" alt="입회원서" style="max-width:600px; width:100%; margin-bottom:20px;">
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">제출서류</h3>
        <ol style="padding-left:22px; line-height:2;">
            <li>입회원서 1부</li>
            <li>업면허증·신고필증·엔지니어링활동주체 회원수첩 사본 1부</li>
            <li>법인등기부등본·사업자등록증 사본 (개인의 경우에는 사업자등록증 사본 또는 주민등록등본) 1부</li>
            <li>재무제표 중 손익계산서 사본 1부</li>
            <li>대표자 이력서 1부</li>
        </ol>
        <div style="margin-top:12px; padding:12px 16px; background:#f6f9fc; border-radius:6px; font-size:13px;">
            <strong>관련자료</strong> &nbsp;
            <a href="/cmak/legacy/upload/data/session.hwp" target="_blank" rel="noopener noreferrer">입회원서</a> &nbsp;|&nbsp;
            <a href="/cmak/legacy/upload/data/guidebook.pdf" target="_blank" rel="noopener noreferrer">협회활동현황</a> &nbsp;|&nbsp;
            <a href="/cmak/legacy/upload/data/회비규정.pdf" target="_blank" rel="noopener noreferrer">회비규정</a> &nbsp;|&nbsp;
            <a href="/cmak/legacy/upload/data/2012_CMAK정관.pdf" target="_blank" rel="noopener noreferrer">정관</a> &nbsp;|&nbsp;
            <a href="/cmak/legacy/upload/data/CMAK2.jpg" target="_blank" rel="noopener noreferrer">입금통장사본</a>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">회비 부과기준</h3>

        <h4 style="margin-top:10px; margin-bottom:8px; color:#0061c2; font-size:15px;">■ 시공능력평가액 기준</h4>
        <ul style="padding-left:22px; line-height:2;">
            <li>시공능력평가액이 5조원 이상인 경우 : 1,000만원</li>
            <li>시공능력평가액이 1조원 이상 5조원 미만인 경우 : 600만원</li>
            <li>시공능력평가액이 5천억원 이상 1조원 미만인 경우 : 500만원</li>
            <li>시공능력평가액이 1천억원 이상 5천억원 미만인 경우 : 400만원</li>
            <li>시공능력평가액이 1천억원 미만인 경우 : 300만원</li>
        </ul>

        <h4 style="margin-top:20px; margin-bottom:8px; color:#0061c2; font-size:15px;">■ 매출액 기준</h4>
        <ul style="padding-left:22px; line-height:2;">
            <li>매출액이 1,000억원 이상인 경우 : 400만원</li>
            <li>매출액이 700억원 이상 1,000억원 미만인 경우 : 350만원</li>
            <li>매출액이 500억원 이상 700억원 미만인 경우 : 300만원</li>
            <li>매출액이 300억원 이상 500억원 미만인 경우 : 250만원</li>
            <li>매출액이 100억원 이상 300억원 미만인 경우 : 200만원</li>
            <li>매출액이 100억원 미만인 경우 : 150만원</li>
        </ul>
        <p style="color:#3FA6B9; font-weight:bold; margin-top:8px;">
            ※ 시공능력평가액과 매출액은 부과기준일의 최근치로 하되, 시공능력평가액이나 매출액이 없는 경우에는 영업용자산평가액으로 함.
        </p>

        <h4 style="margin-top:20px; margin-bottom:8px; color:#0061c2; font-size:15px;">■ 특별회비</h4>
        <ul style="padding-left:22px; line-height:2;">
            <li>법인은 입회비 100만원 연회비 100만원으로 하고,</li>
            <li>개인은 입회비 5만원 연회비 5만원으로 함.</li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">입회금</h3>
        <p>
            &nbsp;&nbsp;◆ 연도별 건설사업관리업무위탁계약금액의 1,000분의 1에 해당하는 금액을 부과하며,<br>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;그 부과금액은 5,000만원을 초과하지 아니한다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">계좌번호</h3>
        <p>
            &nbsp;&nbsp;◆ 계좌번호 : KEB하나은행 182-910007-92604<br>
            &nbsp;&nbsp;◆ 예 금 주 : 한국건설관리협회
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">특별회원의 제한사항</h3>
        <ul style="padding-left:22px; line-height:2;">
            <li>특별회원(대의원은 제외함)은 아래 항목의 권리를 갖지 못한다.</li>
            <li>정관 및 협회 제 규정에 의하여 선임되는 자의 선거권 및 피선거권.</li>
            <li>총회에 출석하여 발언하고 표결.</li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">회원의 의무</h3>
        <ul style="padding-left:22px; line-height:2;">
            <li>회원의 품위보전.</li>
            <li>정관 및 관련규정의 준수.</li>
            <li>회비납부.</li>
            <li>기타 이사회나 총회에서 결정된 사항의 준수.</li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">회원의 혜택</h3>
        <ul style="padding-left:22px; line-height:2;">
            <li>CM시장 진출기반 선점·구축.(발주정보교환, 의견제시 등 참여 활동, 애로사항 공동 대응.)</li>
            <li>회원 상호간, 지역간 정보교환 및 협력활동 기회 확대로 업무영역 확대도모.</li>
            <li>정부의 CM시책 및 각종 정보선점으로 미래 예측 및 진로 모색.</li>
            <li>CM업체로서의 신뢰성 및 대외 이미지 제고.</li>
            <li>발주기관 PQ심사에 필요한 CM실적확인서 발급.</li>
            <li>CM Herald 정기구독 및 각종 정보 자료의 공유.</li>
            <li>CM Herald와 협회 사이트를 통한 홍보.</li>
        </ul>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>관련문의</dt>
        <dd>운영지원본부 &nbsp;☎&nbsp; 070-7510-1226 / 02-585-7092</dd>
    </div>
</div>
@endsection
