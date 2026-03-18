<?php

namespace App\Data;

/**
 * 메인 페이지 더미 데이터
 *
 * 추후 API/DB 연동 시 이 클래스의 메서드들을 서비스 클래스로 교체하면 됩니다.
 * 예: HomeService::getNotices() 등으로 대체
 */
class HomeData
{
    /**
     * 히어로 슬라이드 데이터
     * TODO: API 연동 시 /api/banners 엔드포인트로 교체
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
     * 빠른 메뉴 데이터
     */
    public static function getQuickMenus(): array
    {
        return [
            [
                'id' => 1,
                'title' => '회원가입',
                'description' => 'CM 전문기업 가입',
                'icon' => 'users',
                'link' => '/business/membership',
                'color' => 'blue',
            ],
            [
                'id' => 2,
                'title' => 'CM 능력평가 공시',
                'description' => '기업 능력평가',
                'icon' => 'certificate',
                'link' => '/business/certification',
                'color' => 'indigo',
            ],
            [
                'id' => 3,
                'title' => '자격검정',
                'description' => '건설사업관리사',
                'icon' => 'academic',
                'link' => '/business/inspection',
                'color' => 'purple',
            ],
            [
                'id' => 4,
                'title' => 'CM 전문교육',
                'description' => '역량 강화 교육',
                'icon' => 'book',
                'link' => '/business/education',
                'color' => 'cyan',
            ],
            [
                'id' => 5,
                'title' => 'CM Herald',
                'description' => '월간 소식지',
                'icon' => 'newspaper',
                'link' => '/business/herald',
                'color' => 'orange',
            ],
            [
                'id' => 6,
                'title' => 'CM이란',
                'description' => '건설사업관리 소개',
                'icon' => 'info',
                'link' => '/cmdata/about',
                'color' => 'teal',
            ],
        ];
    }

    /**
     * 공지사항 데이터
     * TODO: API 연동 시 /api/notices 엔드포인트로 교체
     */
    public static function getNotices(): array
    {
        return [
            [
                'id' => 1,
                'category' => '공지',
                'title' => '2026년도 건설사업관리(CM)능력평가·공시 안내',
                'date' => '2026-01-07',
                'isNew' => true,
                'link' => '/notice/1',
            ],
            [
                'id' => 2,
                'category' => '공지',
                'title' => '2026년 상반기 CM 전문교육 일정 공고',
                'date' => '2026-01-05',
                'isNew' => true,
                'link' => '/notice/2',
            ],
            [
                'id' => 3,
                'category' => '공지',
                'title' => '제30회 정기총회 개최 안내',
                'date' => '2026-01-03',
                'isNew' => false,
                'link' => '/notice/3',
            ],
            [
                'id' => 4,
                'category' => '공지',
                'title' => '2025년 연차보고서 발간 안내',
                'date' => '2025-12-28',
                'isNew' => false,
                'link' => '/notice/4',
            ],
            [
                'id' => 5,
                'category' => '공지',
                'title' => '신년사 - 한국CM협회장',
                'date' => '2025-12-26',
                'isNew' => false,
                'link' => '/notice/5',
            ],
        ];
    }

    /**
     * 협회 소식 데이터
     * TODO: API 연동 시 /api/news 엔드포인트로 교체
     */
    public static function getNews(): array
    {
        return [
            [
                'id' => 1,
                'category' => '협회',
                'title' => '제16회 정기총회 및 신임 회장선출 투표안내',
                'date' => '2026-03-10',
                'isNew' => true,
                'link' => 'https://www.cmak.or.kr/html/notice/nleague1_r.asp?no=3888&code=1',
            ],
            [
                'id' => 2,
                'category' => '협회',
                'title' => '2026년도 제1차 이사회 개최',
                'date' => '2026-03-05',
                'isNew' => true,
                'link' => '/news/2',
            ],
            [
                'id' => 3,
                'category' => '국내',
                'title' => '스마트 건설기술 동향 및 CM 적용 사례 발표',
                'date' => '2026-02-28',
                'isNew' => false,
                'link' => '/news/3',
            ],
            [
                'id' => 4,
                'category' => '국내',
                'title' => '도심항공모빌리티(UAM) 건설관리 시장 전망',
                'date' => '2026-02-20',
                'isNew' => false,
                'link' => '/news/4',
            ],
        ];
    }

