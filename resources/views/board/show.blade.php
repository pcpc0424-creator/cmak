@extends('layouts.sub')

@section('title', $post->title . ' - 한국CM협회')
@section('category', $boardConfig['menu'] ?? '')
@section('page-title', $boardConfig['name'] ?? '')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title" style="font-size:18px; margin-bottom:16px;">{{ $post->title }}</h2>

    <div style="display:flex; gap:16px; padding:12px 0; border-top:1px solid #e8ecf1; border-bottom:1px solid #e8ecf1; margin-bottom:24px; font-size:13px; color:#888;">
        @if($post->author)
            <span>작성자: {{ $post->author }}</span>
        @endif
        <span>등록일: {{ $post->published_at ? $post->published_at->format('Y-m-d') : ($post->created_at ? $post->created_at->format('Y-m-d') : '-') }}</span>
        <span>조회: {{ number_format($post->view_count) }}</span>
    </div>

    <div style="min-height:200px; padding:16px 0; line-height:1.8; font-size:14px; color:#333;">
        @php
            $content = $post->content;
            // <BODY> 태그 안쪽 내용만 추출
            if (preg_match('/<body[^>]*>(.*)<\/body>/is', $content, $m)) {
                $content = $m[1];
            }
            // <HTML>, <HEAD> 등 문서 레벨 태그 제거
            $content = preg_replace('/<\/?(html|head|meta|!doctype)[^>]*>/i', '', $content);
            $content = trim($content);
            // HTML 블록 태그가 없는 순수 텍스트면 줄바꿈을 <br>로 변환
            if (!preg_match('/<(div|p|br|table|ul|ol|h[1-6])/i', $content)) {
                $content = nl2br(e($content));
            }
        @endphp
        {!! $content !!}
    </div>

    @if($post->attachments->count() > 0)
        <div style="margin-top:24px; padding:16px 20px; background:#f8f9fb; border:1px solid #e8ecf1; border-radius:6px;">
            <div style="font-size:13px; font-weight:600; color:#555; margin-bottom:10px;">
                첨부파일 ({{ $post->attachments->count() }}개)
            </div>
            @foreach($post->attachments as $attachment)
                <div style="display:flex; align-items:center; gap:8px; padding:6px 0; {{ !$loop->last ? 'border-bottom:1px solid #e8ecf1;' : '' }}">
                    <svg style="width:16px; height:16px; color:#888; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    <a href="/cmak/{{ $attachment->file_path }}" target="_blank" download
                       style="font-size:13px; color:#0061c2; text-decoration:none;">
                        {{ $attachment->file_name }}
                    </a>
                    @if($attachment->file_size)
                        <span style="font-size:11px; color:#aaa;">({{ number_format($attachment->file_size / 1024, 1) }} KB)</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    <div style="margin-top:32px; padding-top:16px; border-top:1px solid #e8ecf1; text-align:center;">
        <a href="javascript:history.back()" style="display:inline-block; padding:8px 24px; background:#555; color:#fff; border-radius:4px; font-size:13px; text-decoration:none;">목록으로</a>
    </div>
</div>
@endsection
