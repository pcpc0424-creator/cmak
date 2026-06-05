@extends('layouts.sub')

@section('title', '부서별업무안내 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/departments')
@section('page-title', '부서별 업무안내')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@php
    $departments = [
        [
            'name' => '운영지원본부',
            'phone' => '☎ 070-7510-1226 / 02-585-7092',
            'color' => '#D6D0E8',
            'duties' => [
                '사업계획 및 예산의 편성·조정 및 집행지원',
                '정관 및 제규정의 관리',
                '직원의 인사·복무·급여·복리후생 및 교육훈련 (직원의 직무교육)',
                '회계 및 경리에 관한 업무',
                '총회·이사회 및 기타 일반회의 및 행사의 운영 및 지원',
                '물품 등의 구매 및 조달',
                '인장의 관수 및 문서수발',
                '사무실, 차량 및 재산관리',
                '회원의 관리에 관한 사항',
                '홍보관련사항 총괄',
                '국제교류 및 협력에 관한 사항',
                '소관위원회의 운영 및 지원',
            ],
        ],
        [
            'name' => '정책사업본부',
            'phone' => '☎ 070-7510-3090 / 070-7510-1227',
            'color' => '#EAE1E5',
            'duties' => [
                '건설산업관련제도 및 정책의 개선 지원활동',
                '건설사업관리업무의 수행을 위한 지원활동',
                '건설시장동향 분석',
                '건설기술의 개발지원',
                '건설산업관련 정보화사업의 지원',
                '건설사업관리사(CMP) 자격검정업무',
                '각종 자격제도에 관한 사항',
                '소관위원회의 운영 및 지원',
            ],
        ],
        [
            'name' => '사업지원본부',
            'phone' => '☎ 02-585-4712~4',
            'color' => '#CFE3DB',
            'duties' => [
                '건설사업관리자에 대한 실무지원 및 협조',
                '건설사업관리에 관한 각종 정보의 수집 및 보급',
                '정부 또는 다른 기관·단체와 관련된 위탁업무의 수행',
                'CM능력평가·공시 업무',
                'CM실적유지·관리 및 확인 업무',
                '각종 확인 또는 증명업무',
                '소관위원회의 운영 및 지원',
            ],
        ],
        [
            'name' => '교육훈련본부',
            'phone' => '',
            'color' => '#D2C8AE',
            'duties' => [
                '건설인력의 개발 및 관리',
                '건설사업관리전문교육과정 운영',
                '교육·훈련제도의 조사·연구',
                '인력개발을 위한 산·학·연 협동활동',
                '소관위원회의 운영 및 지원',
            ],
        ],
        [
            'name' => '건설산업연구센타',
            'phone' => '',
            'color' => '#C5C8DE',
            'duties' => [
                '건설산업과 관련된 각종제도 및 정책의 조사·연구 및 개발',
                '건설경제동향 및 추이 조사 분석',
                '건설기술의 개발 및 활용 지원',
                '기타 회장이 필요하다고 인정하는 사업의 조사·연구',
            ],
        ],
    ];
@endphp

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">부서별 업무안내</h2>

    <div class="dept-grid">
        @foreach($departments as $dept)
            <div class="dept-card">
                <div class="dept-header" style="background: {{ $dept['color'] }};">
                    <span class="dept-name">• {{ $dept['name'] }}</span>
                    @if($dept['phone'])
                        <span class="dept-phone">{{ $dept['phone'] }}</span>
                    @endif
                </div>
                <ul class="dept-duties">
                    @foreach($dept['duties'] as $duty)
                        <li>{{ $duty }}</li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
</div>

<style>
    .dept-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap:20px; margin-top:20px; }
    .dept-card { border:1px solid #e8ecf1; border-radius:6px; overflow:hidden; background:#fdfdfc; }
    .dept-header { padding:14px 18px; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:8px; }
    .dept-name { font-weight:700; font-size:15px; color:#333; }
    .dept-phone { font-size:13px; color:#555; white-space:nowrap; }
    .dept-duties { padding:14px 22px; margin:0; line-height:1.9; }
    .dept-duties li { padding:3px 0; font-size:13.5px; color:#444; list-style:none; position:relative; padding-left:14px; }
    .dept-duties li::before { content:''; position:absolute; left:0; top:14px; width:4px; height:4px; background:#888; border-radius:50%; }
</style>
@endsection