    /**
     * 주요 사업 데이터
     */
    public static function getServices(): array
    {
        return [
            [
                'id' => 1,
                'title' => '회원가입',
                'description' => 'CM 전문기업으로서 협회 회원이 되어 다양한 혜택과 네트워크를 누리세요.',
                'icon' => 'users',
                'link' => '/business/membership',
                'color' => 'blue',
            ],
            [
                'id' => 2,
                'title' => 'CM 능력평가 공시',
                'description' => '기업의 CM 수행능력을 객관적으로 평가하고 공시합니다.',
                'icon' => 'certificate',
                'link' => '/business/certification',
                'color' => 'indigo',
            ],
            [
                'id' => 3,
                'title' => '건설사업관리사 자격검정',
                'description' => 'CM 전문가 양성을 위한 자격검정 시험을 주관합니다.',
                'icon' => 'academic',
                'link' => '/business/inspection',
                'color' => 'purple',
            ],
            [
                'id' => 4,
                'title' => 'CM 전문교육',
                'description' => '체계적인 교육 프로그램으로 CM 역량을 강화하세요.',
                'icon' => 'book',
                'link' => '/business/education',
                'color' => 'cyan',
            ],
        ];
    }

    /**
     * 입찰 정보 데이터
     * TODO: API 연동 시 /api/bids 엔드포인트로 교체
     */
    public static function getBids(): array
    {
        return [
            [
                'id' => 1,
                'type' => '입찰',
                'title' => '2026년도 용역비(계획, 용역비조정) 공고',
                'date' => '2026-03-12',
                'link' => 'https://www.cmak.or.kr/html/cmdata/cmreport.asp',
            ],
            [
                'id' => 2,
                'type' => '입찰',
                'title' => '홍콩 정부청사 신축사업 기본설계용역 공고',
                'date' => '2026-03-10',
                'link' => '/bids/2',
            ],
            [
                'id' => 3,
                'type' => '입찰',
                'title' => '광주 광산역세권 도시개발사업 기본설계용역 공고',
                'date' => '2026-03-08',
                'link' => '/bids/3',
            ],
            [
                'id' => 4,
                'type' => '입찰',
                'title' => '청년스마트빌리지 조성사업 건설사업관리용역',
                'date' => '2026-03-05',
                'link' => '/bids/4',
            ],
        ];
    }

    /**
     * 자료실 데이터
     * TODO: API 연동 시 /api/resources 엔드포인트로 교체
     */
    public static function getResources(): array
    {
        return [
            [
                'id' => 1,
                'category' => '논문',
                'title' => 'ENR 순위로 본 미국 건설산업 발주방식 동향',
                'date' => '2026-01-15',
                'link' => '/cmdata/report/1',
            ],
            [
                'id' => 2,
                'category' => '수행사례',
                'title' => '[ConsMa 2024] 제7회 세계CM경진대회',
                'date' => '2026-01-10',
                'link' => '/cmdata/case/1',
            ],
            [
                'id' => 3,
                'category' => '세미나',
                'title' => '[이슈진단] 건설 2040 Outlook',
                'date' => '2026-01-05',
                'link' => '/cmdata/seminar/1',
            ],
        ];
    }

