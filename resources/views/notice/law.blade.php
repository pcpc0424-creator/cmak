@extends('layouts.sub')

@section('title', '법령소식 - 한국CM협회')
@section('category', '알림마당')
@section('category-link', '/cmak/notice/news')
@section('page-title', '법령소식')

@section('side-menu')
    @include('notice._side-menu')
@endsection

@section('content')
@php $bp = '/cmak'; @endphp
<div class="sub-content-card">
    <h2 class="sub-content-title">법령소식</h2>
    <p class="sub-content-desc">건설사업관리 관련 법령 소식입니다.</p>

    @php
        $categories = [
            '' => '전체',
            'law' => '법·시행령·시행규칙',
            'rule' => '훈령·지침·고시',
            'preview' => '입법예고',
        ];
        $selectedCategory = request('law_category', '');
        $categoryLabels = ['law' => '법·시행령·시행규칙', 'rule' => '훈령·지침·고시', 'preview' => '입법예고'];
    @endphp

    <div style="display:flex; gap:6px; margin-bottom:16px; flex-wrap:wrap;">
        @foreach($categories as $key => $label)
            <a href="?law_category={{ $key }}"
               style="padding:6px 14px; border:1px solid {{ $selectedCategory === $key ? '#0061c2' : '#dde3ed' }}; background:{{ $selectedCategory === $key ? '#0061c2' : '#fff' }}; color:{{ $selectedCategory === $key ? '#fff' : '#555' }}; border-radius:20px; font-size:13px; text-decoration:none; font-weight:{{ $selectedCategory === $key ? '600' : '400' }};">
                {{ $label }}
            </a>
        @endforeach
    </div>

    @include('components.board-list', [
        'columns' => [
            ['label' => '구분', 'field' => 'metadata.law_category', 'style' => 'width:130px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:110px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '첨부파일', 'field' => 'attachment', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center;'],
        ],
    ])
</div>
@endsection
