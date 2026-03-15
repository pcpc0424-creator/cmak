@extends('layouts.sub')

@section('title', '법령정보 - 한국CM협회')
@section('category', 'CM정보')
@section('category-link', '/cmak/cmdata/about')
@section('page-title', '법령정보')

@section('side-menu')
    @include('cmdata._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">법령정보</h2>
    <p class="sub-content-desc">건설사업관리 관련 법령 및 제도 정보를 제공합니다.</p>

    <div class="sub-section">
        <h3 class="sub-section-title">주요 법령</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:50px;">No.</th>
                    <th>법령명</th>
                    <th style="width:120px;">구분</th>
                    <th style="width:120px;">최근 개정</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="text-align:center;">1</td><td><a href="#" style="color:#0061c2;">건설산업기본법</a></td><td style="text-align:center;">법률</td><td style="text-align:center;">2025.12</td></tr>
                <tr><td style="text-align:center;">2</td><td><a href="#" style="color:#0061c2;">건설산업기본법 시행령</a></td><td style="text-align:center;">대통령령</td><td style="text-align:center;">2025.12</td></tr>
                <tr><td style="text-align:center;">3</td><td><a href="#" style="color:#0061c2;">건설산업기본법 시행규칙</a></td><td style="text-align:center;">부령</td><td style="text-align:center;">2025.11</td></tr>
                <tr><td style="text-align:center;">4</td><td><a href="#" style="color:#0061c2;">건설기술 진흥법</a></td><td style="text-align:center;">법률</td><td style="text-align:center;">2025.10</td></tr>
                <tr><td style="text-align:center;">5</td><td><a href="#" style="color:#0061c2;">건설기술 진흥법 시행령</a></td><td style="text-align:center;">대통령령</td><td style="text-align:center;">2025.10</td></tr>
                <tr><td style="text-align:center;">6</td><td><a href="#" style="color:#0061c2;">건설기술 진흥법 시행규칙</a></td><td style="text-align:center;">부령</td><td style="text-align:center;">2025.09</td></tr>
                <tr><td style="text-align:center;">7</td><td><a href="#" style="color:#0061c2;">건축법</a></td><td style="text-align:center;">법률</td><td style="text-align:center;">2025.08</td></tr>
                <tr><td style="text-align:center;">8</td><td><a href="#" style="color:#0061c2;">주택법</a></td><td style="text-align:center;">법률</td><td style="text-align:center;">2025.07</td></tr>
            </tbody>
        </table>
    </div>

    <div class="sub-section">
        <h3 class="sub-section-title">CM 관련 고시·지침</h3>
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:50px;">No.</th>
                    <th>고시/지침명</th>
                    <th style="width:120px;">소관부처</th>
                </tr>
            </thead>
            <tbody>
                <tr><td style="text-align:center;">1</td><td>건설사업관리능력 평가에 관한 고시</td><td style="text-align:center;">국토교통부</td></tr>
                <tr><td style="text-align:center;">2</td><td>건설사업관리 업무지침</td><td style="text-align:center;">국토교통부</td></tr>
                <tr><td style="text-align:center;">3</td><td>건설공사 사업관리방식 검토기준</td><td style="text-align:center;">국토교통부</td></tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
