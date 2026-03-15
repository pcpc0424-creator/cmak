@extends('layouts.sub')

@section('title', '유관기관소식 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', '유관기관소식')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">유관기관소식</h2>
    <p class="sub-content-desc">유관기관의 주요 소식입니다.</p>

    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <input type="text" placeholder="검색어를 입력하세요" style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </div>

    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                <th style="width:100px;">조회</th>
                <th style="width:110px;">등록일</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" style="text-align:center; padding:40px; color:#999;">
                    등록된 게시물이 없습니다.
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection