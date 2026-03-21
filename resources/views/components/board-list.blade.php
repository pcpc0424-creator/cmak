{{-- 게시판 공통 목록 컴포넌트 --}}
@php $basePath = '/cmak'; @endphp

<div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
    <form action="" method="GET" style="display:flex; gap:8px; flex:1; min-width:200px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="검색어를 입력하세요"
               style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button type="submit" style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </form>
</div>

@if(isset($posts) && $posts->count() > 0)
    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                @if(!($hideAuthor ?? false))
                    <th style="width:80px;">작성자</th>
                @endif
                <th style="width:60px;">조회</th>
                <th style="width:100px;">등록일</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index => $post)
                <tr>
                    <td style="text-align:center;">{{ $posts->total() - ($posts->firstItem() - 1) - $index }}</td>
                    <td>
                        <a href="{{ $basePath }}/board/{{ $boardType }}/{{ $post->id }}" style="color:#333; text-decoration:none;">
                            {{ $post->title }}
                        </a>
                    </td>
                    @if(!($hideAuthor ?? false))
                        <td style="text-align:center; color:#888; font-size:12px;">{{ $post->author ?? '-' }}</td>
                    @endif
                    <td style="text-align:center; color:#888;">{{ number_format($post->view_count ?? 0) }}</td>
                    <td style="text-align:center; color:#888; font-size:12px;">
                        {{ $post->published_at ? $post->published_at->format('Y-m-d') : ($post->created_at ? $post->created_at->format('Y-m-d') : '-') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 페이지네이션 --}}
    @if($posts->hasPages())
        <div style="margin-top:24px; display:flex; justify-content:center; gap:4px; flex-wrap:wrap;">
            {{-- 이전 --}}
            @if($posts->onFirstPage())
                <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">◀</span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">◀</a>
            @endif

            {{-- 페이지 번호 --}}
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

            {{-- 다음 --}}
            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">▶</a>
            @else
                <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">▶</span>
            @endif
        </div>
    @endif
@else
    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                <th style="width:60px;">조회</th>
                <th style="width:100px;">등록일</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" style="text-align:center; padding:40px; color:#999;">
                    @if(request('search'))
                        '{{ request('search') }}'에 대한 검색 결과가 없습니다.
                    @else
                        등록된 게시물이 없습니다.
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
@endif
