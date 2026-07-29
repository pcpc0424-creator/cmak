@php $page = eng_page('about/organization'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Organization') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'Organization')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.eng-org-chart { display: flex; flex-direction: column; align-items: center; padding: 30px 0 10px; }
.eng-org-box { background: linear-gradient(135deg, #0a3d7c, #0061c2); color: #fff; padding: 16px 32px; border-radius: 10px; font-weight: 700; font-size: 16px; box-shadow: 0 8px 20px rgba(10,61,124,0.18); min-width: 200px; text-align:center; }
.eng-org-box.sub { background: #fff; color:#0a3d7c; border: 2px solid #0061c2; min-width: 180px; padding: 13px 22px; font-size: 14px; }
.eng-org-line { width: 2px; height: 28px; background: #0061c2; }
.eng-org-row { display: flex; flex-wrap: wrap; gap: 18px; justify-content: center; }
.eng-org-bracket { width: 80%; max-width: 720px; height: 2px; background: #0061c2; margin: 0 auto; }
/* 하단 본부 행: 상단 브래킷 + 각 박스 수직 연결선
   5칸을 등폭(flex:1 1 0)으로 고정해야 브래킷 양끝을 첫/마지막 박스 중앙에 맞출 수 있다.
   등폭일 때 한 칸 폭 = (100% - 4*gap)/5 이므로 첫 칸 중앙 = (100% - 4*gap)/10. */
.eng-org-divisions { display: flex; flex-wrap: nowrap; gap: 14px; justify-content: center; position: relative; padding-top: 20px; width: 100%; }
/* 버스 끝을 낙하선(2px) 바깥 모서리까지 1px 더 뻗는다.
   중앙 좌표에 딱 맞추면 calc 소수점 반올림 때문에 양 끝에 실틈이 생긴다. */
.eng-org-divisions::before { content: ''; position: absolute; top: 0; left: calc((100% - 56px) / 10 - 1px); right: calc((100% - 56px) / 10 - 1px); height: 2px; background: #0061c2; }
.eng-org-divisions .eng-org-box { position: relative; box-sizing: border-box; flex: 1 1 0; min-width: 0; padding: 13px 10px; font-size: 13px; }
.eng-org-divisions .eng-org-box::before { content: ''; position: absolute; top: -20px; left: calc(50% - 1px); width: 2px; height: 20px; background: #0061c2; }
/* 상단 회장 행: 본부 행과 같은 방식(가로 버스 + 낙하선)으로 연결한다.
   4칸 등폭이면 첫/마지막 칸 중앙 = (100% - 3*18px)/8 이고,
   행의 정중앙이 Chairman-Auditor 사이 18px 간격 한가운데에 정확히 떨어지므로
   그 자리로 세로선을 통과시켜 위(General Assembly)·아래(Standing Director)와 이을 수 있다. */
.eng-org-siderow { display: flex; flex-wrap: nowrap; gap: 18px; justify-content: center; position: relative; padding-top: 20px; width: 100%; }
.eng-org-siderow::before { content: ''; position: absolute; top: 0; left: calc((100% - 54px) / 8 - 1px); right: calc((100% - 54px) / 8 - 1px); height: 2px; background: #0061c2; }
.eng-org-siderow::after { content: ''; position: absolute; top: 0; bottom: 0; left: calc(50% - 1px); width: 2px; background: #0061c2; }
/* Chairman 만 테두리가 없어(나머지 3개는 border 2px) content-box 기준으로는 칸 폭이
   4px 어긋난다. border-box 로 고정해야 4칸이 진짜 등폭이 되고 버스 끝 계산이 맞는다. */
.eng-org-siderow > .eng-org-box { position: relative; box-sizing: border-box; flex: 1 1 0; min-width: 0; padding: 13px 10px; font-size: 13.5px; }
/* Chairman 에도 같은 두께의 (투명) 테두리를 줘서 4개 박스의 박스모델을 완전히 동일하게 만든다.
   테두리가 없으면 낙하선의 기준(패딩 박스)이 2px 어긋나 끝단이 맞지 않는다. */
.eng-org-siderow > .eng-org-box:not(.sub) { border: 2px solid transparent; }
.eng-org-siderow > .eng-org-box::before { content: ''; position: absolute; top: -20px; left: calc(50% - 1px); width: 2px; height: 20px; background: #0061c2; }
/* National Chapters 한 줄 배치 */
.eng-org-chapters { flex-wrap: nowrap; justify-content: center; overflow-x: auto; padding-bottom: 6px; }
.eng-org-chapters .eng-org-box { min-width: 0; flex: 1 1 0; padding: 12px 10px; font-size: 13px; white-space: nowrap; }
.eng-dept-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 18px; margin-top: 24px; }
.eng-dept { background: #f8f9fb; border: 1px solid #e8ecf1; border-radius: 12px; padding: 24px 26px; }
.eng-dept h4 { font-size: 16px; font-weight: 700; color: #0061c2; margin: 0 0 8px; }
.eng-dept p { font-size: 14px; color: #555; line-height: 1.7; margin: 0; }
@media (max-width: 700px) { .eng-dept-grid { grid-template-columns: 1fr; } }
/* 좁은 화면: 5칸 등폭이 뭉개지므로 줄바꿈을 허용하고, 이때는 연결선을 숨긴다
   (줄바꿈되면 브래킷/낙하선이 엉뚱한 위치를 가리켜 오히려 지저분해진다) */
@media (max-width: 860px) {
    .eng-org-divisions,
    .eng-org-siderow { flex-wrap: wrap; padding-top: 0; }
    .eng-org-divisions .eng-org-box,
    .eng-org-siderow > .eng-org-box { flex: 0 1 auto; min-width: 150px; }
    .eng-org-divisions::before,
    .eng-org-divisions .eng-org-box::before,
    .eng-org-siderow::before,
    .eng-org-siderow::after,
    .eng-org-siderow > .eng-org-box::before { display: none; }
}
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Organization' }}</h2>
    <p class="desc">{{ $page->description ?? 'The organizational structure of the Construction Management Association of Korea.' }}</p>

    <div class="eng-org-chart">
        <div class="eng-org-box">General Assembly</div>
        <div class="eng-org-line"></div>
        <div class="eng-org-row eng-org-siderow" style="align-items:center;">
            <div class="eng-org-box sub">Board of Directors</div>
            <div class="eng-org-box">Chairman</div>
            <div class="eng-org-box sub">Auditor</div>
            <div class="eng-org-box sub">Advisory Committee</div>
        </div>
        <div class="eng-org-line"></div>
        <div class="eng-org-box">Standing Director</div>
        <div class="eng-org-line"></div>
        <div class="eng-org-divisions">
            <div class="eng-org-box sub">Operation Support Division</div>
            <div class="eng-org-box sub">Policy &amp; Projects Division</div>
            <div class="eng-org-box sub">Education &amp; Training Division</div>
            <div class="eng-org-box sub">Business Support Division</div>
            <div class="eng-org-box sub">Construction Industry Research Center</div>
        </div>
    </div>

    <h3>Committees</h3>
    <div class="eng-dept-grid">
        <div class="eng-dept"><h4>Operation &amp; PR Committee</h4></div>
        <div class="eng-dept"><h4>Education &amp; Training Committee</h4></div>
        <div class="eng-dept"><h4>Survey &amp; Research Committee</h4></div>
        <div class="eng-dept"><h4>Contract, Claim &amp; Risk Management Committee</h4></div>
        <div class="eng-dept"><h4>Construction VE &amp; LCC Committee</h4></div>
        <div class="eng-dept"><h4>Construction Informatization Committee</h4></div>
        <div class="eng-dept"><h4>Overseas Expansion Committee</h4></div>
        <div class="eng-dept"><h4>CM Future Strategy Special Committee</h4></div>
    </div>

    <h3>National Chapters</h3>
    <div class="eng-org-row eng-org-chapters">
        <div class="eng-org-box sub">Seoul</div>
        <div class="eng-org-box sub">Jungbu (Central)</div>
        <div class="eng-org-box sub">Chungcheong</div>
        <div class="eng-org-box sub">Honam</div>
        <div class="eng-org-box sub">Yeongnam 1</div>
        <div class="eng-org-box sub">Yeongnam 2</div>
    </div>
</div>
@endsection
