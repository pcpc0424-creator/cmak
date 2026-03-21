<?php

namespace App\Data;

use Illuminate\Support\Facades\DB;

/**
 * 메인 페이지 데이터 - MySQL DB 연동 (posts 테이블 통합)
 */
class HomeData
{
    /**
     * board_type으로 최신 게시글 가져오기
     */
    private static function getPostsByBoard(string $boardType, int $limit = 5): array
    {
        $rows = DB::table('posts')
            ->where('board_type', $boardType)
            ->where('is_published', 1)
            ->whereNull('deleted_at')
            ->orderByDesc('published_at')
            ->limit($limit)
            ->get(['id', 'title', 'content', 'author', 'published_at', 'view_count']);

        return $rows->map(fn($r) => [
            'id' => $r->id,
            'title' => $r->title,
            'content' => $r->content,
            'author' => $r->author,
            'date' => $r->published_at ? date('Y-m-d', strtotime($r->published_at)) : '',
            'link' => '/cmak/notice',
        ])->toArray();
    }

    /**
     * 히어로 슬라이드 데이터 (이미지 유지)
     */
    public static function getHeroSlides(): array
    {
        return [
            [
                'id' => 1,
                'title' => '건설사업관리의 미래를 선도합니다',
                'subtitle' => '1996년 설립 이래 대한민국 CM 분야 발전을 위해 노력하고 있습니다',
                'image' => '/images/hero/slide1.jpg',
                'link' => '/intro/about',
            ],
            [
                'id' => 2,
                'title' => '2026년 CM 능력평가 공시 안내',
                'subtitle' => '건설사업관리 능력을 객관적으로 평가하고 공시합니다',
                'image' => '/images/hero/slide2.jpg',
                'link' => '/business/certification',
            ],
        ];
    }

    /**
     * 빠른 메뉴 데이터 (정적)
     */
    public static function getQuickMenus(): array
    {
        return [
            ['id' => 1, 'title' => '회원가입', 'description' => 'CM 전문기업 가입', 'icon' => 'users', 'link' => '/business/membership', 'color' => 'blue'],
            ['id' => 2, 'title' => 'CM 능력평가 공시', 'description' => '기업 능력평가', 'icon' => 'certificate', 'link' => '/business/certification', 'color' => 'indigo'],
            ['id' => 3, 'title' => '자격검정', 'description' => '건설사업관리사', 'icon' => 'academic', 'link' => '/business/inspection', 'color' => 'purple'],
            ['id' => 4, 'title' => 'CM 전문교육', 'description' => '역량 강화 교육', 'icon' => 'book', 'link' => '/business/education', 'color' => 'cyan'],
            ['id' => 5, 'title' => 'CM Herald', 'description' => '월간 소식지', 'icon' => 'newspaper', 'link' => '/business/herald', 'color' => 'orange'],
            ['id' => 6, 'title' => 'CM이란', 'description' => '건설사업관리 소개', 'icon' => 'info', 'link' => '/cmdata/about', 'color' => 'teal'],
        ];
    }

    /**
     * 공지사항 (협회소식)
     */
    public static function getNotices(): array
    {
        $posts = self::getPostsByBoard('news_association', 5);
        return array_map(fn($p) => array_merge($p, ['category' => '공지', 'isNew' => false, 'link' => '/cmak/notice/news']), $posts);
    }

    /**
     * 협회 소식
     */
    public static function getNews(): array
    {
        return self::getNotices();
    }

    /**
     * 주요 사업 데이터 (정적)
     */
    public static function getServices(): array
    {
        return [
            ['id' => 1, 'title' => '회원가입', 'description' => 'CM 전문기업으로서 협회 회원이 되어 다양한 혜택과 네트워크를 누리세요.', 'icon' => 'users', 'link' => '/business/membership', 'color' => 'blue'],
            ['id' => 2, 'title' => 'CM 능력평가 공시', 'description' => '기업의 CM 수행능력을 객관적으로 평가하고 공시합니다.', 'icon' => 'certificate', 'link' => '/business/certification', 'color' => 'indigo'],
            ['id' => 3, 'title' => '건설사업관리사 자격검정', 'description' => 'CM 전문가 양성을 위한 자격검정 시험을 주관합니다.', 'icon' => 'academic', 'link' => '/business/inspection', 'color' => 'purple'],
            ['id' => 4, 'title' => 'CM 전문교육', 'description' => '체계적인 교육 프로그램으로 CM 역량을 강화하세요.', 'icon' => 'book', 'link' => '/business/education', 'color' => 'cyan'],
        ];
    }

