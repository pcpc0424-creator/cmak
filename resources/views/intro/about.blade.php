@extends('layouts.sub')

@section('title', '협회안내 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/intro/greeting')
@section('page-title', '협회안내')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">협회안내</h2>
    <p class="sub-content-desc">한국CM협회의 설립목적과 주요사업을 소개합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">설립목적</h3>
        <p>
            한국CM협회는 「건설산업기본법」 제50조에 의거하여 설립된 법정단체로서,
            건설사업관리(CM)의 발전과 건설산업의 선진화를 목적으로 합니다.
            CM 전문기업의 권익을 보호하고, CM 제도의 발전과 관련 기술의 향상을 도모하며,
            건설산업의 국제 경쟁력 강화에 기여합니다.
        </p>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">주요사업</h3>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:16px;">
            @php
                $services = [
                    ['icon' => '📊', 'title' => 'CM능력평가·공시', 'desc' => '건설사업관리 기업의 능력을 객관적으로 평가하고 공시합니다.'],
                    ['icon' => '📝', 'title' => '자격검정', 'desc' => '건설사업관리사(CMP) 자격검정 시험을 주관합니다.'],
                    ['icon' => '🎓', 'title' => 'CM전문교육', 'desc' => '체계적인 교육 프로그램으로 CM 전문인력을 양성합니다.'],
                    ['icon' => '📋', 'title' => 'CM실적관리', 'desc' => 'CM 실적의 유지관리 및 확인서 발급 업무를 수행합니다.'],
                    ['icon' => '🔬', 'title' => '정책연구', 'desc' => 'CM 제도 발전을 위한 정책 연구 및 건의 활동을 합니다.'],
                    ['icon' => '🌐', 'title' => '국제교류', 'desc' => 'CONSMA 등 국제 활동을 통해 글로벌 네트워크를 구축합니다.'],
                ];
            @endphp
            @foreach($services as $service)
                <div class="sub-info-box" style="display:flex; gap:12px; align-items:flex-start;">
                    <span style="font-size:24px; line-height:1;">{{ $service['icon'] }}</span>
                    <div>
                        <dt>{{ $service['title'] }}</dt>
                        <dd>{{ $service['desc'] }}</dd>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">협회 개요</h3>
        <table class="sub-table">
            <tbody>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; width:150px; text-align:center;">명칭</td>
                    <td>사단법인 한국CM협회 (Construction Management Association of Korea)</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">설립일</td>
                    <td>1996년 5월</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">설립근거</td>
                    <td>건설산업기본법 제50조</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">회원사</td>
                    <td>178개사</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">소재지</td>
                    <td>서울특별시 서초구 서초대로 398 플라티넘타워 7층</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">대표전화</td>
                    <td>02-585-4712~3</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
