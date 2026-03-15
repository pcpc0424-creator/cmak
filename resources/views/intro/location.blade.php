@extends('layouts.sub')

@section('title', '찾아오시는 길 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/intro/greeting')
@section('page-title', '찾아오시는 길')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">찾아오시는 길</h2>
    <p class="sub-content-desc">한국CM협회 오시는 방법을 안내합니다.</p>

    {{-- 지도 --}}
    <div style="margin-bottom:30px; border-radius:8px; overflow:hidden; border:1px solid #e1e1e1;">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3165.5!2d127.0!3d37.49!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z7ISc7Jq47Yq567OE7IucIOyEnOy0iOq1rCDshJzstIjrjIDroZwgMzk4!5e0!3m2!1sko!2skr!4v1"
            width="100%"
            height="350"
            style="border:0; display:block;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    {{-- 주소 정보 --}}
    <div class="sub-section">
        <h3 class="sub-section-title">주소 및 연락처</h3>
        <table class="sub-table">
            <tbody>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; width:120px; text-align:center;">주소</td>
                    <td>
                        (06724) 서울특별시 서초구 서초대로 398 플라티넘타워 7층
                    </td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">대표전화</td>
                    <td>02-585-4712~3</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">팩스</td>
                    <td>02-585-4714</td>
                </tr>
                <tr>
                    <td style="background:#f0f4fa; font-weight:600; text-align:center;">이메일</td>
                    <td>cm@cmak.or.kr</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- 교통안내 --}}
    <div class="sub-section">
        <h3 class="sub-section-title">교통안내</h3>

        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap:16px;">
            <div class="sub-info-box">
                <dt>🚇 지하철</dt>
                <dd>
                    2호선 <strong>서초역</strong> 1번 출구 도보 5분<br>
                    3호선 <strong>교대역</strong> 6번 출구 도보 8분
                </dd>
            </div>
            <div class="sub-info-box">
                <dt>🚌 버스</dt>
                <dd>
                    서초역 정류장 하차<br>
                    간선: 140, 400, 406, 740<br>
                    지선: 4412, 서초08, 서초18
                </dd>
            </div>
            <div class="sub-info-box">
                <dt>🚗 자가용</dt>
                <dd>
                    플라티넘타워 지하주차장 이용<br>
                    방문 시 주차 1시간 무료
                </dd>
            </div>
        </div>
    </div>

    {{-- 원본 사이트 지도 이미지 (보조) --}}
    <div style="margin-top:20px; text-align:center;">
        <img src="https://www.cmak.or.kr/img/intro/map1.gif"
             alt="약도"
             class="sub-img-content"
             style="max-width:100%; border-radius:8px;"
             onerror="this.style.display='none'">
    </div>
</div>
@endsection
