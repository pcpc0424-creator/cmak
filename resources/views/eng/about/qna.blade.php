@php $page = eng_page('about/qna'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Q&A') . ' - CMAK')
@section('hero', true)
@section('category', 'About CMAK')
@section('category-link', '/cmak/eng/about/greeting')
@section('page-title', $page->title ?? 'Q&A')
@section('side-menu')
    @include('eng.about._side')
@endsection

@push('styles')
<style>
.qna-list { margin-top: 24px; }
.qna-item { border: 1px solid #e8ecf1; border-radius: 10px; margin-bottom: 16px; overflow: hidden; }
.qna-question {
    display: flex; align-items: center; gap: 14px;
    padding: 18px 24px;
    background: #f8f9fb;
    font-size: 15px; font-weight: 600; color: #1a1a1a;
    cursor: pointer; border: none; width: 100%; text-align: left;
}
.qna-question .q-badge {
    display: inline-flex; align-items: center; justify-content: center;
    width: 28px; height: 28px; flex-shrink: 0;
    background: #0061c2; color: #fff;
    font-size: 13px; font-weight: 700; border-radius: 6px;
}
.qna-answer {
    padding: 20px 24px 20px 66px;
    font-size: 14px; line-height: 1.8; color: #444;
    border-top: 1px solid #e8ecf1;
}
</style>
@endpush

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Q&A' }}</h2>
    <p class="desc">{{ $page->description ?? 'If you have any questions, please feel free to ask us.' }}</p>

    @if($page && $page->activeItems && $page->activeItems->count() > 0)
        <div class="qna-list">
            @foreach($page->activeItems as $item)
                <div class="qna-item" x-data="{ open: false }">
                    <button class="qna-question" @click="open = !open">
                        <span class="q-badge">Q</span>
                        <span style="flex:1;">{{ $item->title }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="qna-answer" x-show="open" x-cloak>
                        {!! nl2br(e($item->description)) !!}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="eng-info-box">
            <p>No questions have been posted yet. Please check back later.</p>
        </div>
    @endif

    <div class="eng-info-box" style="margin-top:30px;">
        <dl>
            <dt>Contact</dt>
            <dd>CMAK &nbsp;|&nbsp; TEL: (+82)10-2858-8788 &nbsp;|&nbsp; E-mail: margaretwon@cmak.or.kr</dd>
        </dl>
    </div>
</div>
@endsection
