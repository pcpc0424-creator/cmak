@extends('layouts.sub')

@section('title', '로그인 안내 - 한국CM협회')
@section('category', '안내')
@section('category-link', '/cmak')
@section('page-title', '로그인 안내')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">로그인 안내</h2>

    <div style="margin-top:20px; padding:30px; background:#f6f9fc; border:1px solid #dde3ed; border-radius:8px; text-align:center;">
        <div style="font-size:48px; margin-bottom:16px;">🔒</div>
        <h3 style="font-size:18px; color:#333; margin-bottom:12px;">홈페이지 리뉴얼 안내</h3>
        <p style="line-height:1.8; color:#555; font-size:14px; margin-bottom:20px;">
            현재 홈페이지가 리뉴얼 작업 중으로 로그인 및 회원가입 기능은 준비 중입니다.<br>
            회원가입을 원하시는 분은 아래 안내를 참고해 주시기 바랍니다.
        </p>

        <div style="margin-top:24px; padding:20px; background:#fff; border:1px solid #e0e0e0; border-radius:6px; text-align:left; max-width:500px; margin-left:auto; margin-right:auto;">
            <h4 style="color:#064277; margin-bottom:12px;">회원가입 문의</h4>
            <table style="width:100%; font-size:14px; line-height:2;">
                <tr>
                    <td style="width:80px; font-weight:bold; color:#555;">전화</td>
                    <td>02-585-4712~4</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555;">팩스</td>
                    <td>02-585-2689</td>
                </tr>
                <tr>
                    <td style="font-weight:bold; color:#555;">이메일</td>
                    <td><a href="mailto:cm@cmak.or.kr" style="color:#0061c2;">cm@cmak.or.kr</a></td>
                </tr>
            </table>
        </div>

        <div style="margin-top:20px;">
            <a href="/cmak/business/membership" style="display:inline-block; padding:10px 24px; background:#0061c2; color:#fff; border-radius:4px; text-decoration:none; font-weight:600;">회원가입 안내 바로가기</a>
        </div>
    </div>
</div>
@endsection
