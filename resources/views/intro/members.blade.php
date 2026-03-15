@extends('layouts.sub')

@section('title', '회원현황 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/intro/greeting')
@section('page-title', '회원현황')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원현황</h2>
    <p class="sub-content-desc">한국CM협회 회원사 현황입니다. (총 178개사)</p>

    {{-- 검색 바 --}}
    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <select style="padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px; color:#444;">
            <option>전체</option>
            <option>회사명</option>
            <option>지역</option>
        </select>
        <input type="text" placeholder="검색어를 입력하세요" style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </div>

    {{-- 회원사 테이블 --}}
    <div style="overflow-x:auto;">
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:50px;">No.</th>
                    <th style="width:80px;">구분</th>
                    <th>회사명</th>
                    <th style="width:130px;">대표전화</th>
                    <th style="width:130px;">FAX</th>
                    <th style="width:120px;">홈페이지</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $members = [
                        ['no' => 178, 'type' => '정회원', 'name' => '건일엔지니어링', 'phone' => '(054)284-0195', 'fax' => '(054)284-0196', 'url' => 'kunileng.co.kr'],
                        ['no' => 177, 'type' => '정회원', 'name' => '제이앤건축사사무소', 'phone' => '064-727-4567', 'fax' => '064-727-4566', 'url' => ''],
                        ['no' => 176, 'type' => '정회원', 'name' => '가우리안', 'phone' => '(031)900-1600', 'fax' => '(031)900-1692', 'url' => 'gaurian.com'],
                        ['no' => 175, 'type' => '정회원', 'name' => '간삼종합건축사사무소', 'phone' => '(02)2250-6000', 'fax' => '(02)2253-0244', 'url' => 'gansam.com'],
                        ['no' => 174, 'type' => '정회원', 'name' => 'CM지성건축사사무소', 'phone' => '(02)718-6650', 'fax' => '(02)718-6658', 'url' => 'cmjisung.com'],
                        ['no' => 173, 'type' => '정회원', 'name' => '건축종합건축사사무소', 'phone' => '(02)514-0025', 'fax' => '(02)512-4664', 'url' => ''],
                        ['no' => 172, 'type' => '정회원', 'name' => '건축사사무소 가온', 'phone' => '02-408-0108', 'fax' => '070-4495-6977', 'url' => 'gaonarchi.com'],
                        ['no' => 171, 'type' => '정회원', 'name' => '건원엔지니어링', 'phone' => '(02)3458-2800', 'fax' => '(02)556-3523', 'url' => 'kunwoneng.com'],
                        ['no' => 170, 'type' => '정회원', 'name' => '건축사사무소 광장', 'phone' => '(031)898-3535', 'fax' => '(031)624-4793', 'url' => 'kwangjangarch.com'],
                        ['no' => 169, 'type' => '정회원', 'name' => '금남건설', 'phone' => '(02)2210-0500', 'fax' => '(02)2210-0199', 'url' => 'kne.co.kr'],
                        ['no' => 168, 'type' => '정회원', 'name' => '해안건축', 'phone' => '(02)2190-2000', 'fax' => '(02)2190-2099', 'url' => 'haeahn.com'],
                        ['no' => 167, 'type' => '정회원', 'name' => '희림종합건축사사무소', 'phone' => '(02)3438-8800', 'fax' => '(02)3438-8899', 'url' => 'heerim.com'],
                        ['no' => 166, 'type' => '정회원', 'name' => '신화엔지니어링', 'phone' => '(02)519-0041', 'fax' => '(02)519-0043', 'url' => 'shinhwaeng.com'],
                        ['no' => 165, 'type' => '정회원', 'name' => '정림건축종합건축사사무소', 'phone' => '(02)708-8600', 'fax' => '(02)708-8700', 'url' => 'junglim.com'],
                        ['no' => 164, 'type' => '정회원', 'name' => '포스코A&C', 'phone' => '(054)220-6114', 'fax' => '(054)220-6100', 'url' => 'poscoanc.com'],
                    ];
                @endphp
                @foreach($members as $member)
                    <tr>
                        <td style="text-align:center;">{{ $member['no'] }}</td>
                        <td style="text-align:center;">{{ $member['type'] }}</td>
                        <td style="font-weight:500;">{{ $member['name'] }}</td>
                        <td style="text-align:center; font-size:13px;">{{ $member['phone'] }}</td>
                        <td style="text-align:center; font-size:13px;">{{ $member['fax'] }}</td>
                        <td style="text-align:center;">
                            @if($member['url'])
                                <a href="http://{{ $member['url'] }}" target="_blank" style="color:#0061c2; font-size:12px;">{{ $member['url'] }}</a>
                            @else
                                <span style="color:#ccc;">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 페이지네이션 --}}
    <div style="display:flex; justify-content:center; gap:4px; margin-top:24px;">
        <span style="padding:6px 10px; font-size:13px; color:#999;">◀</span>
        <span style="padding:6px 10px; font-size:13px; background:#0061c2; color:#fff; border-radius:4px; font-weight:600;">1</span>
        @for($i = 2; $i <= 10; $i++)
            <a href="#" style="padding:6px 10px; font-size:13px; color:#666; text-decoration:none;">{{ $i }}</a>
        @endfor
        <span style="padding:6px 10px; font-size:13px; color:#666;">…</span>
        <a href="#" style="padding:6px 10px; font-size:13px; color:#666; text-decoration:none;">18</a>
        <span style="padding:6px 10px; font-size:13px; color:#666;">▶</span>
    </div>
</div>
@endsection
