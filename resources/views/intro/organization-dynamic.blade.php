@extends('layouts.sub')

@section('title', ($page->browser_title ?: $page->page_title . ' - 한국CM협회'))
@section('category', $page->category ?: '협회소개')
@section('category-link', $page->category_link ?: '/cmak/intro/organization')
@section('page-title', '조직 및 구성')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
    {{-- 우측 상단 탭 (기구표 / 집행부 / 지회 / 위원회) --}}
    <div class="org-tabs">
        @foreach($tabs as $key => $tab)
            <a href="/cmak/intro/organization{{ $key === 'chart' ? '' : '/' . $key }}"
               class="org-tab {{ $key === $activeTab ? 'is-active' : '' }}">{{ $tab['label'] }}</a>
        @endforeach
    </div>

    {!! $page->content !!}

    <style>
        .org-tabs {
            display: flex;
            justify-content: flex-end;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 24px;
            border-bottom: 2px solid #e5e8ec;
            padding-bottom: 0;
        }
        .org-tab {
            display: inline-block;
            padding: 10px 22px;
            font-size: 14.5px;
            font-weight: 600;
            color: #6b7280;
            background: #f4f6f8;
            border: 1px solid #e5e8ec;
            border-bottom: none;
            border-radius: 6px 6px 0 0;
            margin-bottom: -2px;
            transition: all .15s;
            white-space: nowrap;
        }
        .org-tab:hover {
            color: #1d4ed8;
            background: #eef2f7;
        }
        .org-tab.is-active {
            color: #fff;
            background: #1d4ed8;
            border-color: #1d4ed8;
        }
        @media (max-width: 640px) {
            .org-tabs { justify-content: center; }
            .org-tab { padding: 8px 14px; font-size: 13px; }
        }
    </style>
@endsection