    /**
     * 전문가 칼럼 데이터
     * TODO: API 연동 시 /api/columns 엔드포인트로 교체
     */
    public static function getExpertColumns(): array
    {
        return [
            [
                'id' => 1,
                'title' => '플래닛 건축학 전문가에게 듣는다',
                'summary' => '건축과 도시, 그리고 CM의 미래를 전문가의 시각으로 조명합니다.',
                'author' => '',
                'date' => '2026-03-10',
                'isFeatured' => true,
                'link' => '/cmdata/expert/1',
            ],
            [
                'id' => 2,
                'title' => '도시속을 누비는 하이스피드 모빌리티 CM이다',
                'summary' => '',
                'author' => '',
                'date' => '2026-03-05',
                'isFeatured' => false,
                'link' => '/cmdata/expert/2',
            ],
            [
                'id' => 3,
                'title' => '도시의 CM은 삶의 질향상',
                'summary' => '',
                'author' => '',
                'date' => '2026-02-28',
                'isFeatured' => false,
                'link' => '/cmdata/expert/3',
            ],
            [
                'id' => 4,
                'title' => '한국CM, 해외수주전 개척',
                'summary' => '',
                'author' => '',
                'date' => '2026-02-20',
                'isFeatured' => false,
                'link' => '/cmdata/expert/4',
            ],
        ];
    }

    /**
     * 협회 통계 데이터
     */
    public static function getStatistics(): array
    {
        return [
            [
                'label' => '설립연도',
                'value' => '1996',
                'suffix' => '년',
            ],
            [
                'label' => '회원사',
                'value' => '500',
                'suffix' => '+',
            ],
            [
                'label' => '인증 전문가',
                'value' => '5,000',
                'suffix' => '+',
            ],
            [
                'label' => '교육 수료생',
                'value' => '20,000',
                'suffix' => '+',
            ],
        ];
    }

    /**
     * 파트너사 로고 데이터
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
     * 일정/이벤트 데이터
     */
    public static function getUpcomingEvents(): array
    {
        return [
            [
                'id' => 1,
                'title' => '2026년도 제1차 이사회',
                'date' => '2026-02-04',
                'time' => '14:00',
                'location' => '협회 대회의실',
            ],
            [
                'id' => 2,
                'title' => 'CM 전문교육 개강',
                'date' => '2026-02-15',
                'time' => '09:00',
                'location' => '교육장',
            ],
        ];
    }

    /**
     * 국내외소식 데이터
     */
    public static function getDomesticNews(): array
    {
        return [
            [
                'id' => 1,
                'title' => '한중, 도심 항공교통 6개사와 \'항공협력 업무협약\'',
                'date' => '2026-03-10',
                'link' => 'https://www.cmak.or.kr/html/notice/news_r.asp?no=61412',
            ],
            [
                'id' => 2,
                'title' => '국토교통부, 건설산업 혁신방안 발표',
                'date' => '2026-03-05',
                'link' => '/news/domestic/2',
            ],
            [
                'id' => 3,
                'title' => '스마트건설 기술개발 로드맵 수립',
                'date' => '2026-02-28',
                'link' => '/news/domestic/3',
            ],
            [
                'id' => 4,
                'title' => 'UAM 도심항공교통 인프라 구축 본격화',
                'date' => '2026-02-20',
                'link' => '/news/domestic/4',
            ],
        ];
    }

    /**
     * 법령소식 데이터
     */
    public static function getLegalNews(): array
    {
        return [
            [
                'id' => 1,
                'title' => '건설산업기본법 시행령 일부개정령안 입법예고',
                'date' => '2025-12-10',
                'link' => '/news/legal/1',
            ],
            [
                'id' => 2,
                'title' => '건설기술 진흥법 시행규칙 개정안 공포',
                'date' => '2025-12-05',
                'link' => '/news/legal/2',
            ],
            [
                'id' => 3,
                'title' => '건축법 일부개정법률안 국회 통과',
                'date' => '2025-11-28',
                'link' => '/news/legal/3',
            ],
            [
                'id' => 4,
                'title' => '주택법 시행령 개정안 입법예고',
                'date' => '2025-11-20',
                'link' => '/news/legal/4',
            ],
        ];
    }

    /**
     * 유관기관소식 데이터
     */
    public static function getRelatedOrgNews(): array
    {
        return [
            [
                'id' => 1,
                'title' => '대한건축사협회 신년 하례회 개최',
                'date' => '2026-01-15',
                'link' => '/news/org/1',
            ],
            [
                'id' => 2,
                'title' => '건설기술인협회 정기총회 안내',
                'date' => '2026-01-10',
                'link' => '/news/org/2',
            ],
            [
                'id' => 3,
                'title' => '한국건설관리학회 학술대회 개최',
                'date' => '2025-12-20',
                'link' => '/news/org/3',
            ],
            [
                'id' => 4,
                'title' => '대한건설정책연구원 세미나 안내',
                'date' => '2025-12-15',
                'link' => '/news/org/4',
            ],
        ];
    }

