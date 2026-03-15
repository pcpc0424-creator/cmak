@extends('layouts.sub')

@section('title', 'FAQ - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', 'FAQ')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">자주 묻는 질문 (FAQ)</h2>
    <p class="sub-content-desc">자주 문의하시는 질문과 답변을 모았습니다.</p>

    <div x-data="{ open: null }">
        @php
            $faqs = [
                ['q' => '한국CM협회 회원가입 자격은 어떻게 되나요?', 'a' => '건설산업기본법 제2조에 따른 건설사업관리를 수행하는 법인으로서 건설사업관리 실적이 있는 기업이 가입할 수 있습니다. 자세한 내용은 협회사업 > 회원가입 메뉴를 참고하시기 바랍니다.'],
                ['q' => 'CM능력평가 신청 기간은 언제인가요?', 'a' => '매년 상반기에 공고하며, 신청 마감은 8월 31일까지입니다. 정확한 일정은 매년 홈페이지 공지사항을 통해 안내합니다.'],
                ['q' => '건설사업관리사(CMP) 자격검정 응시자격은?', 'a' => '건설 관련 학과 학사 이상 학력과 실무경력 3년 이상이 필요합니다. 학력에 따라 경력 요건이 다를 수 있으며, 자세한 사항은 협회사업 > 자격검정 메뉴를 참고하시기 바랍니다.'],
                ['q' => 'CM전문교육 수강 신청은 어떻게 하나요?', 'a' => '협회 홈페이지를 통해 온라인으로 신청 가능합니다. 교육 일정은 연초에 연간 계획으로 공지하며, 각 교육과정별 상세 일정은 공지사항을 참고하시기 바랍니다.'],
                ['q' => 'CM실적확인서 발급에 필요한 서류는?', 'a' => '실적확인 신청서, 계약서 사본, 준공확인서 등이 필요합니다. 수수료는 건당 50,000원이며, 처리기간은 접수일로부터 7일 이내입니다.'],
                ['q' => 'CM Herald 구독은 어떻게 하나요?', 'a' => 'CM Herald는 월간 소식지로 회원사에 무료 배포됩니다. 비회원사의 경우 별도 구독 신청이 가능하며, 자세한 사항은 기획부(02-585-4712)로 문의하시기 바랍니다.'],
                ['q' => '협회 방문 시 주차가 가능한가요?', 'a' => '플라티넘타워 지하주차장을 이용하실 수 있으며, 방문 시 1시간 무료 주차가 가능합니다.'],
            ];
        @endphp

        @foreach($faqs as $i => $faq)
            <div style="border:1px solid #e8ecf1; border-radius:8px; margin-bottom:8px; overflow:hidden;">
                <button
                    @click="open = open === {{ $i }} ? null : {{ $i }}"
                    style="width:100%; text-align:left; padding:16px 20px; background:#fff; border:none; cursor:pointer; display:flex; justify-content:space-between; align-items:center; font-size:14px; font-weight:600; color:#1a1a1a;"
                >
                    <span><span style="color:#0061c2; margin-right:8px;">Q.</span>{{ $faq['q'] }}</span>
                    <span style="color:#999; font-size:18px; transition:transform 0.2s;" :style="open === {{ $i }} ? 'transform:rotate(180deg)' : ''">▼</span>
                </button>
                <div x-show="open === {{ $i }}" x-transition style="padding:16px 20px 20px; background:#f8f9fb; border-top:1px solid #e8ecf1;">
                    <p style="font-size:14px; line-height:1.8; color:#444; margin:0;">
                        <span style="color:#0061c2; font-weight:600; margin-right:4px;">A.</span>{{ $faq['a'] }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
