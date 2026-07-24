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

    <div class="sub-section">
        <h3 class="sub-section-title">회원구분</h3>
        <div style="display:flex; gap:16px; flex-wrap:wrap;">
            <div style="flex:1; min-width:240px; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;">
                <div style="background:#0061c2; color:#fff; padding:11px 16px; font-weight:700; font-size:15px;">일반회원</div>
                <div style="padding:16px; line-height:1.75; color:#444; font-size:14px;">건설산업기본법 제2조 제8호 및 제9호의 규정에 의한 건설사업관리 업으로 영위하고자 하는 자</div>
            </div>
            <div style="flex:1; min-width:240px; border:1px solid #e2e8f0; border-radius:8px; overflow:hidden;">
                <div style="background:#3FA6B9; color:#fff; padding:11px 16px; font-weight:700; font-size:15px;">특별회원</div>
                <div style="padding:16px; line-height:1.75; color:#444; font-size:14px;">협회의 목적과 사업에 찬동하는 일반회원 이외의 자</div>
            </div>
        </div>
        <div style="margin-top:14px;">
            <a href="/cmak/intro/members" style="display:inline-block; padding:8px 16px; background:#0061c2; color:#fff; border-radius:4px; text-decoration:none; font-size:13px; font-weight:600;">회원현황 보기 ›</a>
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">입회절차</h3>
        <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap; margin-top:8px;">
            @foreach([
                '입회원서 작성·제출',
                '입회원서 접수·통보',
                '입·연회비 납부',
                '회원증 교부',
            ] as $i => $step)
                @if($i > 0)
                    <span style="color:#0061c2; font-weight:700; font-size:18px; line-height:1;">›</span>
                @endif
                <div style="flex:1; min-width:120px; text-align:center; padding:16px 10px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:8px;">
                    <div style="display:inline-flex; align-items:center; justify-content:center; width:28px; height:28px; margin-bottom:8px; background:#0061c2; color:#fff; border-radius:50%; font-size:13px; font-weight:700;">{{ $i + 1 }}</div>
                    <div style="font-size:14px; color:#333; font-weight:600; line-height:1.4;">{{ $step }}</div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">입회원서</h3>
        <div style="border:1px solid #dde3ed; border-radius:8px; padding:24px; max-width:640px; margin:0 auto;">
            <h4 style="text-align:center; font-size:18px; color:#0061c2; margin-bottom:18px;">일반회원 입회원서</h4>
            <table style="width:100%; border-collapse:collapse; font-size:14px;">
                <tbody>
                    <tr>
                        <th style="width:18%; padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">① 명칭</th>
                        <td style="width:32%; padding:10px; border:1px solid #e2e8f0;"></td>
                        <th style="width:18%; padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">② 전화번호</th>
                        <td style="width:32%; padding:10px; border:1px solid #e2e8f0;"></td>
                    </tr>
                    <tr>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">③ 페이지</th>
                        <td style="padding:10px; border:1px solid #e2e8f0;"></td>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">④ 팩스번호</th>
                        <td style="padding:10px; border:1px solid #e2e8f0;"></td>
                    </tr>
                    <tr>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">⑤ 소재지</th>
                        <td colspan="3" style="padding:10px; border:1px solid #e2e8f0;"></td>
                    </tr>
                    <tr>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">⑥ 대표자</th>
                        <td style="padding:10px; border:1px solid #e2e8f0;"></td>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">⑦ 주민등록번호</th>
                        <td style="padding:10px; border:1px solid #e2e8f0;"></td>
                    </tr>
                    <tr>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">⑧ 업종 등</th>
                        <td style="padding:10px; border:1px solid #e2e8f0;"></td>
                        <th style="padding:10px; border:1px solid #e2e8f0; background:#f6f9fc; text-align:left; font-weight:600;">⑨ 면허등의 취득일</th>
                        <td style="padding:10px; border:1px solid #e2e8f0;"></td>
                    </tr>
                </tbody>
            </table>
            <p style="margin-top:16px; font-size:13px; color:#555; text-align:center;">정관 제5조 및 제6조의 규정에 의하여 귀 협회의 회원이 되고자 입회원을 제출합니다.</p>
            <div style="margin-top:18px; text-align:right; font-size:14px; line-height:2;">
                20&nbsp;&nbsp;&nbsp;년&nbsp;&nbsp;&nbsp;월&nbsp;&nbsp;&nbsp;일<br>
                제출인명칭 : ________________<br>
                대표자 : ________________ (인)
            </div>
            <p style="margin-top:18px; font-size:17px; font-weight:700; color:#333;">한국CM협회장 귀하</p>
        </div>
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