    /**
     * 보도자료 데이터
     */
    public static function getPressReleases(): array
    {
        return [
            [
                'id' => 1,
                'title' => '2026년도 건설사업관리(CM)능력평가·공시 신청마감공문 발 서식 보...',
                'date' => '2026-01-07',
                'link' => '/notice/press/1',
            ],
            [
                'id' => 2,
                'title' => '건설사업관리사(CM) 제18회 자격검정 합격자 명단 및 21회 간담회 개최',
                'date' => '2026-01-04',
                'link' => '/notice/press/2',
            ],
            [
                'id' => 3,
                'title' => '2026년도 제29차 정기총회 개최',
                'date' => '2026-01-30',
                'link' => '/notice/press/3',
            ],
            [
                'id' => 4,
                'title' => '2026년도 연회비 납부 안내',
                'date' => '2026-01-19',
                'link' => '/notice/press/4',
            ],
            [
                'id' => 5,
                'title' => '2026년도 새해인사 날 유공 정부포상 후보자 공모',
                'date' => '2026-01-16',
                'link' => '/notice/press/5',
            ],
        ];
    }

    /**
     * 새소식 데이터 (좌측 상단)
     */
    public static function getLatestNews(): array
    {
        return [
            [
                'id' => 1,
                'title' => "대구 수성알파시티에 '산업시설전시관' 건립 추진",
                'date' => '2026-02-12',
                'isNew' => true,
                'link' => '/news/latest/1',
            ],
            [
                'id' => 2,
                'title' => '2027 제30기 교육생 모집',
                'date' => '2026-02-10',
                'isNew' => true,
                'link' => '/news/latest/2',
            ],
        ];
    }

    /**
     * 협회소식 데이터 (좌측)
     */
    public static function getAssociationNews(): array
    {
        return [
            [
                'id' => 1,
                'title' => '2026년도 제29차 정기총회 개최 안내',
                'subtitle' => '2월 28일(금) 오전 11시',
                'date' => '2026-02-02',
                'isHighlight' => true,
                'link' => '/news/association/1',
            ],
            [
                'id' => 2,
                'title' => '4월 2026년도 제10차 이사회 개최',
                'date' => '2026-01-28',
                'isHighlight' => false,
                'link' => '/news/association/2',
            ],
        ];
    }

    /**
     * BookReview 데이터
     */
    public static function getBookReviews(): array
    {
        return [
            [
                'id' => 1,
                'title' => '건설마에서의 비밀',
                'image' => '/images/books/book1.jpg',
                'link' => '/cmdata/book/1',
            ],
        ];
    }

    /**
     * 기획특집 데이터
     */
    public static function getSpecialFeatures(): array
    {
        return [
            [
                'id' => 1,
                'category' => '미래항공모빌리티',
                'title' => '로봇과 함께할 UAM으로 미래, 자율주행 협업 - 산업 미래상스 멀티모달이로봇',
                'summary' => '"대통령 선거전 출마사의 포부, 초당협 품 미래전략 기구" "여론조사봇..."',
                'image' => '/images/features/uam.jpg',
                'date' => '2026-02-10',
                'isFeatured' => true,
                'link' => '/cmdata/feature/1',
            ],
            [
                'id' => 2,
                'title' => '[인치전쟁]무장 울리 9개월, 달라지는 대한민국 주미국한국기업',
                'date' => '2026-02-08',
                'link' => '/cmdata/feature/2',
            ],
            [
                'id' => 3,
                'title' => '[인치전쟁]부상 출히 6개월, 달라지는 대한민국도 우수혹은 안',
                'date' => '2026-02-05',
                'link' => '/cmdata/feature/3',
            ],
            [
                'id' => 4,
                'title' => '[인치전쟁]부상 출히 6개월, 달라지는 대한민국과 Q2(인도대표)',
                'date' => '2026-02-03',
                'link' => '/cmdata/feature/4',
            ],
        ];
    }

