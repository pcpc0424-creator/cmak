{{--
    메인 페이지 (Home) - CMAK 리뉴얼
    현재 cmak.or.kr 레이아웃 기반 + 최신 트렌드 적용

    구조:
    1. 메인 3단 레이아웃 (좌측 새소식/협회소식 + 중앙 뉴스탭/공지탭 + 우측 광고)
    2. 회원사 가로 배너 슬라이더
    3. 퀵메뉴 아이콘
    4. 전문가 칼럼 + BookReview
--}}
@extends('layouts.app')

@section('title', '한국CM협회 - 건설사업관리의 미래를 선도합니다')

@php
    use App\Data\HomeData;

    $latestNews = HomeData::getLatestNews();
    $associationNews = HomeData::getAssociationNews();
    $domesticNews = HomeData::getDomesticNews();
    $legalNews = HomeData::getLegalNews();
    $relatedOrgNews = HomeData::getRelatedOrgNews();
    $notices = HomeData::getNotices();
    $pressReleases = HomeData::getPressReleases();
    $memberBanners = HomeData::getMemberBanners();
    $sidebarAds = HomeData::getSidebarAds();
    $columns = HomeData::getExpertColumns();
    $bookReviews = HomeData::getBookReviews();
    $schedule = HomeData::getSchedule();
    $bids = HomeData::getBids();

    // 추가 데이터
    $specialFeatures = HomeData::getSpecialFeatures();
    $wordBook = HomeData::getWordBook();
    $memberTrends = HomeData::getMemberTrends();
    $cmCompany = HomeData::getCmCompanyIntro();
    $cmResources = HomeData::getCmResources();
    $relatedLinks = HomeData::getRelatedLinks();
@endphp

@section('content')
<main id="main-content" class="bg-gray-50 min-h-screen">

    {{-- 메인 배너 슬라이더 --}}
    @include('components.home.main-banner')

    {{-- 메인 콘텐츠 영역 --}}
    <section class="py-6 lg:py-8">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">

                {{-- 좌측 컬럼: 새소식 + 협회소식 --}}
                <div class="w-full lg:w-[280px] shrink-0 space-y-6">
                    @include('components.home.latest-news', [
                        'latestNews' => $latestNews,
                        'associationNews' => $associationNews
                    ])
                </div>

                {{-- 중앙 컬럼: 뉴스탭 + 공지사항탭 --}}
                <div class="flex-1 min-w-0 space-y-6">
                    {{-- 뉴스 탭 (국내외소식, 법령소식, 유관기관소식) --}}
                    @include('components.home.news-tabs', [
                        'domesticNews' => $domesticNews,
                        'legalNews' => $legalNews,
                        'relatedOrgNews' => $relatedOrgNews
                    ])

                    {{-- 공지사항/보도자료 탭 --}}
                    @include('components.home.notice-tabs', [
                        'notices' => $notices,
                        'pressReleases' => $pressReleases
                    ])
                </div>

                {{-- 우측 컬럼: 세로 광고 배너 --}}
                <aside class="hidden lg:block w-[180px] shrink-0" aria-label="광고">
                    @include('components.home.sidebar-ads', [
                        'ads' => $sidebarAds
                    ])
                </aside>

            </div>
        </div>
    </section>

    {{-- 회원사 가로 배너 슬라이더 --}}
    <section class="py-6 bg-white border-y border-gray-200">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            @include('components.home.member-banners', [
                'members' => $memberBanners
            ])
        </div>
    </section>

    {{-- 퀵메뉴 아이콘 영역 --}}
    <section class="py-8 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            @include('components.home.quick-icons', [
                'schedule' => $schedule
            ])
        </div>
    </section>

    {{-- 전문가 칼럼 + 기획특집 + 회원동향 (좌측) + BookReview/WordBook/광고 (우측) --}}
    <section class="py-8 bg-white border-t border-gray-100">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            @include('components.home.columns-section', [
                'columns' => $columns,
                'features' => $specialFeatures,
                'memberTrends' => $memberTrends,
                'bookReviews' => $bookReviews,
                'wordBook' => $wordBook,
                'sidebarAds' => array_slice($sidebarAds, 4, 5)
            ])
        </div>
    </section>

    {{-- 입·낙찰정보 + CM자료방 --}}
    <section class="py-8 bg-gray-50">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            @include('components.home.bids-resources', [
                'bids' => $bids,
                'resources' => $cmResources
            ])
        </div>
    </section>

    {{-- 관련기관 링크 배너 --}}
    <section class="py-8 bg-white border-t border-gray-200">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            @include('components.home.related-links', [
                'links' => $relatedLinks
            ])
        </div>
    </section>

</main>
@endsection
