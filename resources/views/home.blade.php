{{-- CMAK 메인 페이지 - fullpage 스냅 스크롤 --}}
@extends('layouts.app')

@section('title', '한국CM협회 - 건설사업관리의 미래를 선도합니다')

@php
    use App\Data\HomeData;
    $notices = HomeData::getNotices();
    $pressReleases = HomeData::getPressReleases();
    $bids = HomeData::getBids();
    $domesticNews = HomeData::getDomesticNews();
    $legalNews = HomeData::getLegalNews();
    $relatedOrgNews = HomeData::getRelatedOrgNews();
    $news = HomeData::getNews();
    $memberTrends = HomeData::getMemberTrends();
    $resources = HomeData::getCmResources();
@endphp

@section('content')

    {{-- 섹션 1: 메인 비주얼 --}}
    <section class="fp-section">
        @include('components.home.hero-section')
    </section>

    {{-- 섹션 2: 콘텐츠 + 푸터 --}}
    <section class="fp-section">
        <div class="fp-section-inner">
            <div class="icak-content-section">
                <div class="icak-content-inner">

                    {{-- ===== 1행 ===== --}}
                    <div class="icak-row">
                        {{-- 좌: 4칸 가로 --}}
                        <div class="icak-block-left">
                            <div class="icak-grid4">
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">국내외소식</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($domesticNews, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">입찰소식</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($bids, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">법령소식</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($legalNews, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">유관기관 소식</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($relatedOrgNews, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- 우: 3칸 가로 --}}
                        <div class="icak-block-right">
                            <div class="icak-grid3">
                                <a href="/business/education" class="icak-mini-card">CM매뉴얼</a>
                                <a href="/cmdata/book/1" class="icak-mini-card">Book Review</a>
                                <a href="/cmdata/wordbook/1" class="icak-mini-card">Word Book</a>
                            </div>
                        </div>
                    </div>

                    {{-- ===== 2행 ===== --}}
                    <div class="icak-row">
                        {{-- 좌: 4칸 가로 --}}
                        <div class="icak-block-left">
                            <div class="icak-grid4">
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">협회소식</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($news, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">보도자료</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($pressReleases, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['title'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">회원동향</h3>
                                    <ul class="icak-cell-list">
                                        @foreach(array_slice($memberTrends, 0, 4) as $item)
                                            <li><a href="{{ $item['link'] }}">{{ $item['company'] }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="icak-cell">
                                    <h3 class="icak-cell-title">인사·경조사</h3>
                                    <ul class="icak-cell-list">
                                        <li><a href="/community/board/1">2026년 신년 인사</a></li>
                                        <li><a href="/community/board/2">제30회 정기총회 축하</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        {{-- 우: 3칸 가로 --}}
                        <div class="icak-block-right">
                            <div class="icak-grid3">
                                <a href="/business/herald" class="icak-mini-card">CM헤럴드</a>
                                <a href="/archive/cm" class="icak-mini-card">CM자료방</a>
                                <a href="/intro/members" class="icak-mini-card">CM사 소개</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- 푸터 --}}
            @include('components.footer')
        </div>
    </section>

@endsection