    /**
     * WordBook (용어집) 데이터
     */
    public static function getWordBook(): array
    {
        return [
            [
                'id' => 1,
                'term' => '건위유지(維持維持)',
                'definition' => '유지되돌릴 무프목율, 수투승 연',
                'link' => '/cmdata/wordbook/1',
            ],
        ];
    }

    /**
     * 회원동향 데이터
     */
    public static function getMemberTrends(): array
    {
        return [
            [
                'id' => 1,
                'company' => '현대건설',
                'title' => '에티오피아 신규프로젝트 추진',
                'link' => '/news/member/1',
            ],
            [
                'id' => 2,
                'company' => '대우A&C',
                'title' => '싱가포르 복합건물 설계공모 도전',
                'link' => '/news/member/2',
            ],
            [
                'id' => 3,
                'company' => '현대건설',
                'title' => '말레이시아 신규프로젝트 선정',
                'link' => '/news/member/3',
            ],
            [
                'id' => 4,
                'company' => '한솔건설',
                'title' => '베트남 톤 누 프로젝트 공사비 계약',
                'link' => '/news/member/4',
            ],
        ];
    }

    /**
     * CM사 소개 데이터
     */
    public static function getCmCompanyIntro(): array
    {
        return [
            'company' => '㈜M엔컴퍼티건축사사무소',
            'phone' => '02-6946-8500',
            'fax' => '02-6946-8550',
            'link' => '/intro/members',
        ];
    }

    /**
     * CM자료방 데이터
     */
    public static function getCmResources(): array
    {
        return [
            [
                'id' => 1,
                'category' => '논문/연구',
                'title' => 'CM 공정표 면 미국 전순산업 발주방식현황',
                'link' => '/cmdata/report/1',
            ],
            [
                'id' => 2,
                'category' => '수행사례',
                'title' => '[ConsMa 2024] 제7회 CM 진흥산업 발주공시현황',
                'link' => '/cmdata/case/1',
            ],
            [
                'id' => 3,
                'category' => '교육/세미나',
                'title' => '[이슈간단] 건설 2040 Outlook',
                'link' => '/cmdata/seminar/1',
            ],
            [
                'id' => 4,
                'category' => '해외건설사업',
                'title' => '해외 CM채도 전수사업 연구 보고서 발간',
                'link' => '/cmdata/overseas/1',
            ],
            [
                'id' => 5,
                'category' => '기타자료',
                'title' => '사무공관점 건설산업 심규저개정안공사협의',
                'link' => '/cmdata/etc/1',
            ],
        ];
    }

    /**
     * 하단 관련기관 링크 배너 데이터
     */
    public static function getRelatedLinks(): array
    {
        return [
            [
                'name' => '대정경제부',
                'logo' => '/images/links/moef.png',
                'link' => 'https://www.moef.go.kr',
            ],
            [
                'name' => '국토교통부',
                'logo' => '/images/links/molit.png',
                'link' => 'https://www.molit.go.kr',
            ],
            [
                'name' => '나라장터',
                'logo' => '/images/links/g2b.png',
                'link' => 'https://www.g2b.go.kr',
            ],
            [
                'name' => '정부24',
                'logo' => '/images/links/gov24.png',
                'link' => 'https://www.gov.kr',
            ],
            [
                'name' => '한국CM협회 YouTube',
                'logo' => '/images/links/youtube.png',
                'link' => 'https://www.youtube.com/@cmak',
            ],
        ];
    }

