@extends('layouts.sub')

@section('title', 'FAQ - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', 'FAQ')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">자주 묻는 질문 (FAQ)</h2>
    <p class="sub-content-desc">자주 문의하시는 질문과 답변을 모았습니다.</p>

    <div x-data="{ open: null }">
        @if(isset($posts) && $posts->count() > 0)
            @foreach($posts as $i => $post)
                <div style="border:1px solid #e8ecf1; border-radius:8px; margin-bottom:8px; overflow:hidden;">
                    <button
                        @click="open = open === {{ $i }} ? null : {{ $i }}"
                        style="width:100%; text-align:left; padding:16px 20px; background:#fff; border:none; cursor:pointer; display:flex; justify-content:space-between; align-items:center; font-size:14px; font-weight:600; color:#1a1a1a;"
                    >
                        <span><span style="color:#0061c2; margin-right:8px;">Q.</span>{{ $post->title }}</span>
                        <span style="color:#999; font-size:18px; transition:transform 0.2s;" :style="open === {{ $i }} ? 'transform:rotate(180deg)' : ''">&#9660;</span>
                    </button>
                    <div x-show="open === {{ $i }}" x-transition style="padding:16px 20px 20px; background:#f8f9fb; border-top:1px solid #e8ecf1;">
                        <p style="font-size:14px; line-height:1.8; color:#444; margin:0;">
                            <span style="color:#0061c2; font-weight:600; margin-right:4px;">A.</span>{!! nl2br(e($post->content)) !!}
                        </p>
                    </div>
                </div>
            @endforeach

            @if($posts->hasPages())
                <div style="margin-top:24px; display:flex; justify-content:center; gap:4px; flex-wrap:wrap;">
                    @if($posts->onFirstPage())
                        <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">&#9664;</span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">&#9664;</a>
                    @endif

                    @php
                        $currentPage = $posts->currentPage();
                        $lastPage = $posts->lastPage();
                        $start = max(1, $currentPage - 4);
                        $end = min($lastPage, $start + 9);
                        if ($end - $start < 9) $start = max(1, $end - 9);
                    @endphp
                    @for($p = $start; $p <= $end; $p++)
                        @if($p == $currentPage)
                            <span style="padding:6px 12px; background:#0061c2; color:#fff; border-radius:4px; font-size:13px; font-weight:600;">{{ $p }}</span>
                        @else
                            <a href="{{ $posts->url($p) }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">{{ $p }}</a>
                        @endif
                    @endfor

                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">&#9654;</a>
                    @else
                        <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">&#9654;</span>
                    @endif
                </div>
            @endif
        @else
            <div style="text-align:center; padding:40px; color:#999; border:1px solid #e8ecf1; border-radius:8px;">
                등록된 FAQ가 없습니다.
            </div>
        @endif
    </div>
</div>
@endsection