    /**
     * 입찰 정보
     */
    public static function getBids(): array
    {
        $posts = self::getPostsByBoard('news_bid', 5);
        return array_map(fn($p) => array_merge($p, ['type' => '입찰', 'link' => '/cmak/notice/bids']), $posts);
    }

    /**
     * 국내외소식
     */
    public static function getDomesticNews(): array
    {
        $posts = self::getPostsByBoard('news_domestic', 5);
        return array_map(fn($p) => array_merge($p, ['link' => '/cmak/notice/news']), $posts);
    }

    /**
     * 법령소식
     */
    public static function getLegalNews(): array
    {
        $posts = self::getPostsByBoard('news_law', 5);
        return array_map(fn($p) => array_merge($p, ['link' => '/cmak/notice/law']), $posts);
    }

    /**
     * 유관기관소식
     */
    public static function getRelatedOrgNews(): array
    {
        $posts = self::getPostsByBoard('news_bid', 5);
        return array_map(fn($p) => array_merge($p, ['link' => '/cmak/notice/org']), $posts);
    }

    /**
     * 보도자료
     */
    public static function getPressReleases(): array
    {
        $posts = self::getPostsByBoard('news_press', 5);
        return array_map(fn($p) => array_merge($p, ['link' => '/cmak/notice/press']), $posts);
    }

    /**
     * 전문가 칼럼
     */
    public static function getExpertColumns(): array
    {
        $posts = self::getPostsByBoard('expert_column', 5);
        return array_map(fn($p) => array_merge($p, ['summary' => '', 'isFeatured' => false, 'link' => '/cmak/cmdata/expert']), $posts);
    }

    /**
     * 회원동향
     */
    public static function getMemberTrends(): array
    {
        $posts = self::getPostsByBoard('member_trend', 5);
        return array_map(fn($p) => array_merge($p, ['company' => '', 'link' => '/cmak/notice/member']), $posts);
    }

    /**
     * CM자료방
     */
    public static function getCmResources(): array
    {
        $posts = self::getPostsByBoard('research', 5);
        return array_map(fn($p) => array_merge($p, ['category' => '자료', 'link' => '/cmak/cmdata/report']), $posts);
    }

    /**
     * 인사·경조사
     */
    public static function getPersonnelEvents(): array
    {
        $rows = DB::table('posts')
            ->where('board_type', 'news_association')
            ->where('is_published', 1)
            ->whereNull('deleted_at')
            ->orderByDesc('published_at')
            ->offset(5)->limit(4)
            ->get(['id', 'title', 'published_at']);

        return $rows->map(fn($r) => [
            'id' => $r->id,
            'title' => $r->title,
            'date' => $r->published_at ? date('Y-m-d', strtotime($r->published_at)) : '',
            'link' => '/cmak/community/board',
        ])->toArray();
    }

    /**
     * 새소식
     */
    public static function getLatestNews(): array
    {
        return array_slice(self::getDomesticNews(), 0, 2);
    }

    /**
     * 협회소식
     */
    public static function getAssociationNews(): array
    {
        $posts = self::getPostsByBoard('news_association', 3);
        return array_map(fn($p, $i) => array_merge($p, ['subtitle' => '', 'isHighlight' => $i === 0, 'link' => '/cmak/notice/association']), $posts, array_keys($posts));
    }

    /**
     * BookReview
     */
    public static function getBookReviews(): array
    {
        $posts = self::getPostsByBoard('book_review', 5);
        return array_map(fn($p) => array_merge($p, ['image' => '/images/books/book1.jpg', 'link' => '/cmak/community/bookreview']), $posts);
    }

    /**
     * 협회 통계 데이터 (정적)
     */
    public static function getStatistics(): array
    {
        return [
            ['label' => '설립연도', 'value' => '1996', 'suffix' => '년'],
            ['label' => '회원사', 'value' => '500', 'suffix' => '+'],
            ['label' => '인증 전문가', 'value' => '5,000', 'suffix' => '+'],
            ['label' => '교육 수료생', 'value' => '20,000', 'suffix' => '+'],
        ];
    }

