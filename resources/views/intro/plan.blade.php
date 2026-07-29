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

    <div class="sub-section">
        <div style="max-width:660px; margin:0 auto; text-align:center;">
            {{-- 비전 --}}
            <div style="display:inline-block; padding:13px 34px; background:#3a9d6e; color:#fff; border-radius:30px; font-size:16px; font-weight:700;">CM으로 하나되는 건설산업</div>

            <div style="color:#c6d6cf; font-size:20px; line-height:1; margin:12px 0;">▼</div>

            {{-- 추진방향 (8대사업 기반) --}}
            <div style="display:flex; align-items:stretch; gap:12px;">
                <div style="display:flex; align-items:center; justify-content:center; width:66px; flex-shrink:0; background:#eef3ec; border:1px solid #d9e4d4; border-radius:40px; font-weight:700; color:#6b8f5a; font-size:14px; line-height:1.4;">8대<br>사업</div>
                <div style="flex:1; display:flex; flex-direction:column; gap:8px;">
                    @foreach([
                        '건설산업에서의 CM의 역할 재정립',
                        '서비스의 고급화를 위한 인력 및 기술개발',
                        '내실 있는 국제협력 사업의 추진 및 홍보활동 강화',
                    ] as $dir)
                        <div style="padding:13px 14px; background:#f6f8fa; border:1px solid #e2e8f0; border-radius:6px; font-size:14px; font-weight:600; color:#333;">{{ $dir }}</div>
                    @endforeach
                </div>
                <div style="display:flex; align-items:center; justify-content:center; width:66px; flex-shrink:0; background:#eef3ec; border:1px solid #d9e4d4; border-radius:40px; font-weight:700; color:#6b8f5a; font-size:14px; line-height:1.4;">8대<br>사업</div>
            </div>

            <div style="color:#eac4ac; font-size:20px; line-height:1; margin:12px 0;">▼</div>

            {{-- 목표 --}}
            <div style="display:inline-block; padding:13px 34px; background:#e8734e; color:#fff; border-radius:30px; font-size:15px; font-weight:700;">CM의 수요 극대화와 양질의 CM서비스 공급</div>
        </div>
    </div>

    <div class="sub-section" style="margin-top:30px;">
        @php
            $plans = [
                [
                    'title' => '1. CM관련제도 및 정책개발',
                    'color' => '#7b7fb5',
                    'items' => [
                        'CM의 중·장기 발전방안 강구',
                        '관련제도의 정비·개선',
                        'CM발주제도 개선 연구',
                    ],
                ],
                [
                    'title' => '2. CM인력 및 기술개발 지원',
                    'color' => '#6daed5',
                    'items' => [
                        '내실있는 교육훈련 및 평가제도 연구',
                        '수행사례 분석 및 활용지원',
                        '전문가관리체계 개발',
                        '기법 전수를 위한 행사 활성화',
                        'CM공동사업단 운영',
                    ],
                ],
                [
                    'title' => '3. 조사 및 연구활동',
                    'color' => '#7bc5b5',
                    'items' => [
                        '연구개발사업 수행',
                        'CM업무범위 확대 등 관련제도 개발',
                        '외국의 제도 및 정책조사연구',
                        '후발국에 대한 CM수출 지원',
                    ],
                ],
                [
                    'title' => '4. CM시장 활성화 지원사업',
                    'color' => '#7bc57b',
                    'items' => [
                        '순회홍보 교육 및 세미나 개최',
                        'CM Project 모니터링을 위한 담당자 간담회',
                        '전문인력 양성',
                        'CM활성화 전지 전략회의',
                        'CM발주 지원활동',
                    ],
                ],
                [
                    'title' => '5. 정보 및 자료의 교환·공유체계 구축',
                    'color' => '#7b7fb5',
                    'items' => [
                        '정보 인프라 환경 구축',
                        '정보·자료의 공급체계 구축',
                        '국제협력 행사 개최',
                    ],
                ],
                [
                    'title' => '6. 홍보활동의 강화',
                    'color' => '#6daed5',
                    'items' => [
                        'CM확대·보급을 위한 홍보 강화',
                        'CM상담실의 상시 운영',
                        'CM브로셔 발간',
                        'CM핸드북 발간',
                        '정보·자료의 공급',
                    ],
                ],
                [
                    'title' => '7. 정부위탁업무 수행',
                    'color' => '#7bc5b5',
                    'items' => [
                        'CM능력평가·공시 업무',
                        '공공 공사 CM발주현황 유지·관리',
                        'CM실적확인 업무',
                    ],
                ],
                [
                    'title' => '8. 일반관리부문',
                    'color' => '#7bc57b',
                    'items' => [
                        '지회(5개) 활동 강화를 위한 지원',
                        '각종 회의 및 행사 기획 운영',
                        '협회활동 활성화를 위한 제도 등의 정비',
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
