@extends('layouts.sub')

@section('title', '구인 - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', '구인')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">구인</h2>
    <p class="sub-content-desc">구인 정보입니다.</p>

    @auth
        <div style="display:flex; justify-content:flex-end; margin-bottom:12px;">
            <a href="/cmak/community/job-offer/write" style="display:inline-flex; align-items:center; gap:6px; padding:9px 18px; background:#265de8; color:#fff; border-radius:8px; font-size:13px; font-weight:600; text-decoration:none;">
                <span style="font-size:15px; line-height:1;">＋</span> 새 글 올리기
            </a>
        </div>
    @endauth

    @include('components.board-list', [
        'columns' => [
            ['label' => '지역', 'field' => 'metadata.region', 'style' => 'width:70px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '제목', 'field' => 'title', 'tdStyle' => ''],
            ['label' => '회사명', 'field' => 'metadata.company', 'style' => 'width:120px;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px;'],
            ['label' => '등록일', 'field' => 'published_at', 'style' => 'width:90px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '마감일', 'field' => 'metadata.deadline', 'style' => 'width:90px; white-space:nowrap;', 'tdStyle' => 'text-align:center; color:#888; font-size:12px; white-space:nowrap;'],
            ['label' => '조회수', 'field' => 'view_count', 'style' => 'width:55px;', 'tdStyle' => 'text-align:center; color:#888;'],
        ],
    ])
</div>
@endsection