    /**
     * 파트너사 로고 (정적, 이미지 유지)
     */
    public static function getPartners(): array
    {
        return [
            ['name' => '희림건축', 'logo' => '/images/partners/heerim.png'],
            ['name' => '신화컨설팅', 'logo' => '/images/partners/shinhwa.png'],
            ['name' => '정림건축', 'logo' => '/images/partners/junglim.png'],
            ['name' => '포스코이앤씨', 'logo' => '/images/partners/posco.png'],
            ['name' => '해안건축', 'logo' => '/images/partners/haeahn.png'],
            ['name' => '무영CM', 'logo' => '/images/partners/mooyoung.png'],
            ['name' => '삼우CM', 'logo' => '/images/partners/samwoo.png'],
        ];
    }

    /**
     * 일정/이벤트
     */
    public static function getUpcomingEvents(): array
    {
        return [
            ['id' => 1, 'title' => '2026년도 제1차 이사회', 'date' => '2026-02-04', 'time' => '14:00', 'location' => '협회 대회의실'],
            ['id' => 2, 'title' => 'CM 전문교육 개강', 'date' => '2026-02-15', 'time' => '09:00', 'location' => '교육장'],
        ];
    }

    /**
     * 기획특집
     */
    public static function getSpecialFeatures(): array
    {
        $posts = self::getPostsByBoard('news_domestic', 4);
        return array_map(fn($p, $i) => array_merge($p, [
            'category' => '기획특집',
            'summary' => mb_substr(strip_tags($p['content'] ?? ''), 0, 80),
            'image' => '/images/features/uam.jpg',
            'isFeatured' => $i === 0,
            'link' => '/cmak/cmdata/special',
        ]), $posts, array_keys($posts));
    }

    /**
     * WordBook (정적)
     */
    public static function getWordBook(): array
    {
        return [['id' => 1, 'term' => 'CM', 'definition' => 'Construction Management - 건설사업관리', 'link' => '/cmak/community/wordbook']];
    }

    /**
     * CM사 소개 (정적)
     */
    public static function getCmCompanyIntro(): array
    {
        return ['company' => '㈜M엔컴퍼티건축사사무소', 'phone' => '02-6946-8500', 'fax' => '02-6946-8550', 'link' => '/intro/members'];
    }

    /**
     * 자료실
     */
    public static function getResources(): array
    {
        $posts = self::getPostsByBoard('research', 5);
        return array_map(fn($p) => array_merge($p, ['category' => '자료', 'link' => '/cmak/cmdata/report']), $posts);
    }

    /**
     * 하단 관련기관 링크 (정적)
     */
    public static function getRelatedLinks(): array
    {
        return [
            ['name' => '기획재정부', 'logo' => '/images/links/moef.png', 'link' => 'https://www.moef.go.kr'],
            ['name' => '국토교통부', 'logo' => '/images/links/molit.png', 'link' => 'https://www.molit.go.kr'],
            ['name' => '나라장터', 'logo' => '/images/links/g2b.png', 'link' => 'https://www.g2b.go.kr'],
            ['name' => '정부24', 'logo' => '/images/links/gov24.png', 'link' => 'https://www.gov.kr'],
            ['name' => '한국CM협회 YouTube', 'logo' => '/images/links/youtube.png', 'link' => 'https://www.youtube.com/@cmak'],
        ];
    }

    /**
     * 우측 광고 배너 (이미지 유지)
     */
    public static function getGuideBooks(): array
    {
        return [
            ['id' => 1, 'title' => 'CM 업무 가이드북', 'subtitle' => '공공 건설사업관리자', 'image' => '/images/guides/public-cm.png', 'link' => '/cmdata/about'],
            ['id' => 2, 'title' => 'CM 업무 가이드북', 'subtitle' => '민간건설공사 CM(현장)', 'image' => '/images/guides/private-cm.png', 'link' => '/cmdata/about'],
            ['id' => 3, 'title' => 'CM 업무 가이드북', 'subtitle' => '주택건설공사 감리', 'image' => '/images/guides/housing-cm.png', 'link' => '/cmdata/about'],
        ];
    }

    /**
     * 주요행사 일정 (정적)
     */
    public static function getSchedule(): array
    {
        return ['month' => '2026.02', 'title' => '건설업계동향', 'link' => '#'];
    }

