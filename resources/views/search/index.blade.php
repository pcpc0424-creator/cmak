@extends('layouts.sub')

@section('title', '통합검색 - 한국CM협회')
@section('category', '검색')
@section('category-link', '/cmak/search')
@section('page-title', '통합검색')

@section('content')
@php $bp = '/cmak'; @endphp
<div class="sub-content-card">
    <h2 class="sub-content-title">통합검색</h2>

    <form method="GET" action="{{ $bp }}/search" style="display:flex; gap:8px; margin:18px 0 24px; max-width:560px;">
        <input type="text" name="q" value="{{ $q }}" placeholder="검색어를 입력하세요"
               style="flex:1; padding:10px 14px; border:1px solid #c8d0db; border-radius:4px; font-size:14px;">
        <button type="submit"
                style="padding:10px 24px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:14px; font-weight:600; cursor:pointer;">검색</button>
    </form>

    @if($q === '')
        <p style="color:#888; padding:24px 0;">검색어를 입력해주세요.</p>
    @elseif($results->isEmpty())
        <p style="color:#888; padding:24px 0;">'{{ $q }}'에 대한 검색 결과가 없습니다.</p>
    @else
        <p style="color:#555; font-size:14px; margin-bottom:14px;">
            '<strong style="color:#0061c2;">{{ $q }}</strong>'에 대한 검색 결과 <strong>{{ $results->total() }}</strong>건
        </p>

        @php
            $boardLabels = config('boards');
        @endphp

        <ul style="list-style:none; padding:0; margin:0;">
            @foreach($results as $post)
                @php
                    $label = $boardLabels[$post->board_type]['name'] ?? $post->board_type;
                @endphp
                <li style="padding:16px 4px; border-bottom:1px solid #eef1f5;">
                    <div style="display:flex; gap:8px; align-items:center; margin-bottom:6px;">
                        <span style="padding:2px 8px; background:#eef4fc; color:#0061c2; border-radius:3px; font-size:12px; font-weight:600;">{{ $label }}</span>
                        <span style="font-size:12px; color:#999;">{{ $post->published_at ? $post->published_at->format('Y-m-d') : '' }}</span>
                    </div>
                    <a href="{{ $bp }}/board/{{ $post->board_type }}/{{ $post->id }}"
                       style="display:block; font-size:15px; color:#222; font-weight:600; text-decoration:none; margin-bottom:4px;">
                        {{ $post->title }}
                    </a>
                    <p style="font-size:13px; color:#666; line-height:1.6; margin:0;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}
                    </p>
                </li>
            @endforeach
        </ul>

        <div style="margin-top:24px;">
            {{ $results->links() }}
        </div>
    @endif
</div>
@endsection
