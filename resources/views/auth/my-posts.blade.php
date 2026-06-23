@extends('layouts.sub')

@section('title', '내가 쓴 글 - 한국CM협회')
@section('category', '회원')
@section('category-link', '/cmak/mypage')
@section('page-title', '마이페이지')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">내가 쓴 글</h2>
    <p class="sub-content-desc">내가 작성한 게시글 목록입니다.</p>

    @include('auth._mypage-nav', ['active' => 'posts'])

    @if (session('success'))
        <div style="margin:16px 0; padding:12px 14px; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; color:#15803d; font-size:13px;">
            {{ session('success') }}
        </div>
    @endif

    @php $memberBoards = ['job_offer', 'job_seek']; @endphp

    @if($posts->count() > 0)
        <table class="sub-table">
            <thead>
                <tr>
                    <th style="width:50px;">No.</th>
                    <th style="width:100px;">게시판</th>
                    <th>제목</th>
                    <th style="width:60px;">조회</th>
                    <th style="width:100px; white-space:nowrap;">등록일</th>
                    <th style="width:110px;">관리</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $index => $post)
                    @php
                        $cfg = config('boards.' . $post->board_type);
                        $boardName = $cfg['name'] ?? $post->board_type;
                        $canEdit = in_array($post->board_type, $memberBoards, true);
                    @endphp
                    <tr>
                        <td style="text-align:center;">{{ $posts->total() - ($posts->firstItem() - 1) - $index }}</td>
                        <td style="text-align:center; color:#888; font-size:12px;">{{ $boardName }}</td>
                        <td>
                            <a href="/cmak/board/{{ $post->board_type }}/{{ $post->id }}" style="color:#333; text-decoration:none;">{{ $post->title }}</a>
                        </td>
                        <td style="text-align:center; color:#888;">{{ number_format($post->view_count ?? 0) }}</td>
                        <td style="text-align:center; color:#888; font-size:12px; white-space:nowrap;">
                            {{ $post->published_at ? $post->published_at->format('Y-m-d') : ($post->created_at ? $post->created_at->format('Y-m-d') : '-') }}
                        </td>
                        <td style="text-align:center;">
                            @if($canEdit)
                                <a href="/cmak/board/{{ $post->board_type }}/{{ $post->id }}/edit" style="display:inline-block; padding:4px 10px; background:#265de8; color:#fff; border-radius:4px; font-size:12px; text-decoration:none;">수정</a>
                                <form action="/cmak/board/{{ $post->board_type }}/{{ $post->id }}" method="POST" style="display:inline; margin:0;" onsubmit="return confirm('이 글을 삭제하시겠습니까?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="padding:4px 10px; background:#d04444; color:#fff; border:0; border-radius:4px; font-size:12px; cursor:pointer;">삭제</button>
                                </form>
                            @else
                                <span style="color:#bbb; font-size:12px;">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($posts->hasPages())
            <div style="margin-top:24px;">{{ $posts->links() }}</div>
        @endif
    @else
        <table class="sub-table">
            <thead>
                <tr><th>제목</th><th style="width:110px;">등록일</th></tr>
            </thead>
            <tbody>
                <tr><td colspan="2" style="text-align:center; padding:40px; color:#999;">작성한 게시물이 없습니다.</td></tr>
            </tbody>
        </table>
    @endif
</div>
@endsection
