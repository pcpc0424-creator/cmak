@extends('layouts.sub')

@section('title', '설립목적 및 주요사업 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/about')
@section('page-title', '설립목적 및 주요사업')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">설립목적</h2>

    <div class="sub-section">
        <img src="/cmak/images/intro/about/intro2_1img1.gif" alt="한국CM협회 설립근거는, 민법 제32조 (비영리 사단법인)" style="max-width:314px; width:100%;">

        <div style="max-width:553px; margin:10px 0 0;">
            <div style="display:flex; gap:6px;">
                <img src="/cmak/images/intro/about/intro2_1img2.gif" alt="회원의 품위 보전, 권익 옹호" style="flex:1; min-width:0; height:auto;">
                <img src="/cmak/images/intro/about/intro2_1img3.gif" alt="CM 체계확립 및 확대 보급" style="flex:1; min-width:0; height:auto;">
                <img src="/cmak/images/intro/about/intro2_1img4.gif" alt="CM 체계를 통한 건설산업 및 국민경제 발전에 기여" style="flex:1; min-width:0; height:auto;">
            </div>

            <img src="/cmak/images/intro/about/intro2_1img5.gif" alt="" style="width:100%; display:block;">

            <img src="/cmak/images/intro/about/intro2_1img6.gif" alt="주요사업" style="width:100%; display:block;">
            <img src="/cmak/images/intro/about/intro2_1img7.gif" alt="주요사업 및 활동" style="width:100%; display:block;">
        </div>
    </div>

    <div class="sub-section" style="margin-top:30px;">
        <h3 class="sub-section-title">주요사업 목록 (텍스트)</h3>
        <ul style="padding-left:22px; line-height:2;">
            <li>CM의 이론체계확립을 위한 조사연구</li>
            <li>CM의 실용화 방안 구축을 위한 산·학협동 활동</li>
            <li>관련제도의 발전을 위한 조사·연구 및 개선건의</li>
            <li>CM관련 인력 및 기술의 개발관리 지원</li>
            <li>각종 자료 및 정보의 수집·보급과 관련 정보화사업 지원</li>
            <li>정부 또는 다른 기관이나 단체로부터 위탁받은 업무의 수행</li>
            <li>기타 CM의 발전에 필요한 제반 사업의 수행 등</li>
        </ul>
    </div>
</div>

<div class="sub-content-card" style="margin-top:30px;">
    <h2 class="sub-content-title">CI 소개</h2>

    <div class="sub-section" style="text-align:center;">
        <img src="/cmak/images/intro/about/ici_img1.gif" alt="CMAK Logo" style="max-width:264px;">
    </div>

    <div class="sub-section" style="margin-top:20px;">
        <p style="line-height:2;">
            투명성 또는 청렴성을 뜻하는 전체의 <span style="color:#0066cc;">파란 색상</span>은 하늘을 나타내며,
        </p>
        <p style="line-height:2;">
            맨 윗부분의 다섯개의 막대 형상은 <span style="color:#0066cc;">건설물과 CM의 비상 즉 세계화</span>를 상징하고,
        </p>
        <p style="line-height:2;">
            맨 아래의 수평적 막대 형상은 <span style="color:#0066cc;">땅 위에 설치된 건설물을 사람이 이용 함으로서 3자가 조화를 이루며 영구히 살아갈 수 있도록 하는 건설산업의 탄탄한 기반구축</span>을 의미함.
        </p>
        <p style="line-height:2;">
            또한 이들 중앙의 CMAK는 <span style="color:#0066cc;">이러한 건설산업을 우리 협회가 중심이 되어 견인해 나간다</span>는 뜻임.
        </p>
    </div>
</div>
@endsection