    /**
     * 회원사 가로 배너 (이미지 유지)
     */
    public static function getMemberBanners(): array
    {
        return [
            ['name' => '신화엔지니어링', 'subname' => 'SHINHWA', 'description' => '대한민국 1호 종합CM', 'logo' => '/images/members/shinhwa.png', 'link' => 'https://www.shinhwaeng.co.kr'],
            ['name' => '정림건축', 'subname' => 'JUNGLIM CM', 'description' => '50여년 발자취 다양한 범위와 규모의 건축물 건설관리 선도', 'logo' => '/images/members/junglim.png', 'link' => 'https://www.junglim.co.kr'],
            ['name' => '포스코A&C', 'subname' => 'posco', 'description' => 'Smart CM Platform', 'logo' => '/images/members/posco.png', 'link' => 'https://www.poscoanc.com'],
            ['name' => 'PCM', 'subname' => '(사)에이텍건축', 'description' => '', 'logo' => '/images/members/pcm.png', 'link' => '#'],
            ['name' => '희림건축', 'subname' => 'heerim', 'description' => 'Architects & Planners', 'logo' => '/images/members/heerim.png', 'link' => 'https://www.heerim.com'],
        ];
    }

    /**
     * 관공서/유관기관 링크 (정적)
     */
    public static function getGovernmentLinks(): array
    {
        return [
            ['name' => '국토교통부', 'link' => 'https://www.molit.go.kr'],
            ['name' => '나라장터', 'link' => 'https://www.g2b.go.kr'],
            ['name' => '조달청', 'link' => 'https://www.pps.go.kr'],
            ['name' => '한국건설기술연구원', 'link' => 'https://www.kict.re.kr'],
            ['name' => '대한건축사협회', 'link' => 'https://www.kira.or.kr'],
            ['name' => '건설기술인협회', 'link' => 'https://www.kocea.or.kr'],
            ['name' => '한국건설관리학회', 'link' => 'https://www.kicem.or.kr'],
            ['name' => '대한건설정책연구원', 'link' => 'https://www.ricon.re.kr'],
        ];
    }

    /**
     * 회원사 롤링 배너 (이미지 유지)
     */
    public static function getRollingBanners(): array
    {
        return [
            ['name' => 'SHINHWA', 'image' => '/cmak/images/ads/ad_01.jpg', 'link' => 'http://www.shinhwaeng.com'],
            ['name' => 'JUNGLIM CM', 'image' => '/cmak/images/ads/ad_02.jpg', 'link' => 'http://www.junglim.com'],
            ['name' => '포스코A&C', 'image' => '/cmak/images/ads/ad_03.jpg', 'link' => 'https://www.poscoanc.com'],
            ['name' => 'PCM (해안건축)', 'image' => '/cmak/images/ads/ad_04.jpg', 'link' => 'http://www.haeahn.com'],
            ['name' => 'heerim (희림)', 'image' => '/cmak/images/ads/ad_05.jpg', 'link' => 'https://www.heerim.com'],
            ['name' => 'KUNWON (건원)', 'image' => '/cmak/images/ads/ad_11.jpg', 'link' => '#'],
            ['name' => 'THE M', 'image' => '/cmak/images/ads/ad_12.jpg', 'link' => '#'],
            ['name' => 'MOOYOUNG CM', 'image' => '/cmak/images/ads/ad_13.jpg', 'link' => '#'],
            ['name' => 'SAMOO C.M.', 'image' => '/cmak/images/ads/ad_14.jpg', 'link' => '#'],
            ['name' => 'JEONIN CM', 'image' => '/cmak/images/ads/ad_15.jpg', 'link' => '#'],
            ['name' => 'TOMOON (토문)', 'image' => '/cmak/images/ads/ad_16.jpg', 'link' => '#'],
            ['name' => 'TOPEC', 'image' => '/cmak/images/ads/ad_17.jpg', 'link' => '#'],
        ];
    }

    /**
     * 관련기관 롤링 배너 (이미지 유지)
     */
    public static function getPartnerBanners(): array
    {
        return [
            ['name' => 'CMAK YouTube', 'image' => '/cmak/images/banners/partners/cmak_youtube.jpg', 'link' => 'https://www.youtube.com/channel/UCcVZEpnpnFrPzG73IvT_48Q'],
            ['name' => '정책브리핑', 'image' => '/cmak/images/banners/partners/korea_policy.jpg', 'link' => 'https://www.korea.kr'],
            ['name' => '기획재정부', 'image' => '/cmak/images/banners/partners/moef.jpg', 'link' => 'https://www.moef.go.kr'],
            ['name' => '국토교통부', 'image' => '/cmak/images/banners/partners/molit.jpg', 'link' => 'http://www.molit.go.kr'],
            ['name' => '나라장터', 'image' => '/cmak/images/banners/partners/g2b.jpg', 'link' => 'https://www.g2b.go.kr'],
            ['name' => '정부24', 'image' => '/cmak/images/banners/partners/gov24.jpg', 'link' => 'https://www.gov.kr'],
        ];
    }

