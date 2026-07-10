@extends('layouts.sub')

@section('title', 'CM이란? - 한국CM협회')
@section('category', 'CM 소개')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', 'CM이란?')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM이란?</h2>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 정의</h3>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>
                건설산업기본법에서의 정의(제2조 8호) '건설사업관리'라 함은 건설공사에 관한 기획·타당성조사·분석·설계·조달·계약·시공관리·감리·평가·사후관리 등에 관한 관리를 수행하는 것을 말한다.
            </li>
            <li style="margin-top:10px;">
                CMAA(미국건설사업관리협회) Construction Management is a professional management practice consisting of array of services applied to construction projects and programs through the planning, design, construction and post construction phases for the purpose of achieving project objectives including the management of quality, cost, time and scope.
            </li>
            <li style="margin-top:10px;">
                일반적으로 CM의 의미; 건설사업의 공사비절감(Cost), 품질향상(Quality), 공기단축(Time)을 목적으로 발주자가 전문지식과 경험을 지닌 건설사업관리자에게 발주자가 필요로 하는 건설사업관리 업무의 전부 또는 일부를 위탁하여 관리하게 하는 새로운 계약발주방식 또는 전문관리기법.
            </li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 계약방식에 따른 분류</h3>
        <h4 style="margin-top:14px; font-size:15px; color:#064277;">1. CM for fee 또는 Agency CM (용역형 CM)</h4>
        <p>- Construction manager는 설계 및 시공에 직접 관여하지 않으며, 건설사업 수행에 관한 발주자에 대한 조언자로서의 역할만을 한다.</p>

        <p style="margin-top:12px;">
            - CMAA의 정의: Agency CM is a professional service that can be applied to all delivery systems where the CM acts as the owner's principal agent in the management of a construction project or program, where the CM is responsible to the owner for managing the planning, design, construction and post construction phases, or portions thereof. the CM represents the interests of the project in its dealings with other construction professional, and with other private and public entities.
        </p>

        <p style="margin-top:12px;"><strong>&nbsp;&nbsp;The construction manager offers advice, uncolored by any conflicting interest, on such crucial matters as:</strong></p>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>Optimum use of available funds</li>
            <li>Control of the scope of the work</li>
            <li>Project scheduling</li>
            <li>Optimum use of design and construction firms' skills and talents</li>
            <li>Avoidance of delays, changes and disputes</li>
            <li>Enhancing project design and construction quality</li>
            <li>Optimum flexibility in contracting and procurement</li>
        </ul>

        <p style="margin-top:12px;">
            Comprehensive management of every stage of the project, beginning with the original concept and project definition, yields the greatest possible benefit to owners from Construction Management.
        </p>
    </div>

    <div class="sub-section">
        <h4 style="margin-top:24px; font-size:15px; color:#064277;">2. CM at Risk (시공책임형 CM)</h4>
        <p>
            - 건설산업기본법에서의 정의(제2조 9호) '시공책임형 건설사업관리'라 함은 종합공사를 시공하는 업종을 등록한 건설업자가 건설공사에 대하여 시공 이전 단계에서 건설사업관리 업무를 수행하고 아울러 시공단계에서 발주자와 시공 및 건설사업관리에 대한 별도의 계약을 통하여 종합적인 계획, 관리 및 조정을 하면서 미리 정한 공사 금액과 공사기간 내에 시설물을 시공하는 것을 말한다.
        </p>
        <p style="margin-top:12px;">
            - CMAA의 정의: At-risk CM is a delivery method, which entails a commitment by the construction manager to deliver the project within a Guaranteed Maximum Price (GMP). The construction manager acts as consultant to the owner in the development and design phases, but as the equivalent of a general contractor during the construction phase. When a construction manager is bound to a GMP, the most fundamental character of the relationship is changed. In addition to acting in the owner's interest, the construction manager also protects him/herself.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 도입 배경</h3>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>건설프로젝트의 대형화, 복잡화, 전문화 추세에 따라 품질, 비용, 공기 등의 목표를 효과적으로 달성하기위한 체계적이고 전문적인 관리능력이 필요하게 되었음.</li>
            <li>국내 건설기술관리법(현 건설기술진흥법)에 근거를 둔 설계감리 및 책임감리 등의 제도는 건설사업의 특정 단계에서 품질 안전을 위주로 하는 관리체계로 부분적인 성과를 거두고 있으나, 건설사업 전 단계에 걸쳐 품질 안전뿐만 아니라 비용, 기간 등을 종합적으로 관리할 수 있는 체계가 필요하게 되었음.</li>
            <li>따라서, 선진국에서 이미 일반화되어 있는 건설사업수행체계를 도입하여 종합적인 건설사업관리능력 제고의 기틀을 마련하고, 건설시장 개방에 대비한 건설사업수행 체계의 다양화 국제화의 필요성이 부각되었음.</li>
        </ol>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 필요성</h3>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>기획ㆍ설계ㆍ시공 등 각각의 건설사업 참여자간의 Communication 및 조정의 어려움.</li>
            <li>초기 단계의 계획수립 미비로 인한 공기지연, 사업비증대, 품질부실우려 등.</li>
            <li>계약관리의 미비로 인한 건설사업 참여자들로부터의 클레임 발생우려.</li>
            <li>인ㆍ허가 관련 법규의 분산 및 복잡화로 인한 행정적 처리 미흡.</li>
            <li>설계검토의 미흡으로 인한 VE 및 시공성 검토 미흡.</li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 효과</h3>
        <ul style="padding-left:22px; line-height:1.9;">
            <li>건설사업 초기단계에서 CM적용을 통한 예상되는 문제점 및 낭비요소의 최소화.</li>
            <li>설계이전 단계의 각종 인ㆍ허가 등 행정업무대행 및 금융조달 등으로 성공적 사업수행 도모.</li>
            <li>설계단계에서의 VE와 시공성 검토를 통한 사업비의 절감.</li>
            <li>Fast Track을 통한 공사기간의 단축효과.</li>
            <li>단계별 전문분야별 관리를 통한 부실시공 방지 및 품질확보.</li>
            <li>건설사업 참여자간의 원활한 Communication 및 조정으로 발주자의 목표 달성.</li>
            <li>전문 단일조직이 사업의 전 단계를 종합 관리함으로써 일관성 있는 사업진행이 가능.</li>
            <li>전문가 조직의 과학적 분석 및 평가를 통해 발주자에게 최선의 의사 결정안 제공.</li>
            <li>건설사업 참여자들로부터 발생 가능한 클레임의 최소화 및 분쟁 발생 시 주도권확보.</li>
            <li>사업진행에 관한 정보를 발주자 및 참여자간에 실시간으로 제공.</li>
        </ul>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM의 업무범위 및 업무내용 (건설기술진흥법 시행령 제59조)</h3>

        <p><strong>① 법 제39조제1항에 따른 건설사업관리의 업무범위는 다음 각 호에 따른 단계별로 구분한다.</strong></p>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>설계 전 단계</li>
            <li>기본설계 단계</li>
            <li>실시설계 단계</li>
            <li>구매조달 단계</li>
            <li>시공 단계</li>
            <li>시공 후 단계</li>
        </ol>

        <p style="margin-top:14px;"><strong>② 제1항에 따른 단계별 업무내용은 다음 각 호로 한다.</strong></p>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>건설공사의 계획, 운영 및 조정 등 사업관리 일반</li>
            <li>건설공사의 계약관리</li>
            <li>삭제</li>
            <li>건설공사의 사업비 관리</li>
            <li>건설공사의 공정관리</li>
            <li>건설공사의 품질관리</li>
            <li>건설공사의 안전관리</li>
            <li>건설공사의 환경관리</li>
            <li>건설공사의 사업정보 관리</li>
            <li>건설공사의 사업비, 공정, 품질, 안전 등에 관련되는 위험요소 관리</li>
            <li>그 밖에 건설공사의 원활한 관리를 위하여 필요한 사항</li>
        </ol>

        <p style="margin-top:14px;"><strong>③ 감독 권한대행 등 건설사업관리에는 다음 각 호의 업무가 포함되어야 한다.</strong></p>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>시공계획의 검토</li>
            <li>공정표의 검토</li>
            <li>시공이 설계도면 및 시방서의 내용에 적합하게 이루어지고 있는지에 대한 확인<br>
                &nbsp;&nbsp;&nbsp;(제101조의2제1항 각 호의 가설구조물이 시공상세도면 및 시방서의 내용에 적합하게 설치되었는지에 대한 확인을 포함한다.)
            </li>
            <li>건설사업자나 주택건설등록업자가 수립한 품질관리계획 또는 품질시험계획의 검토ㆍ확인ㆍ지도 및 이행상태의 확인, 품질시험 및 검사 성과에 관한 검토ㆍ확인</li>
            <li>재해예방대책의 확인, 안전관리계획에 대한 검토ㆍ확인, 그 밖에 안전관리 및 환경관리의 지도</li>
            <li>공사 진척 부분에 대한 조사 및 검사</li>
            <li>하도급에 대한 타당성 검토</li>
            <li>설계내용의 현장조건 부합성 및 실제 시공 가능성 등의 사전검토</li>
            <li>설계 변경에 관한 사항의 검토 및 확인</li>
            <li>준공검사</li>
            <li>건설사업자나 주택건설등록업자가 작성한 시공상세도면의 검토 및 확인</li>
            <li>구조물 규격 및 사용자재의 적합성에 대한 검토 및 확인</li>
            <li>그 밖에 공사의 질적 향상을 위하여 필요한 사항으로서 국토교통부령으로 정하는 사항</li>
        </ol>

        <p style="margin-top:14px;"><strong>④ 법 제39조제3항에 따라 시행하는 설계용역에 대한 건설사업관리에는 다음 각 호의 업무가 포함되어야 한다.</strong></p>
        <ol style="padding-left:24px; line-height:1.9;">
            <li>건설공사 관련 법령, 법 제44조제1항제1호 및 제2호에 따른 건설공사 설계기준 및 건설공사 시공기준에의 적합성 검토</li>
            <li>구조물의 설치 형태 및 건설공법 선정의 적정성 검토</li>
            <li>사용재료 선정의 적정성 검토</li>
            <li>설계내용의 시공 가능성에 대한 사전검토</li>
            <li>구조계산의 적정성 검토</li>
            <li>제74조에 따른 측량 및 지반조사의 적정성 검토</li>
            <li>설계공정의 관리</li>
            <li>공사기간 및 공사비의 적정성 검토</li>
            <li>제75조에 따른 설계의 경제성등 검토</li>
            <li>설계안의 적정성 검토</li>
            <li>설계도면 및 공사시방서 작성의 적정성 검토</li>
        </ol>

        <p style="margin-top:14px; line-height:1.9;"><strong>⑤</strong> 법 제39조제4항 후단에서 "대통령령으로 정하는 건설기술인"이란 법 제39조의3제4항에 따라 지명된 책임건설기술인(이하 "책임건설사업관리기술인"이라 한다)과 토목, 건축, 기계, 조경 등 각 분야별 건설사업관리기술인을 말한다.</p>

        <p style="margin-top:14px; line-height:1.9;"><strong>⑥</strong> 법 제39조제6항 후단에서 "대통령령으로 정하는 건설기술인"이란 제60조제1항에 따라 시공 단계의 건설사업관리 업무에 배치된 건설기술인을 말한다.</p>

        <p style="margin-top:14px; line-height:1.9;"><strong>⑦</strong> 제1항부터 제4항까지에서 규정한 건설사업관리의 업무내용에 관하여 필요한 사항은 국토교통부장관이 정하여 고시한다.</p>
    </div>
</div>
@endsection
