@extends('layouts.sub')

@section('title', '입찰소식 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', '입찰소식')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
@php $basePath = '/cmak'; @endphp
<div class="sub-content-card">
    <h2 class="sub-content-title">입찰소식</h2>
    <p class="sub-content-desc">건설사업관리 관련 입찰 정보입니다.</p>

    {{-- 검색 폼 --}}
    <div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
        <form action="" method="GET" style="display:flex; gap:8px; flex:1; min-width:200px;">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="공고명/발주자 검색"
                   style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
            <button type="submit" style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
        </form>
    </div>

    @if(isset($posts) && $posts->count() > 0)
        <div style="overflow-x:auto;">
            <table class="sub-table" style="min-width:760px;">
                <thead>
                    <tr style="background:#f4f6fb;">
                        <th style="width:55px;">No.</th>
                        <th>제 목</th>
                        <th style="width:140px;">발주자</th>
                        <th style="width:100px; white-space:nowrap;">공고일</th>
                        <th style="width:100px; white-space:nowrap;">마감일</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($posts as $index => $post)
                        @php
                            $meta = is_array($post->metadata) ? $post->metadata : [];
                            $announce = $meta['announcement_date'] ?? null;
                            $deadline = $meta['deadline_date'] ?? null;
                        @endphp
                        <tr>
                            <td style="text-align:center;">{{ $posts->total() - ($posts->firstItem() - 1) - $index }}</td>
                            <td>
                                <a href="{{ $basePath }}/board/{{ $boardType }}/{{ $post->id }}" style="color:#333; text-decoration:none;">
                                    {{ $post->title }}
                                </a>
                            </td>
                            <td style="text-align:center; font-size:13px; color:#555;">{{ $meta['ordering_office'] ?? '-' }}</td>
                            <td style="text-align:center; font-size:12px; color:#888; white-space:nowrap;">
                                {{ $announce ? \Carbon\Carbon::parse($announce)->format('y.m.d') : '-' }}
                            </td>
                            <td style="text-align:center; font-size:12px; color:#888; white-space:nowrap;">
                                {{ $deadline ? \Carbon\Carbon::parse($deadline)->format('y.m.d') : '-' }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div style="margin-top:24px; display:flex; justify-content:center; gap:4px; flex-wrap:wrap;">
                @if($posts->onFirstPage())
                    <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">◀</span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">◀</a>
                @endif

                @php
                    $currentPage = $posts->currentPage();
                    $lastPage = $posts->lastPage();
                    $start = max(1, $currentPage - 4);
                    $end = min($lastPage, $start + 9);
                    if ($end - $start < 9) $start = max(1, $end - 9);
                @endphp
                @for($i = $start; $i <= $end; $i++)
                    @if($i == $currentPage)
                        <span style="padding:6px 12px; background:#0061c2; color:#fff; border-radius:4px; font-size:13px; font-weight:600;">{{ $i }}</span>
                    @else
                        <a href="{{ $posts->url($i) }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">{{ $i }}</a>
                    @endif
                @endfor

                @if($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">▶</a>
                @else
                    <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">▶</span>
                @endif
            </div>
        @endif
    @else
        <div style="text-align:center; padding:40px; color:#999;">
            @if(request('search'))
                '{{ request('search') }}'에 대한 검색 결과가 없습니다.
            @else
                등록된 게시물이 없습니다.
            @endif
        </div>
    @endif
</div>
@endsection
