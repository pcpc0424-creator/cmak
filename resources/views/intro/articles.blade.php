@extends('layouts.sub')

@section('title', '정관 및 제규정 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/articles')
@section('page-title', '정관 및 제규정')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card" x-data="{ tab: '{{ request('tab', 'articles') }}' }">
    <h2 class="sub-content-title">정관 및 제규정</h2>
    <p class="sub-content-desc">한국CM협회의 정관 및 제규정을 열람할 수 있습니다.</p>

    {{-- 탭 메뉴 --}}
    <div class="reg-tabs">
        <button @click="tab='articles'" class="reg-tab" :class="tab==='articles' && 'reg-tab--on'">정관</button>
        <button @click="tab='fee'" class="reg-tab" :class="tab==='fee' && 'reg-tab--on'">회비규정</button>
        <button @click="tab='evaluation'" class="reg-tab" :class="tab==='evaluation' && 'reg-tab--on'">CM능력평가공시업무처리규정</button>
    </div>

    {{-- 정관 --}}
    <div x-show="tab==='articles'" style="margin-top:32px;">
        <div style="background:#f0f4fa; border:1px solid #dde3ed; border-radius:8px; padding:16px 20px; margin-bottom:24px;">
            <p style="font-size:13px; color:#555; margin:0;">
                <strong style="color:#064277;">한국건설관리협회 정관</strong> &nbsp;|&nbsp;
                제정 1997.03.27 &nbsp;|&nbsp; 전문개정 1999.07.20 &nbsp;|&nbsp; 최종개정 2022.07.21
            </p>
        </div>
        <div style="border:1px solid #e8ecf1; border-radius:8px; overflow:hidden; max-height:600px; overflow-y:auto; padding:24px; font-size:14px; line-height:2; color:#333;">
            @php
                $rawPath = public_path('uploads/articles/articles_raw.html');
                $rawHtml = file_exists($rawPath) ? file_get_contents($rawPath) : '';
                if (preg_match('/<table width="600".*?>(.*)/s', $rawHtml, $m)) {
                    $content = $m[1];
                    $content = preg_replace('/<\/?(html|head|meta|link|script|style|body|!DOCTYPE)[^>]*>/i', '', $content);
                    $content = preg_replace('/class="[^"]*"/i', '', $content);
                    $content = preg_replace('/style="[^"]*"/i', '', $content);
                    $content = preg_replace('/bgcolor="[^"]*"/i', '', $content);
                    $content = preg_replace('/background="[^"]*"/i', '', $content);
                    $content = preg_replace('/<img[^>]*>/i', '', $content);
                    $content = preg_replace('/<a[^>]*>|<\/a>/i', '', $content);
                }
            @endphp
            {!! $content ?? '<p>정관 내용을 불러올 수 없습니다.</p>' !!}
        </div>
    </div>

    {{-- 회비규정 --}}
    <div x-show="tab==='fee'" style="margin-top:32px;">
        <div style="background:#f0f4fa; border:1px solid #dde3ed; border-radius:8px; padding:16px 20px; margin-bottom:24px;">
            <p style="font-size:13px; color:#555; margin:0;">
                <strong style="color:#064277;">회비 규정</strong> &nbsp;|&nbsp;
                제정 2000.02.18 &nbsp;|&nbsp; 개정 2000.01.15 &nbsp;|&nbsp; 전문개정 2016.10.20
            </p>
        </div>
        <div style="border:1px solid #e8ecf1; border-radius:8px; overflow:hidden; max-height:600px; overflow-y:auto; padding:24px; font-size:14px; line-height:2; color:#333;">
            <p><strong>제1조(목적)</strong><br>
            이 규정은 정관 제7조에 따른 회비의 부과 및 납부에 관하여 필요한 사항을 정함을 목적으로 한다.</p>

            <p><strong>제2조(적용범위)</strong><br>
            협회는 회비에 관하여 따로 정하는 것을 제외하고는 이 규정에 따른다.</p>

            <p><strong>제3조(회비의종류)</strong><br>
            1. 일반회비<br>
            &nbsp;&nbsp;가. 입 회 비 : 회원으로 입회하는 때에 납부하는 회비<br>
            &nbsp;&nbsp;나. 연 회 비 : 매년 시공능력평가액 또는 매출액에 따라 부과하는 회비<br>
            &nbsp;&nbsp;다. 통상회비 : 건설사업관리업무위탁계약금액의 1,000분의 1을 적용하여 부과하는 회비<br>
            2. 특별회비 : 찬조금, 기부금등<br>
            3. 분 담 금 : 회원 공동사업의 수행을 위하여 해당 회원에게 부과하는 회비</p>

            <p><strong>제4조(회비의부과)</strong><br>
            ①일반회비는 별표 1의 회비부과기준에 따라서 부과한다.<br>
            ②일반회비 중 연회비는 매년 1/4분기 중에 부과하며, 통상회비는 매년 2/4분기 중에 부과한다.<br>
            ③특별회비 및 분담금은 필요한 때에 이사회의 의결을 거쳐 별도로 부과한다.</p>

            <p><strong>제5조(회비의 감면)</strong><br>
            ①일반회원으로 입회하는 때의 연회비는 가입일자 해당월 기준 월할계산 하고 입회비는 그러하지 아니한다.<br>
            ②특별회원에게는 통상회비를 면제하되, 제1항은 적용하지 아니한다.<br>
            ③회비의 감면에 대하여 이 규정에서 정하는 것을 제외하고는 이사회의 의결에 따른다.</p>

            <p><strong>제6조(회비의 납부)</strong><br>
            회비는 다음 각 호에 따라 납부한다.<br>
            1. 입회비는 회원가입 입회원서를 제출한 때에 납부한다.<br>
            2. 연회비와 통상회비는 부과일로부터 30일 이내에 납부한다.<br>
            3. 특별회비 및 분담금은 이사회에서 정하는 바에 따라 납부한다.</p>

            <p><strong>제7조(회비의 반환)</strong><br>
            회원은 정관 및 이 규정에 따라 납부한 회비에 대하여 그 반환을 청구할 수 없다.</p>

            <p><strong>제8조(회비부과방법)</strong><br>
            ①회비의 부과는 산출근거를 명시하여 서면으로 하여야 한다.<br>
            ②회비를 납부하였을 때에는 소정의 영수증을 발급하여야 한다.</p>

            <p><strong>제9조(회비대장)</strong><br>
            회비업무 담당자는 연도별로 회비의 종류에 따라 부과 및 납부한 내용을 명시한 회비대장을 기록 유지하여야 한다.</p>

            <p><strong>부칙</strong><br>
            제1조 이 규정은 2016년 10월 21일부터 시행한다.</p>
        </div>
    </div>

    {{-- CM능력평가공시업무처리규정 --}}
    <div x-show="tab==='evaluation'" style="margin-top:32px;">
        <div style="background:#f0f4fa; border:1px solid #dde3ed; border-radius:8px; padding:16px 20px; margin-bottom:24px;">
            <p style="font-size:13px; color:#555; margin:0;">
                <strong style="color:#064277;">CM능력평가공시업무처리규정</strong> &nbsp;|&nbsp;
                시행 2003.01.15
            </p>
        </div>
        <div style="border:1px solid #e8ecf1; border-radius:8px; overflow:hidden; max-height:600px; overflow-y:auto; padding:24px; font-size:14px; line-height:2; color:#333;">
            <h4 style="color:#064277; margin-top:0;">제1장 총칙</h4>

            <p><strong>제1조 | 목적</strong><br>
            이 규정은 국토교통부장관으로부터 위탁된 건설사업관리자의 건설사업관리능력의 평가·공시에 관한 업무를 수행함에 있어서 필요한 사항을 규정함으로써 효율적인 업무수행을 도모하고자 한다.</p>

            <p><strong>제2조 | 정의</strong><br>
            이 규정에서 사용하는 용어의 정의는 다음과 같다.<br>
            1. 평가·공시라 함은 건설산업기본법(이하 법이라 한다) 제23조의2 및 건설교통부고시제 2002-255(2002.11.8)에 의하여 건설사업관리자의 건설사업관리능력을 평가하여 공시하는 것을 말한다.<br>
            2. 평가신청자라 함은 평가·공시를 받고자 하는 자를 말한다.<br>
            3. 협의회라 함은 건설사업관리능력의 평가·공시업무수행절차상 필요한 사항을 상호협의하기 위하여 협회에 설치한 건설사업관리능력평가·공시업무협의회를 말한다.<br>
            4. 위원회라 함은 평가신청자가 제출한 건설사업관리실적 등을 객관적으로 검증하기 위하여 설치한 건설사업관리실적심의위원회를 말한다.</p>

            <p><strong>제3조 | 적용범위</strong><br>
            평가·공시업무를 수행함에 있어서 필요한 사항 중 관련법령에 규정한 사항이외에는 이 규정이 정하는 바에 의한다.</p>

            <h4 style="color:#064277;">제2장 업무처리</h4>

            <p><strong>제4조 | 평가·공시신청</strong><br>
            ①평가신청자는 건설산업기본법시행규칙(이하 시행규칙이라 한다) 제23조의2의 규정에 의한 신청서 등을 매년 2월 15일(건설산업기본법 제23조의2제2항제4호 및 제5호의 서류는 4월 15일)까지 협회에 제출하여야 한다.<br>
            ②회장은 평가신청자가 제출한 신청서에 보완하여야 할 사항이 있거나 보완 또는 수정하고자 하는 사항이 있는 경우에는 일정한 기간을 정하여 보완 또는 수정에 필요한 서류를 제출하게 할 수 있다.</p>

            <p><strong>제5조 | 평가 등</strong><br>
            ①회장은 평가신청자가 제출한 신청서에 대하여 구비서류 외에 전화·전송·청문 또는 현지확인 등의 방법으로 진위여부 등의 평가를 할 수 있다.<br>
            ②평가신청자는 특별한 사유가 있는 경우를 제외하고는 제1항의 규정에 의한 평가업무수행에 적극적으로 협조하여야 한다.<br>
            ③회장은 필요하다고 인정하는 경우에는 협의회의 협의 또는 위원회의 심의를 거쳐 평가 및 공시를 한다.</p>

            <p><strong>제6조 | 공시</strong><br>
            ①회장은 평가결과를 매년 8월 31일까지 지정된 정보통신망에 공시하고 그 결과를 공시일부터 5일이내에 건설교통부장관에게 통보하여야 한다.<br>
            ②회장은 평가·공시한 서류를 비치하되 일반인의 열람을 제한할 수 있다.</p>

            <p><strong>제7조 | 수수료</strong><br>
            회장은 제4조제1항 및 제2항의 규정에 의하여 평가·공시신청을 하는 평가신청자에게 540,000원의 수수료를 징수할 수 있다.</p>

            <p><strong>제8조 | 허위서류 제출자에 대한 조치</strong><br>
            회장은 법 제23조의2제2항의 규정에 의한 건설사업관리실적, 기술자보유 현황, 재무상태를 허위로 제출한 자가 있는 경우에는 이를 건설교통부장관에게 통보하고 검찰에 고발한다.</p>

            <h4 style="color:#064277;">제3장 협의회</h4>

            <p><strong>제9조 | 협의사항</strong><br>
            회장은 건설사업관리능력평가·공시업무를 수행함에 있어서 다음 각호의 사항은 협의회의 협의를 거쳐야 한다.<br>
            1. 평가·공시업무의 주요추진계획<br>
            2. 평가·공시업무의 개선을 위한 제도 및 정책<br>
            3. 평가·공시업무의 수행을 위한 관련자의 지원 및 협조사항<br>
            4. 기타 평가·공시업무의 효율적인 수행을 위하여 회장이 필요하다고 인정하는 사항</p>

            <p><strong>제10조 | 구성</strong><br>
            ①협의회는 의장 1인을 포함한 9이내의 위원으로 구성한다.<br>
            ②의장은 협회의 상임부회장으로 한다.<br>
            ③위원은 정부·학계·건설관련단체·업계관계자 기타 건설사업관리에 관한 전문 지식과 경험이 많은 자 중에서 회장이 위촉한다.</p>

            <p><strong>제11조 | 의장의 직무</strong><br>
            의장은 협의회의 회무를 통할하며 그가 사고로 인하여 직무를 수행할 수 없을 때에는 위원중 연장자 순으로 그 직무를 대행한다.</p>

            <p><strong>제12조 | 회의의 소집</strong><br>
            협의회의 정기회의는 매회계년도 개시 30일전에, 임시회의는 회장 또는 의장이 필요하다고 인정하거나 재적위원 3분의 1이상의 요구가 있을 때에 의장이 소집한다.</p>

            <h4 style="color:#064277;">제4장 위원회</h4>

            <p><strong>제13조 | 기능</strong><br>
            회장은 평가신청자가 제출한 건설사업관리실적중 그 내용이 객관적으로 전문가의 검증이 필요하다고 인정하는 실적에 대하여는 위원회의 심의를 거쳐야 한다.</p>

            <p><strong>제14조 | 구성</strong><br>
            ①위원회는 위원장 및 부위원장 각 1인을 포함한 22인이내의 위원으로 구성한다.<br>
            ②위원장 및 부위원장은 위원중에서 호선하고 위원은 다음 각호의 1에 해당하는 자 중에서 이사회의 동의를 얻어 회장이 위촉한다. 이 경우 회장은 심의를 효율적으로 수행하게 하기 위하여 필요하다고 인정하는 때에는 위원정수의 3분의 1의 범위내에서 사안별로 일시 위촉할 수 있다.<br>
            1. 건설업무와 관련된 건설교통부의 공무원<br>
            2. 건설관련단체의 임원 및 연구기관의 연구원<br>
            3. 건설공사에 관한 학식과 경험이 풍부한 자<br>
            ③위원회의 위원중 공무원이 아닌 위원의 임기는 2년으로 하되 연임할 수 있다. 이 경우 제2항제2호의 규정에 의한 위원이 소속단체 임원으로서의 신분이 소멸된 경우에는 그 소멸된 날에 위원의 임기도 만료된 것으로 본다.</p>

            <p><strong>제15조 | 위원장의 직무 및 회의운영 등</strong><br>
            ①위원장은 위원회의 회무를 통할하고 위원장이 사고가 있을 때에는 부위원장이 그 직무를 대행한다.<br>
            ②위원회의 회의는 회장 또는 위원장이 필요하다고 인정하는 경우에 위원장이 소집하되, 재적위원 과반수의 출석으로 개의하고 출석위원 3분의2 이상의 찬성으로 의결한다.</p>

            <p><strong>제16조 | 의견청취 등</strong><br>
            위원장은 위원회의 심의를 위하여 필요하다고 인정하는 경우에는 현장조사를 하거나 평가신청자, 관계전문가 또는 기타 관련자를 회의에 출석하게 하여 그 의견을 들을 수 있다.</p>

            <p><strong>제17조 | 간사</strong><br>
            위원회의 업무수행을 위하여 필요하다고 인정하는 경우에는 위원장은 회장의 협조를 받아 간사를 따로 둘 수 있다.</p>

            <h4 style="color:#064277;">제5장 보칙</h4>

            <p><strong>제18조 | 수당 등</strong><br>
            회장은 협의회 또는 위원회에 참석하는 위원에게 예산의 범위 내에서 수당이나 여비를 지급할 수 있다.</p>

            <p><strong>제19조 | 세칙</strong><br>
            이 규정 시행에 필요한 세부사항은 회장이 따로 정한다.</p>

            <h4 style="color:#064277;">부칙</h4>

            <p>① <strong>시행일</strong> | 이 규정은 2003년 1월 15일부터 시행한다.<br>
            ② <strong>위원회 구성에 따른 특례</strong> | 이 규정 시행에 따라 최초로 구성되는 위원회의 위원은 회장이 건설에 관한 학식과 경험이 많은 5인 이내의 전형위원회를 구성하여 그 전형위원회의 동의를 받아 위촉한다. 이 경우에는 제14조제2항 본문의 규정에 의한 이사회의 동의를 받은 것으로 본다.</p>
        </div>
    </div>
</div>

<style>
    .reg-tabs {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 28px;
        border-bottom: 2px solid #e3e8ef;
    }
    .reg-tab {
        position: relative;
        padding: 13px 26px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.3px;
        color: #6a7889;
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        margin-bottom: -2px;
        cursor: pointer;
        transition: color .2s, border-color .2s, background-color .2s;
        border-radius: 6px 6px 0 0;
    }
    .reg-tab:hover {
        color: #064277;
        background: #f4f7fb;
    }
    .reg-tab--on {
        color: #064277;
        font-weight: 800;
        border-bottom-color: #064277;
    }
</style>
@endsection