    /**
     * 우측 세로 광고 배너 (이미지 유지)
     */
    public static function getSidebarAds(): array
    {
        return [
            ['id' => 1, 'title' => '해안건축', 'type' => 'ad', 'image' => '/cmak/images/ads/2026해안건축.jpg', 'link' => 'http://www.haeahn.com'],
            ['id' => 2, 'title' => 'HEERIM', 'type' => 'ad', 'image' => '/cmak/images/ads/HEERIM25.jpg', 'link' => 'https://www.heerim.com'],
            ['id' => 3, 'title' => 'SHINHWA', 'type' => 'ad', 'image' => '/cmak/images/ads/SHINHWA25.jpg', 'link' => 'http://www.shinhwaeng.com'],
            ['id' => 4, 'title' => '정림건축', 'type' => 'ad', 'image' => '/cmak/images/ads/A3_JUNGLIM.png', 'link' => 'http://www.junglim.com'],
            ['id' => 5, 'title' => 'POSCO A&C', 'type' => 'ad', 'image' => '/cmak/images/ads/POSCO25.jpg', 'link' => 'https://www.poscoanc.com'],
        ];
    }

    /**
     * 하단 광고 배너 (이미지 유지)
     */
    public static function getBottomAds(): array
    {
        return [
            ['id' => 1, 'title' => 'SHINHWA', 'image' => '/cmak/images/ads/ad_01.jpg', 'link' => '#'],
            ['id' => 2, 'title' => 'JUNGLIM CM', 'image' => '/cmak/images/ads/ad_02.jpg', 'link' => '#'],
            ['id' => 3, 'title' => '포스코A&C', 'image' => '/cmak/images/ads/ad_03.jpg', 'link' => '#'],
            ['id' => 4, 'title' => 'PCM (해안건축)', 'image' => '/cmak/images/ads/ad_04.jpg', 'link' => '#'],
            ['id' => 5, 'title' => 'heerim (희림)', 'image' => '/cmak/images/ads/ad_05.jpg', 'link' => '#'],
            ['id' => 6, 'title' => 'SHINHWA', 'image' => '/cmak/images/ads/ad_06.jpg', 'link' => '#'],
            ['id' => 7, 'title' => 'JUNGLIM CM', 'image' => '/cmak/images/ads/ad_07.jpg', 'link' => '#'],
            ['id' => 8, 'title' => '포스코A&C', 'image' => '/cmak/images/ads/ad_08.jpg', 'link' => '#'],
            ['id' => 9, 'title' => 'PCM (해안건축)', 'image' => '/cmak/images/ads/ad_09.jpg', 'link' => '#'],
            ['id' => 10, 'title' => 'heerim (희림)', 'image' => '/cmak/images/ads/ad_10.jpg', 'link' => '#'],
            ['id' => 11, 'title' => 'KUNWON (건원엔지니어링)', 'image' => '/cmak/images/ads/ad_11.jpg', 'link' => '#'],
            ['id' => 12, 'title' => 'THE M', 'image' => '/cmak/images/ads/ad_12.jpg', 'link' => '#'],
            ['id' => 13, 'title' => 'MOOYOUNG CM (무영씨엠)', 'image' => '/cmak/images/ads/ad_13.jpg', 'link' => '#'],
            ['id' => 14, 'title' => 'SAMOO C.M. (삼우씨엠)', 'image' => '/cmak/images/ads/ad_14.jpg', 'link' => '#'],
            ['id' => 15, 'title' => 'JEONIN CM (전인CM)', 'image' => '/cmak/images/ads/ad_15.jpg', 'link' => '#'],
            ['id' => 16, 'title' => 'TOMOON (토문)', 'image' => '/cmak/images/ads/ad_16.jpg', 'link' => '#'],
            ['id' => 17, 'title' => 'TOPEC', 'image' => '/cmak/images/ads/ad_17.jpg', 'link' => '#'],
        ];
    }
}
