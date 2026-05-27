@extends('layouts.sub')

@section('title', '찾아오시는 길 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/location')
@section('page-title', '찾아오시는 길')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">찾아오시는 길</h2>

    <div class="sub-section" style="margin-top:20px;">
        <div style="border:1px solid #e0e0e0; border-radius:8px; overflow:hidden;">
            <iframe
                src="https://www.google.com/maps?q=서울특별시+서초구+서초대로+88+유니온빌딩&output=embed&hl=ko"
                width="100%" height="450" style="border:0; display:block;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div class="sub-section" style="margin-top:20px;">
        <table class="sub-table">
            <tbody>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold; width:160px; text-align:center;">위치</td>
                    <td>지하철 7호선 내방역 ④번출구에서 100m</td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold; text-align:center;">주소</td>
                    <td>(06673) 서울시 서초구 서초대로 88 (방배동 938-7, 유니온빌딩 4층)</td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold; text-align:center;">전화</td>
                    <td>02) 585-4712~4</td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold; text-align:center;">팩스</td>
                    <td>02) 585-2689</td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold; text-align:center;">이메일</td>
                    <td>cm@cmak.or.kr</td>
                </tr>
                <tr>
                    <td style="background:#EDEFDE; font-weight:bold; text-align:center;">홈페이지</td>
                    <td>www.cmak.or.kr</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
