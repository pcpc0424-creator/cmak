@extends('layouts.sub')

@section('title', '조직도 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/organization')
@section('page-title', '조직도')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">조직도</h2>

    <div class="sub-section org-wrap">
        {{-- 상단: 총회 → 회장 → 상임이사 --}}
        <div class="org-node org-node--main">총회</div>
        <div class="org-conn"></div>

        <div class="org-pres">
            <div class="org-branch org-branch--left"><div class="org-node org-node--sub">이사회</div></div>
            <div class="org-node org-node--main">회장</div>
            <div class="org-branch org-branch--right">
                <div class="org-node org-node--audit">감사</div>
                <div class="org-node org-node--sub">고문·자문위원회</div>
            </div>
        </div>
        <div class="org-conn"></div>

        <div class="org-node org-node--main">상임이사</div>
        <div class="org-conn"></div>

        {{-- 중단: 분야별 위원회 / 전국지회 --}}
        <div class="org-cols">
            <div class="org-list">
                <div class="org-list-title">분야별 위원회</div>
                @foreach([
                    '운영·홍보위원회','교육·훈련위원회','조사·연구위원회','계약·클레임·리스크관리위원회',
                    '건설VE·LCC위원회','건설정보화위원회','해외진출위원회','CM미래전략특별위원회',
                ] as $c)
                    <div class="org-list-item">{{ $c }}</div>
                @endforeach
            </div>
            <div class="org-list">
                <div class="org-list-title">전국지회</div>
                @foreach(['서울지회','중부지회','충청지회','호남지회','영남1지회','영남2지회'] as $b)
                    <div class="org-list-item">{{ $b }}</div>
                @endforeach
            </div>
        </div>
        <div class="org-conn"></div>

        {{-- 하단: 5개 본부 --}}
        <div class="org-divisions">
            @foreach(['운영지원본부','정책사업본부','교육훈련본부','사업지원본부','건설산업연구센터'] as $d)
                <div class="org-node org-node--division">{{ $d }}</div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .org-wrap { display:flex; flex-direction:column; align-items:center; margin-top:20px; }
    .org-node { display:flex; align-items:center; justify-content:center; text-align:center; border-radius:8px; font-weight:600; line-height:1.4; box-sizing:border-box; }
    .org-node--main { width:150px; min-height:60px; background:#0061c2; color:#fff; font-size:17px; padding:10px; }
    .org-node--sub { min-width:120px; min-height:44px; background:#eef3f9; border:1px solid #cdd8e6; color:#2c4a6b; font-size:14px; padding:8px 14px; }
    .org-node--audit { min-width:120px; min-height:44px; background:#fdf0e8; border:1px solid #f2d3bf; color:#b5652f; font-size:14px; padding:8px 14px; margin-bottom:8px; }
    .org-conn { width:2px; height:26px; background:#c2ccd8; }
    .org-pres { position:relative; display:flex; align-items:center; justify-content:center; gap:0; }
    .org-branch { position:absolute; top:50%; transform:translateY(-50%); }
    .org-branch--left { right:calc(50% + 95px); }
    .org-branch--left::after { content:''; position:absolute; top:50%; left:100%; width:20px; height:2px; background:#c2ccd8; }
    .org-branch--right { left:calc(50% + 95px); display:flex; flex-direction:column; align-items:flex-start; }
    .org-branch--right::before { content:''; position:absolute; top:50%; right:100%; width:20px; height:2px; background:#c2ccd8; transform:translateY(-50%); }
    .org-cols { display:flex; gap:40px; justify-content:center; align-items:flex-start; flex-wrap:wrap; position:relative; }
    .org-cols::before { content:''; position:absolute; top:-26px; left:0; right:0; height:2px; background:#c2ccd8; }
    .org-list { width:230px; border:1px solid #cdd8e6; border-radius:8px; overflow:hidden; background:#fff; position:relative; }
    .org-list::before { content:''; position:absolute; top:-26px; left:50%; width:2px; height:26px; background:#c2ccd8; }
    .org-list-title { background:#5b6b9e; color:#fff; text-align:center; padding:10px; font-weight:700; font-size:15px; }
    .org-list-item { padding:9px 12px; text-align:center; font-size:14px; color:#444; border-top:1px solid #eef1f5; }
    .org-divisions { display:flex; gap:14px; justify-content:center; flex-wrap:wrap; position:relative; }
    .org-divisions::before { content:''; position:absolute; top:-26px; left:15%; right:15%; height:2px; background:#c2ccd8; }
    .org-node--division { width:110px; min-height:64px; background:#7c93c4; color:#fff; font-size:14px; padding:10px 8px; position:relative; }
    .org-node--division::before { content:''; position:absolute; top:-26px; left:50%; width:2px; height:26px; background:#c2ccd8; }
    @media (max-width:640px) {
        .org-branch { position:static; transform:none; margin:8px 0; }
        .org-branch--left::after, .org-branch--right::before { display:none; }
        .org-pres { flex-direction:column; }
        .org-node--main { width:130px; font-size:15px; }
    }
</style>
@endsection
