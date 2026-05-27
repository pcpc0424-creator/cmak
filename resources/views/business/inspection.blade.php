@extends('layouts.sub')

@section('title', '건설사업관리사자격검정 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/inspection')
@section('page-title', '건설사업관리사자격검정')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    {{-- 자격검정 운영 취지 및 안내 --}}
    <div style="margin-bottom:24px; padding:18px 20px; background:#FBFBF3; border:1px solid #D8D5BB; border-radius:6px;">
        <p style="margin:0 0 10px 0; line-height:1.8;">
            우리 협회는 건설사업관리관련 인력의 적정한 자격제도 확립과 건설사업관리사의 자질 및 사회적
            지위 향상을 도모하고 나아가 건설산업의 발전에 기여하기 위하여 건설사업관리사자격검정을
            시행하고 있습니다.
        </p>
        <p style="margin:0; line-height:1.8; color:#0061c2;">
            본 자격은 자격기본법 제17조의 규정에 의한 민간자격으로, 국가로부터 인정받은 공인자격은 아닙니다.<br>
            <strong>등록번호 : 2008-0397</strong>
        </p>
    </div>

    <h2 class="sub-content-title">· 시험과목</h2>
    <div class="sub-section">
        <table class="sub-table" style="text-align:center;">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th style="width:100px;">구분</th>
                    <th>시험과목</th>
                    <th>비고</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="4" style="background:#EDEFDE; font-weight:bold; border-bottom:2px solid #bbb;">1차<br>필기시험</td>
                    <td style="text-align:left;">건설사업관리 개론</td>
                    <td rowspan="10" style="text-align:left; vertical-align:middle;">
                        <strong>자격검정 면제대상</strong><br>
                        회장이 정하는 전문자격을 가진 자로서<br>
                        3년 이상 실무경력이 있는 자의 경우<br><br>
                        - 건설사업관리 개론<br>
                        (필기시험 7개 과목 면제)<br>
                        ※ 세부사항은 응시자격란 참조
                    </td>
                </tr>
                <tr><td style="text-align:left;">건설계약 및 클레임관리</td></tr>
                <tr><td style="text-align:left;">건설사업의사결정 및 위험관리</td></tr>
                <tr><td style="text-align:left; border-bottom:2px solid #bbb;">건설정보 및 문서관리</td></tr>
                <tr>
                    <td rowspan="4" style="background:#EDEFDE; font-weight:bold; border-bottom:2px solid #bbb;">2차<br>필기시험</td>
                    <td style="text-align:left;">경제성공학 및 사업비관리</td>
                </tr>
                <tr><td style="text-align:left;">공정계획 및 관리</td></tr>
                <tr><td style="text-align:left;">품질관리 및 경영</td></tr>
                <tr><td style="text-align:left; border-bottom:2px solid #bbb;">건설안전 및 환경관리</td></tr>
                <tr>
                    <td rowspan="2" style="background:#EDEFDE; font-weight:bold;">면접시험</td>
                    <td style="text-align:left;">건설사업관리에 대한 전문성</td>
                </tr>
                <tr><td style="text-align:left;">인성 및 표현능력</td></tr>
            </tbody>
        </table>
        <p style="margin-top:10px;">※ 시험과목의 세부 평가항목은 자격검정 시행공고문 참조</p>
    </div>

    <h2 class="sub-content-title">· 평가항목 및 참고서적</h2>
    <div class="sub-section">
        <p style="line-height:1.9;">
            시험 평가항목과 참고서적은 매년 발표되는 <strong>건설사업관리사자격검정 시행계획 공고</strong>에 포함되어 있습니다.
            응시 전 반드시 해당 공고문을 확인하시기 바랍니다.
        </p>
        <div style="margin-top:10px; padding:14px 16px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:4px;">
            <a href="/cmak/legacy/upload/data/2026년도건설사업관리사자격검정시행계획공고.pdf" target="_blank" rel="noopener noreferrer"
               style="display:inline-block; padding:8px 16px; background:#0061c2; color:#fff; border-radius:4px; text-decoration:none; font-weight:600; font-size:13px;">
                📄 2026년도 자격검정 시행계획 공고 (시험 평가항목·참고서적 포함)
            </a>
        </div>
    </div>

    <h2 class="sub-content-title">· 검정기준·방법</h2>
    <div class="sub-section">
        <table class="sub-table" style="text-align:center;">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th colspan="2">구분</th>
                    <th>검정기준</th>
                    <th>검정방법</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2" style="background:#EDEFDE; font-weight:bold;">필기<br>시험</td>
                    <td style="background:#FBFBF3;">1차과목</td>
                    <td rowspan="2" style="text-align:left;">건설사업관리에 대한 전문지식과 실무경험에 따라 건설사업관리 업무를 행할 수 있는 능력을 평가</td>
                    <td style="text-align:left;">객관식(4지선다형 또는 5지선다형), OX문제</td>
                </tr>
                <tr>
                    <td style="background:#FBFBF3;">2차과목</td>
                    <td style="text-align:left;">객관식(4지선다형 또는 5지선다형), OX문제 또는 주관식(서술형 또는 단답형), 객관식/주관식 혼합형</td>
                </tr>
                <tr>
                    <td colspan="2" style="background:#EDEFDE; font-weight:bold;">면접시험</td>
                    <td style="text-align:left;">표현능력·인성·전문성 등의 유무</td>
                    <td style="text-align:left;">구술형<br>※ 1차·2차 필기시험합격자에 한하여 실시.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <h2 class="sub-content-title">· 응시자격</h2>
    <div class="sub-section">
        <table class="sub-table">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th style="width:110px; text-align:center;">구분</th>
                    <th>응시자격</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background:#EDEFDE; text-align:center; font-weight:bold;">건설사업관리사</td>
                    <td>
                        <ul style="padding-left:22px; line-height:1.9; margin:0;">
                            <li>관련분야의 석사학위 취득 후 2년 이상, 학사학위 취득 후 4년 이상, 전문대학 졸업 후 6년 이상, 고등학교 졸업 후 8년 이상 그 분야에 실무경력이 있는 자</li>
                            <li>관련분야의 박사학위를 취득한 자</li>
                            <li>관련분야의 기사 자격 취득 후 3년 이상, 산업기사자격 취득 후 4년 이상 그 분야에 실무경력이 있는 자</li>
                            <li>건축사법에 따른 건축사 또는 기술사법에 따른 기술사</li>
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; text-align:center; font-weight:bold;">자격검정<br>면제대상</td>
                    <td>
                        다음 각 목의 1에 해당하는 자격을 갖춘 자
                        <ol style="padding-left:22px; line-height:1.9; margin:6px 0 0 0;">
                            <li>변호사법 제4조에 따라 자격을 취득한 변호사</li>
                            <li>공인회계사법 제3조에 따라 자격을 취득한 공인회계사</li>
                            <li>세무사법 제3조에 따라 자격을 취득한 세무사</li>
                            <li>감정평가 및 감정평가사에 관한 법률 제11조에 따라 자격을 취득한 감정평가사</li>
                            <li>변리사법 제3조에 따라 자격을 취득한 변리사</li>
                            <li>법무사법 제4조에 따라 자격을 취득한 법무사</li>
                            <li>행정사법 제5조에 따라 자격을 취득한 행정사</li>
                            <li>공인노무사법 제3조에 따라 자격을 취득한 공인노무사</li>
                        </ol>
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top:12px; padding:14px; background:#FBFBF3; border:1px solid #C0C0C0; border-radius:4px;">
            <p style="margin:0 0 8px 0;"><strong>※ 비고</strong></p>
            <p style="margin:0 0 8px 0;">1) 건설사업관리사는 단일등급이며 직무내용은 건설사업관리에 대한 지식을 활용하여 건설기술진흥법 시행령 별표1에 따른 각 전문분야별 직무와 건설지원(세무/회계/금융/노무/법무 등) 업무를 수행하는 것을 말한다.</p>
            <p style="margin:0;">2) 응시자격란의 "관련분야" 또는 "그 분야"란 건설사업관리관련 경력을 말하며, 자격검정 면제대상의 실무경력이란 각 호의 전문자격 분야의 경력을 말한다.</p>
        </div>
    </div>

    <h2 class="sub-content-title">· 등록</h2>
    <div class="sub-section">
        <div style="padding:14px; background:#FBFBF3; border:1px solid #C0C0C0; border-radius:4px;">
            <ul style="padding-left:22px; line-height:1.9; margin:0;">
                <li><strong>자격검정에 합격한 자</strong>는 합격한 날부터 <u><strong>90일 이내에 직무교육을 70시간 이상 이수</strong></u>하고 등록을 하여야 한다. 다만, 최종 합격일로부터 최근 3년 이내에 70시간 이상 직무교육을 이수한 자는 직무교육을 이수하지 않고 등록할 수 있다.</li>
                <li><strong>직무교육 인정범위</strong>
                    <ul style="padding-left:20px; margin-top:6px;">
                        <li><strong>교육기관 및 과정 :</strong> <u><span style="color:#FF0000;"><strong>건설기술교육원과 한국기술사회</strong></span></u>의 건설사업관리전문교육 또는 건설사업관리전문가교육 (온라인교육 포함)</li>
                        <li><strong>교육이수 인정기간 :</strong> 자격검정에 합격한 날부터 90일 이내 (또는 자격검정에 합격한 날 이전 최근 3년 이내)</li>
                        <li><strong>교육이수 시간 :</strong> 70시간</li>
                    </ul>
                </li>
            </ul>
        </div>
        <p style="margin-top:12px;">※ <u style="color:#FF0000; font-weight:bold;">해당 교육기관 외의 교육은 직무교육으로 인정되지 않습니다.</u> 자격시험 응시 전 응시자 본인의 응시자격을 반드시 확인하시기 바랍니다.</p>
        <p>※ 자격검정 관련 세부사항은 건설사업관리사자격관리운영규정 및 동 규정 시행세칙을 참고하여 주시기 바랍니다.</p>

        <div style="margin-top:14px; padding:12px 16px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:4px;">
            <strong style="color:#0061c2;">▶ 교육인정기관 바로가기</strong>
            <div style="margin-top:8px; display:flex; gap:8px; flex-wrap:wrap;">
                <a href="https://www.kicte.or.kr/" target="_blank" rel="noopener noreferrer"
                   style="padding:6px 14px; background:#0061c2; color:#fff; border-radius:20px; text-decoration:none; font-size:13px;">건설기술교육원</a>
                <a href="https://www.kpea.or.kr/" target="_blank" rel="noopener noreferrer"
                   style="padding:6px 14px; background:#339999; color:#fff; border-radius:20px; text-decoration:none; font-size:13px;">한국기술사회</a>
            </div>
        </div>
    </div>

    <h2 class="sub-content-title">· 관련 서식</h2>
    <div class="sub-section">
        <ul style="padding-left:22px; line-height:2;">
            <li><a href="/cmak/legacy/upload/data/240604_건설사업관리사자격관리운영규정_최종.hwp">건설사업관리사자격관리운영규정 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/240604_건설사업관리사자격관리운영규정시행세칙_최종.hwp">건설사업관리사자격관리운영규정 시행세칙 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/자격검정원서.hwp">자격검정 원서 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/2026년도건설사업관리사자격검정시행계획공고.pdf" target="_blank">2026년도 건설사업관리사자격검정 시행계획 공고 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/건설사업관리사자격검정수검포기원.hwp">건설사업관리사자격검정 수검포기원 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/별지8-별지10응시자격확인서류제출.hwp">[별지8-별지10] 응시자격 확인서류 제출 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/[별지11]건설사업관리사(갱신)등록신청서.hwp">[별지11] 건설사업관리사(갱신) 등록신청서 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/별지4건설사업관리사자격증(자격수첩)재교부신청서.hwp">[별지4] 건설사업관리사 자격증(자격수첩) 재교부신청서 (내려받기)</a></li>
            <li><a href="/cmak/legacy/upload/data/직무교육연기신청서서식.hwp">직무교육 연기신청서 서식 (내려받기)</a></li>
        </ul>
    </div>

    <h2 class="sub-content-title">· 원서접수</h2>
    <div class="sub-section">
        <ul style="padding-left:22px; line-height:1.9;">
            <li>접수기간내에 응시원서를 작성하여 접수처에 직접 제출(이메일 또는 우편 접수 가능)
                <div style="padding-left:10px; color:#666;">※ 우편으로 접수할 경우 등기로 우송하되 접수마감일자의 우체국 소인이 찍혀있는 것까지만 유효함.</div>
            </li>
            <li>접 수 처 : (06673) 서울특별시 서초구 서초대로 88, 유니온빌딩 4층.
                <div style="padding-left:10px; color:#666;">※ 지하철7호선 내방역 ④번출구에서 직진 100m.</div>
            </li>
        </ul>
    </div>

    <h2 class="sub-content-title">· 응시료</h2>
    <div class="sub-section">
        <p><strong>총 비용 (자격증 발급 수수료 제외)</strong></p>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>◆ 건설사업관리사 : 300,000원
                <ul style="padding-left:20px;">
                    <li>1차 필기시험 : 160,000원</li>
                    <li>2차 필기시험 : 140,000원</li>
                </ul>
            </li>
            <li>◆ 자격검정 면제 : 160,000원
                <ul style="padding-left:20px;">
                    <li>1차 필기시험 : 160,000원 (* 단, 제9조제3항 단서에 따른 필기시험의 경우: 250,000원)</li>
                </ul>
            </li>
            <li>◆ 면접비의 경우, 면접시험 공고에 함께 게시될 예정.</li>
            <li>◆ 자격발급비 : 합격자 최초발급에 한하여 무료.</li>
            <li>◆ 납부계좌번호 : KEB하나은행 064-22-00743-0 (예금주 : 한국건설관리협회)</li>
        </ul>
    </div>

    <h2 class="sub-content-title">· 재발급 안내</h2>
    <div class="sub-section">
        <ul style="padding-left:22px; line-height:1.9;">
            <li>자격증 또는 자격수첩의 <strong>재교부</strong>를 받거나 자격을 <strong>갱신</strong>하고자 하는 경우 : <strong>각 20,000원</strong> (국문, 영문 별도)</li>
            <li>재교부 신청 서식 : <a href="/cmak/legacy/upload/data/별지4건설사업관리사자격증(자격수첩)재교부신청서.hwp" style="color:#0061c2;">[별지4] 건설사업관리사 자격증(자격수첩) 재교부신청서</a></li>
            <li>갱신 등록 서식 : <a href="/cmak/legacy/upload/data/[별지11]건설사업관리사(갱신)등록신청서.hwp" style="color:#0061c2;">[별지11] 건설사업관리사(갱신) 등록신청서</a></li>
            <li>제출 및 문의 : 정책사업본부 <strong>☎ 070-7510-3090 / 070-7510-1227</strong>, 팩스 02-585-2689</li>
            <li>납부계좌번호 : KEB하나은행 064-22-00743-0 (예금주 : 한국건설관리협회)</li>
        </ul>
    </div>

    <h2 class="sub-content-title">· 접수취소·환불</h2>
    <div class="sub-section">
        <h4 style="margin-top:10px;"><strong>1. 접수취소 방법</strong></h4>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>건설사업관리사자격검정응시포기원 및 본인 통장사본 제출</li>
            <li>제출 및 문의 : 정책사업본부 <strong>☎ 070-7510-3090 / 070-7510-1227</strong>, <strong>팩스 02-585-2689</strong></li>
        </ul>

        <h4 style="margin-top:20px;"><strong>2. 환불기준 (1차, 2차 시험 규정 동일)</strong></h4>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>접수기간내 접수를 취소하는 경우 : 100% 환불 (마감일 18:00까지)</li>
            <li>접수마감일 다음날로부터 시행일 5일전 18:00까지 취소하는 경우 : 50% 환불 (10원단위 절사)</li>
        </ul>

        <table class="sub-table" style="text-align:center; margin-top:12px;">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th>구분</th>
                    <th>접수기간 중</th>
                    <th>접수기간 후</th>
                    <th colspan="4">시험시행 4일전</th>
                    <th>시험당일</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold;">적용기간</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>4일</td>
                    <td>3일</td>
                    <td>2일</td>
                    <td>1일</td>
                    <td>필기시험</td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold;">환불적용률</td>
                    <td>취소시<br>환불 100%</td>
                    <td>취소시<br>환불 50%</td>
                    <td colspan="5" style="color:#FF0000; font-weight:bold;">환불 및 취소 불가</td>
                </tr>
            </tbody>
        </table>

        <ul style="padding-left:22px; line-height:1.9; margin-top:12px;">
            <li>※ 취소 후 환불되기까지 <span style="color:#339999; font-weight:bold;">약 2~7일 정도 소요</span>됩니다.</li>
            <li>※ 접수마감일 다음날로부터 시행일 5일전 18:00까지 취소하는 경우 : 50% 환불 (10원단위 절사) 환불금액은 본인계좌로 입금되며 별도로 통보되지 않습니다.</li>
            <li>※ 환불 및 취소불가 예외적용 : 직계가족 사망, 본인의 사고 또는 질병으로 입원한 자에 대해 검정수수료의 50% 환불</li>
            <li>◆ 환불 및 취소불가 예외적용 대상 : 직계가족(본인 또는 배우자의 부모, 조부모, 형제, 자매, 배우자, 자녀에 한함) 사망자, 본인의 사고 또는 질병으로 입원한 자</li>
            <li>◆ 기간 및 방법 : 수험자 시험일 기준 30일 이내, 건설사업관리사자격검정시험 응시포기원과 본인 통장사본, 입증서류를 첨부하여 협회 정책사업본부로 방문 또는 팩스신청</li>
            <li>◆ 제출처 : 정책사업본부 <strong>☎ 070-7510-3090 / 070-7510-1227</strong>, <strong>팩스 02-585-2689</strong></li>
            <li>◆ 입증서류</li>
        </ul>

        <table class="sub-table" style="text-align:center; margin-top:12px;">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th>직계가족 등 사망</th>
                    <th>본인 사고 및 질병에 의한 입원</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>본인과의 가족관계 입증서류<br>(주민등록 등본, 가족관계증명서 등)</td>
                    <td>입원을 입증하는 서류<br>(입원 확인서 등)</td>
                </tr>
                <tr>
                    <td>사망 입증서류 (사망진단서 등)</td>
                    <td>신분증</td>
                </tr>
                <tr>
                    <td>신분증</td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
        </table>
        <p style="margin-top:8px;">※ 대리인 신청시 구비서류 : 대리인 및 수험자 본인의 신분증 첨부</p>
    </div>

    <div class="sub-info-box" style="margin-top:30px; background:#f0f4fa;">
        <dt>관련문의</dt>
        <dd>정책사업본부 &nbsp;☎&nbsp; 070-7510-3090 / 070-7510-1227</dd>
    </div>
</div>
@endsection
