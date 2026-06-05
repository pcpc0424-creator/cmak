@extends('layouts.sub')

@section('title', '사업계획 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/plan')
@section('page-title', '사업계획')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">사업계획</h2>

    <div class="sub-section" style="text-align:center;">
        <img src="/cmak/images/intro/plan/intro2_6img1.gif" alt="CM으로 하나되는 건설산업" style="max-width:257px; width:100%; margin:0 auto;">

        <div style="margin-top:10px;">
            <img src="/cmak/images/intro/plan/intro2_6img2.gif" alt="8대사업" style="max-width:630px; width:100%; margin:0 auto;">
        </div>

        <div style="margin-top:0;">
            <img src="/cmak/images/intro/plan/intro2_6img3.gif" alt="CM의 수요 극대화와 양질의 CM서비스 공급" style="max-width:391px; width:100%; margin:0 auto;">
        </div>
    </div>

    <div class="sub-section" style="margin-top:30px;">
        @php
            $plans = [
                [
                    'title' => '1. CM관련제도 및 정책개발',
                    'color' => '#7b7fb5',
                    'items' => [
                        'CM의 중·장기적 발전방향의 정립',
                        '관련법규제도의 정비·개선',
                        'CM발주제도의 개선 연구',
                    ],
                ],
                [
                    'title' => '2. CM인력 및 기술개발 지원',
                    'color' => '#6daed5',
                    'items' => [
                        '신뢰받는 엔지니어 및 기업인 양성',
                        '자격검정 실시 및 활성화지원',
                        '건설사업관리자체계 정립',
                        '각종 교육과정 운영 및 활성화',
                        'CM자격검정시험제도',
                    ],
                ],
                [
                    'title' => '3. 조사 및 연구활동',
                    'color' => '#7bc5b5',
                    'items' => [
                        '건설사업관리중심 연구',
                        'CM적용사업의 확대 및 공공부문 확산',
                        '국내외 현황 및 정책동향연구',
                        '발주기관 대상 CM세미나 개최',
                    ],
                ],
                [
                    'title' => '4. CM시장 활성화 지원사업',
                    'color' => '#7bc57b',
                    'items' => [
                        '협회홍보활동 및 세미나 개최',
                        'CM Project 모니터링 기반 마련을 위한 보고회',
                        '전문인력 양성',
                        'CM활성화 위한 간담회개최',
                        'CM해외 교류활동',
                    ],
                ],
                [
                    'title' => '5. 정보 및 자료의 교환·공유체계 구축',
                    'color' => '#7b7fb5',
                    'items' => [
                        '협회 홈페이지 환경 강화',
                        '건설사업자료실 관리체계 구축',
                        '정보관리의 질적 향상',
                    ],
                ],
                [
                    'title' => '6. 홍보활동의 강화',
                    'color' => '#6daed5',
                    'items' => [
                        'CM확대·활성화를 위한 홍보 강화',
                        'CM관련기관과의 교류',
                        'CM뉴스의 발간',
                        'CM자료집 발간',
                        '건설사업자료실 운영',
                    ],
                ],
                [
                    'title' => '7. 정부위탁업무 수행',
                    'color' => '#7bc5b5',
                    'items' => [
                        'CM능력평가·공시의 시행',
                        '국내 전체 CM수행현황 통계조사사업',
                        'CM실적확인 업무',
                    ],
                ],
                [
                    'title' => '8. 일반관리부문',
                    'color' => '#7bc57b',
                    'items' => [
                        '분회(5개) 활동 강화를 위한 지원',
                        '정기 회의 및 행사 기획 등',
                        '협회활동 활성화를 위한 사무 조직 정비',
                    ],
                ],
            ];
        @endphp

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            @foreach($plans as $plan)
            <div style="border:1px solid #e0e0e0; border-radius:6px; overflow:hidden;">
                <div style="background:{{ $plan['color'] }}; color:#fff; padding:12px 16px; font-weight:bold; font-size:15px;">
                    {{ $plan['title'] }}
                </div>
                <div style="padding:15px 20px;">
                    <ul style="padding-left:18px; margin:0; line-height:1.8; font-size:14px; color:#444;">
                        @foreach($plan['items'] as $item)
                        <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