    /**
     * 우측 추가 광고 배너 (CM업무 가이드북 등)
     */
    public static function getGuideBooks(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'CM 업무 가이드북',
                'subtitle' => '공공 건설사업관리자',
                'image' => '/images/guides/public-cm.png',
                'link' => '/cmdata/guidebook/1',
            ],
            [
                'id' => 2,
                'title' => 'CM 업무 가이드북',
                'subtitle' => '민간건설공사 CM(현장)',
                'image' => '/images/guides/private-cm.png',
                'link' => '/cmdata/guidebook/2',
            ],
            [
                'id' => 3,
                'title' => 'CM 업무 가이드북',
                'subtitle' => '주택건설공사 감리',
                'image' => '/images/guides/housing-cm.png',
                'link' => '/cmdata/guidebook/3',
            ],
        ];
    }

    /**
     * 주요행사 일정 데이터
     */
    public static function getSchedule(): array
    {
        return [
            'month' => '2026.02',
            'title' => '건설업계동향',
            'link' => '/schedule',
        ];
    }

    /**
     * 회원사 가로 배너 데이터 (하단 슬라이더)
     */
    public static function getMemberBanners(): array
    {
        return [
            [
                'name' => '신화엔지니어링',
                'subname' => 'SHINHWA',
                'description' => '대한민국 1호 종합CM',
                'logo' => '/images/members/shinhwa.png',
                'link' => 'https://www.shinhwaeng.co.kr',
            ],
            [
                'name' => '정림건축',
                'subname' => 'JUNGLIM CM',
                'description' => '50여년 발자취 다양한 범위와 규모의 건축물 건설관리 선도',
                'logo' => '/images/members/junglim.png',
                'link' => 'https://www.junglim.co.kr',
            ],
            [
                'name' => '포스코A&C',
                'subname' => 'posco',
                'description' => 'Smart CM Platform',
                'logo' => '/images/members/posco.png',
                'link' => 'https://www.poscoanc.com',
            ],
            [
                'name' => 'PCM',
                'subname' => '(사)에이텍건축',
                'description' => '',
                'logo' => '/images/members/pcm.png',
                'link' => '#',
            ],
            [
                'name' => '희림건축',
                'subname' => 'heerim',
                'description' => 'Architects & Planners',
                'logo' => '/images/members/heerim.png',
                'link' => 'https://www.heerim.com',
            ],
        ];
    }

    /**
     * 인사·경조사 데이터
     */
    public static function getPersonnelEvents(): array
    {
        return [
            [
                'id' => 1,
                'title' => '2026년 신년 인사',
                'date' => '2026-01-02',
                'link' => '/cmak/community/board/1',
            ],
            [
                'id' => 2,
                'title' => '제30회 정기총회 축하',
                'date' => '2025-12-20',
                'link' => '/cmak/community/board/2',
            ],
            [
                'id' => 3,
                'title' => '김영수 前회장 훈장 수여',
                'date' => '2025-12-15',
                'link' => '/cmak/community/board/3',
            ],
            [
                'id' => 4,
                'title' => '이사회 위원 위촉식',
                'date' => '2025-12-10',
                'link' => '/cmak/community/board/4',
            ],
        ];
    }

    /**
     * 관공서/유관기관 배너 링크
     */
    public static function getGovernmentLinks(): array
    {
        return [
            [
                'name' => '국토교통부',
                'link' => 'https://www.molit.go.kr',
            ],
            [
                'name' => '나라장터',
                'link' => 'https://www.g2b.go.kr',
            ],
            [
                'name' => '조달청',
                'link' => 'https://www.pps.go.kr',
            ],
            [
                'name' => '한국건설기술연구원',
                'link' => 'https://www.kict.re.kr',
            ],
            [
                'name' => '대한건축사협회',
                'link' => 'https://www.kira.or.kr',
            ],
            [
                'name' => '건설기술인협회',
                'link' => 'https://www.kocea.or.kr',
            ],
            [
                'name' => '한국건설관리학회',
                'link' => 'https://www.kicem.or.kr',
            ],
            [
                'name' => '대한건설정책연구원',
                'link' => 'https://www.ricon.re.kr',
            ],
        ];
    }

    /**
     * 회원사 하단 롤링 배너 (이미지)
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
     * 관련기관 롤링 배너 (원본 cmak.or.kr 푸터)
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
     * 우측 세로 광고 배너 데이터 (원본 cmak.or.kr 기준)
     */
    public static function getSidebarAds(): array
    {
        return [
            [
                'id' => 1,
                'title' => '해안건축',
                'type' => 'ad',
                'image' => '/cmak/images/ads/2026해안건축.jpg',
                'link' => 'http://www.haeahn.com',
            ],
            [
                'id' => 2,
                'title' => 'HEERIM',
                'type' => 'ad',
                'image' => '/cmak/images/ads/HEERIM25.jpg',
                'link' => 'https://www.heerim.com',
            ],
            [
                'id' => 3,
                'title' => 'SHINHWA',
                'type' => 'ad',
                'image' => '/cmak/images/ads/SHINHWA25.jpg',
                'link' => 'http://www.shinhwaeng.com',
            ],
            [
                'id' => 4,
                'title' => '정림건축',
                'type' => 'ad',
                'image' => '/cmak/images/ads/A3_JUNGLIM.png',
                'link' => 'http://www.junglim.com',
            ],
            [
                'id' => 5,
                'title' => 'POSCO A&C',
                'type' => 'ad',
                'image' => '/cmak/images/ads/POSCO25.jpg',
                'link' => 'https://www.poscoanc.com',
            ],
        ];
    }

    /**
     * 하단 광고 배너 데이터 (원본 cmak.or.kr 기준)
     */
    public static function getBottomAds(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'SHINHWA',
                'image' => '/cmak/images/ads/ad_01.jpg',
                'link' => '#',
            ],
            [
                'id' => 2,
                'title' => 'JUNGLIM CM',
                'image' => '/cmak/images/ads/ad_02.jpg',
                'link' => '#',
            ],
            [
                'id' => 3,
                'title' => '포스코A&C',
                'image' => '/cmak/images/ads/ad_03.jpg',
                'link' => '#',
            ],
            [
                'id' => 4,
                'title' => 'PCM (해안건축)',
                'image' => '/cmak/images/ads/ad_04.jpg',
                'link' => '#',
            ],
            [
                'id' => 5,
                'title' => 'heerim (희림)',
                'image' => '/cmak/images/ads/ad_05.jpg',
                'link' => '#',
            ],
            [
                'id' => 6,
                'title' => 'SHINHWA',
                'image' => '/cmak/images/ads/ad_06.jpg',
                'link' => '#',
            ],
            [
                'id' => 7,
                'title' => 'JUNGLIM CM',
                'image' => '/cmak/images/ads/ad_07.jpg',
                'link' => '#',
            ],
            [
                'id' => 8,
                'title' => '포스코A&C',
                'image' => '/cmak/images/ads/ad_08.jpg',
                'link' => '#',
            ],
            [
                'id' => 9,
                'title' => 'PCM (해안건축)',
                'image' => '/cmak/images/ads/ad_09.jpg',
                'link' => '#',
            ],
            [
                'id' => 10,
                'title' => 'heerim (희림)',
                'image' => '/cmak/images/ads/ad_10.jpg',
                'link' => '#',
            ],
            [
                'id' => 11,
                'title' => 'KUNWON (건원엔지니어링)',
                'image' => '/cmak/images/ads/ad_11.jpg',
                'link' => '#',
            ],
            [
                'id' => 12,
                'title' => 'THE M',
                'image' => '/cmak/images/ads/ad_12.jpg',
                'link' => '#',
            ],
            [
                'id' => 13,
                'title' => 'MOOYOUNG CM (무영씨엠)',
                'image' => '/cmak/images/ads/ad_13.jpg',
                'link' => '#',
            ],
            [
                'id' => 14,
                'title' => 'SAMOO C.M. (삼우씨엠)',
                'image' => '/cmak/images/ads/ad_14.jpg',
                'link' => '#',
            ],
            [
                'id' => 15,
                'title' => 'JEONIN CM (전인CM)',
                'image' => '/cmak/images/ads/ad_15.jpg',
                'link' => '#',
            ],
            [
                'id' => 16,
                'title' => 'TOMOON (토문)',
                'image' => '/cmak/images/ads/ad_16.jpg',
                'link' => '#',
            ],
            [
                'id' => 17,
                'title' => 'TOPEC',
                'image' => '/cmak/images/ads/ad_17.jpg',
                'link' => '#',
            ],
        ];
    }
}
