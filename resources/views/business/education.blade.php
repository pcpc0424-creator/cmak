@extends('layouts.sub')

@section('title', 'CM교육 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/education')
@section('page-title', 'CM교육')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM교육</h2>

    <div style="margin:18px 0 28px; padding:22px 24px; background:linear-gradient(135deg, #f4f9ff 0%, #fbfdff 100%); border:1px solid #d9e6f3; border-radius:8px;">
        <p style="margin:0 0 10px 0; font-size:16px; font-weight:700; color:#0061c2; line-height:1.6;">
            건설산업의 미래를 선도하는 CM 전문가 양성, 한국CM협회가 함께합니다.
        </p>
        <p style="margin:0 0 10px 0; line-height:1.8;">
            한국CM협회는 설립 이후, 건설사업관리(CM)의 체계적인 보급과 전문 인력 양성을 통해 국내 건설산업의 선진화 및 국제 경쟁력 강화에 앞장서 왔습니다.
        </p>
        <p style="margin:0; line-height:1.8;">
            현재 협회는 변화하는 교육 환경에 발맞추어, 정기 교육 과정 대신 <strong>회원사 맞춤형 교육 지원 체계</strong>를 통해 실무 중심의 핵심 역량 강화 서비스를 제공하고 있습니다.
        </p>
    </div>

    <h2 class="sub-content-title">1. 교육 목표</h2>
    <div class="sub-section">
        <ul style="padding-left:22px; line-height:1.9;">
            <li><strong>CM 역량 극대화</strong> : 건설사업의 기획부터 설계, 시공, 사후관리까지 전 과정에 걸친 과학적 관리 기법 보급을 통해 사업비 절감 및 품질 향상에 기여합니다.</li>
            <li><strong>실무 전문가 양성</strong> : 이론과 사례를 결합한 심도 있는 교육으로 현업에 즉시 적용 가능한 최고급 CM 전문가를 육성합니다.</li>
            <li><strong>산업 투명성 제고</strong> : 전문적인 관리 방법 보급을 통해 입찰 및 계약의 투명성과 객관성을 확보하고 공정한 경쟁 환경을 조성합니다.</li>
        </ul>
    </div>

    <h2 class="sub-content-title">2. 주요 교육 서비스 (회원사 맞춤형 지원)</h2>
    <div class="sub-section">
        <p style="line-height:1.8; margin-bottom:12px;">
            회원사가 주관하는 교육 과정의 내실을 기할 수 있도록 협회의 전문 인프라를 활용한 맞춤형 프로그램을 지원합니다.
        </p>
        <ul style="padding-left:22px; line-height:1.9;">
            <li><strong>회원사 맞춤형 출장 교육</strong> : 회원사가 필요로 하는 특정 주제나 실무 역량 강화를 위해 협회의 전문가 풀(Pool)을 활용하여 현장으로 직접 찾아가는 교육을 실시합니다.</li>
            <li><strong>자체 교육 프로그램 지원</strong> : 회원사 내부에서 운영하는 교육 과정(예: 현장소장/단장 교육 등)에 협회의 검증된 교육 커리큘럼 및 전문 강사진을 일부 지원하여 교육 효과를 높여드립니다.</li>
            <li><strong>최신 트렌드 및 사례 공유</strong> : 정부, 업계, 학계의 최고 실무 전문가로 구성된 강사 풀을 통해 최신 CM 트렌드와 성공 사례 중심의 지식을 전달합니다.</li>
        </ul>
    </div>

    <h2 class="sub-content-title">3. 주요 지원 분야</h2>
    <div class="sub-section">
        <ul style="padding-left:22px; line-height:1.9;">
            <li>CM 핵심 이론 및 실무 사례 분석</li>
            <li>단계별(기획, 설계, 시공 등) 건설사업관리 기법</li>
            <li>사업비 절감 및 공기 단축 방안</li>
            <li>최신 건설 트렌드 및 CM 발주 트렌드 정보 공유</li>
        </ul>
    </div>

    <h2 class="sub-content-title">4. 교육 지원 문의</h2>
    <div class="sub-section">
        <p style="line-height:1.8;">
            맞춤형 출장 교육 및 프로그램 지원에 관한 상세한 상담은 협회 사무국으로 문의해 주시기 바랍니다.
        </p>
    </div>

    <div class="sub-info-box" style="margin-top:18px; background:#f0f4fa;">
        <dt>관련문의</dt>
        <dd>정책사업본부 &nbsp;☎&nbsp; 070-7510-3090 / 070-7510-1227</dd>
    </div>

    <div style="margin-top:30px; padding:22px 24px; background:#fbfbf3; border:1px solid #d8d5bb; border-radius:8px;">
        <h3 style="margin:0 0 14px 0; color:#0061c2; font-size:16px;">[ 협회 교육 지원 역량 ]</h3>
        <ul style="padding-left:18px; margin:0; line-height:1.9;">
            <li><strong>전문성</strong> : 1997년 이후 축적된 방대한 CM 교육 데이터와 커리큘럼 보유</li>
            <li><strong>네트워크</strong> : 산·학·연을 아우르는 CM 분야 최고 수준의 전문가 네트워크 구축</li>
            <li><strong>유연성</strong> : 기업별 특성에 맞춘 커스터마이징 교육 설계 가능</li>
        </ul>
    </div>
</div>
@endsection
