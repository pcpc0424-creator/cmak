@extends('layouts.sub')

@section('title', '회원사 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/members')
@section('page-title', '회원사')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">회원사 명단</h2>
    <p class="sub-content-desc">회사명 검색시 (주) 넣지 말고 검색해 주세요. &nbsp; [전체 {{ $members->total() }}개]</p>

    {{-- 검색 폼: 검색구분 + 검색어 --}}
    <form method="GET" action="/cmak/intro/members" style="display:flex; gap:6px; align-items:center; margin:20px 0 10px; flex-wrap:wrap;">
        <select name="search_type"
            style="padding:7px 10px; border:1px solid #c8d0db; border-radius:3px; font-size:13px; min-width:90px;">
            <option value="용역" {{ ($searchType ?? '') === '용역' ? 'selected' : '' }}>용역</option>
            <option value="시공" {{ ($searchType ?? '') === '시공' ? 'selected' : '' }}>시공</option>
            <option value="회사명" {{ ($searchType ?? '') === '회사명' ? 'selected' : '' }}>회사명</option>
            <option value="주소" {{ ($searchType ?? '') === '주소' ? 'selected' : '' }}>주소</option>
        </select>
        <input type="text" name="q" value="{{ $search }}" placeholder="검색어를 입력하세요"
            style="flex:1; min-width:200px; padding:7px 10px; border:1px solid #c8d0db; border-radius:3px; font-size:13px;">
        <button type="submit"
            style="padding:7px 18px; background:#0061c2; color:#fff; border:none; border-radius:3px; font-size:13px; font-weight:600; cursor:pointer; letter-spacing:0.5px;">SEARCH</button>
        @if($search !== '' || ($searchType ?? '') !== '' || ($selectedInitial ?? '') !== '')
            <a href="/cmak/intro/members"
                style="padding:7px 14px; background:#f3f4f6; color:#555; border:1px solid #c8d0db; border-radius:3px; font-size:13px; text-decoration:none;">초기화</a>
        @endif
    </form>

    {{-- 자음 인덱스 + 페이지 표시 --}}
    @php
        $keepParams = array_filter([
            'search_type' => $searchType ?? null,
            'q' => $search ?? null,
        ], fn($v) => $v !== null && $v !== '');
        $baseQuery = http_build_query($keepParams);
    @endphp
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; margin:14px 0; padding:10px 12px; background:#f8f9fb; border:1px solid #e5e8ee; border-radius:3px; flex-wrap:wrap;">
        <div style="display:flex; gap:2px; flex-wrap:wrap; font-size:13px;">
            <a href="/cmak/intro/members{{ $baseQuery ? '?'.$baseQuery : '' }}"
                style="padding:3px 8px; color:{{ empty($selectedInitial) ? '#0061c2' : '#555' }}; font-weight:{{ empty($selectedInitial) ? '700' : '400' }}; text-decoration:none;">전체</a>
            @foreach(['ㄱ','ㄴ','ㄷ','ㄹ','ㅁ','ㅂ','ㅅ','ㅇ','ㅈ','ㅊ','ㅋ','ㅌ','ㅍ','ㅎ'] as $cho)
                <a href="/cmak/intro/members?initial={{ urlencode($cho) }}{{ $baseQuery ? '&'.$baseQuery : '' }}"
                    style="padding:3px 8px; color:{{ ($selectedInitial ?? '') === $cho ? '#0061c2' : '#555' }}; font-weight:{{ ($selectedInitial ?? '') === $cho ? '700' : '400' }}; text-decoration:none;">{{ $cho }}</a>
            @endforeach
        </div>
        <div style="font-size:13px; color:#555;">
            Page No. : <strong style="color:#0061c2;">{{ $members->currentPage() }}</strong> / {{ max(1, $members->lastPage()) }}
        </div>
    </div>

    <div style="overflow-x:auto;">
        <table class="sub-table">
            <thead>
                <tr style="background:#EDEFDE;">
                    <th style="width:50px;">번호</th>
                    <th style="width:70px;">구분</th>
                    <th>회사명</th>
                    <th style="width:110px;">대표자</th>
                    <th style="width:130px;">연락처</th>
                    <th style="width:130px;">FAX</th>
                    <th>주소</th>
                </tr>
            </thead>
            <tbody>
                @forelse($members as $i => $m)
                    <tr>
                        <td style="text-align:center;">{{ ($members->currentPage() - 1) * $members->perPage() + $i + 1 }}</td>
                        <td style="text-align:center; font-size:13px;">{{ $m->company_type ?: '-' }}</td>
                        <td style="font-weight:500;">
                            @if($m->website)
                                <a href="{{ str_starts_with($m->website, 'http') ? $m->website : 'http://'.$m->website }}" target="_blank" style="color:#0061c2;">{{ $m->company_name }}</a>
                            @else
                                {{ $m->company_name }}
                            @endif
                        </td>
                        <td style="text-align:center;">{{ $m->representative ?: '-' }}</td>
                        <td style="text-align:center; font-size:13px; white-space:nowrap;">{{ $m->phone ?: '-' }}</td>
                        <td style="text-align:center; font-size:13px; white-space:nowrap;">{{ $m->fax ?: '-' }}</td>
                        <td style="font-size:13px; color:#555;">{{ $m->address ?: '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="7" style="text-align:center; padding:30px; color:#888;">검색 결과가 없습니다.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:24px;">
        {{ $members->links() }}
    </div>
</div>
@endsection
