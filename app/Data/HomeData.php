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
                'category' => '국내',
                'title' => '국립중앙의료원 신축이전사업, 1조 8천억 원 규모 내년 상반기 첫 삽',
                'date' => '2026-02-06',
                'isNew' => true,
                'link' => '/news/1',
            ],
            [
                'id' => 2,
                'category' => '국내',
                'title' => '스마트 건설기술 동향 및 CM 적용 사례 발표',
                'date' => '2026-02-04',
                'isNew' => true,
                'link' => '/news/2',
            ],
            [
                'id' => 3,
                'category' => '협회',
                'title' => '2026년도 제1차 이사회 개최',
                'date' => '2026-02-04',
                'isNew' => false,
                'link' => '/news/3',
            ],
            [
                'id' => 4,
                'category' => '국내',
                'title' => '도심항공모빌리티(UAM) 건설관리 시장 전망',
                'date' => '2026-02-01',
                'isNew' => false,
                'link' => '/news/4',
            ],
            [
                'id' => 5,
                'category' => '해외',
                'title' => '해외 CM제도 전수사업 연구 보고서 발간',
                'date' => '2026-01-28',
                'isNew' => false,
                'link' => '/news/5',
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
                'title' => '26-A-00부대 건설사업관리용역(A004)',
                'date' => '2026-02-07',
                'link' => '/bids/1',
            ],
            [
                'id' => 2,
                'type' => '입찰',
                'title' => '신대방역세권재개발정비사업조합 건설사업관리 CM 용역',
                'date' => '2026-02-06',
                'link' => '/bids/2',
            ],
            [
                'id' => 3,
                'type' => '낙찰',
                'title' => '기부채납시설(반포2초·반포2중) 신축공사 건설사업관리',
                'date' => '2026-02-05',
                'link' => '/bids/3',
            ],
            [
                'id' => 4,
                'type' => '입찰',
                'title' => '청년스마트빌리지 조성사업 건설사업관리용역',
                'date' => '2026-02-04',
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
                'title' => '리모델링 성공수행 핵심키워드는 CM이다',
                'summary' => '리모델링, 설계·구조·토목 등 철저한 검증 바탕 사업관리 중요.',
                'author' => '홍길동',
                'date' => '2026-02-01',
                'isFeatured' => true,
                'link' => '/cmdata/expert/1',
            ],
            [
                'id' => 2,
                'title' => '세계 CM의 날에 부쳐',
                'summary' => '',
                'author' => '김철수',
                'date' => '2026-01-20',
                'isFeatured' => false,
                'link' => '/cmdata/expert/2',
            ],
            [
                'id' => 3,
                'title' => '한국CM, 방글라데시 수출',
                'summary' => '',
                'author' => '이영희',
                'date' => '2026-01-15',
                'isFeatured' => false,
                'link' => '/cmdata/expert/3',
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
                'title' => '도로 분야 민간투자사업 재건축 평가위원 통록 이동 공고',
                'date' => '2025-12-11',
                'link' => '/news/domestic/1',
            ],
            [
                'id' => 2,
                'title' => '2026 민간인증 건축사 업무 및 신뢰도 확보를 위한 개선안',
                'date' => '2025-12-02',
                'link' => '/news/domestic/2',
            ],
            [
                'id' => 3,
                'title' => '국토교통부 이관안에 김이해 건설안에 공수',
                'date' => '2025-12-01',
                'link' => '/news/domestic/3',
            ],
            [
                'id' => 4,
                'title' => '소비자문, 11월 30일 자전 저지선 소령 - 기반 내 사회 담화',
                'date' => '2025-11-25',
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
                'company' => '상아에서 시안만산설비',
                'title' => '시 하이구이',
                'image' => '/images/trends/trend1.jpg',
                'link' => '/news/member/1',
            ],
            [
                'id' => 2,
                'company' => '15년간 빌치니아 미국 회람 제비대 공장완성 PMIS 구축 운영지원사업 수 ...',
                'title' => '',
                'image' => '/images/trends/trend2.jpg',
                'link' => '/news/member/2',
            ],
            [
                'id' => 3,
                'company' => '무영아이언&건축사사무소',
                'title' => '다방면(가)이라한과 BIM 고도화 취진',
                'link' => '/news/member/3',
            ],
            [
                'id' => 4,
                'company' => '포스코A&C',
                'title' => '신본 전면도 사이트 신규 오픈',
                'link' => '/news/member/4',
            ],
            [
                'id' => 5,
                'company' => '포백에이엔컨설턴트',
                'title' => '포백에이앤컨설턴트, 2025년 수 제출 포...',
                'link' => '/news/member/5',
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
     * 우측 세로 광고 배너 데이터
     */
    public static function getSidebarAds(): array
    {
        return [
            [
                'id' => 1,
                'title' => '한국CM협회',
                'type' => 'youtube',
                'image' => '/images/ads/youtube-banner.png',
                'link' => 'https://www.youtube.com/@cmak',
            ],
            [
                'id' => 2,
                'title' => 'E주건',
                'type' => 'ad',
                'image' => '/images/ads/ejugun.png',
                'link' => '#',
            ],
            [
                'id' => 3,
                'title' => 'TOPEC',
                'type' => 'ad',
                'image' => '/images/ads/topec.png',
                'link' => '#',
            ],
            [
                'id' => 4,
                'title' => 'KunWol',
                'type' => 'ad',
                'image' => '/images/ads/kunwol.png',
                'link' => '#',
            ],
            [
                'id' => 5,
                'title' => '양평 건축사 후반 JX베이',
                'type' => 'ad',
                'image' => '/images/ads/jxbay.png',
                'link' => '#',
            ],
            [
                'id' => 6,
                'title' => '대건에비뉴제조건축사사무소',
                'type' => 'ad',
                'image' => '/images/ads/daegun.png',
                'link' => '#',
            ],
            [
                'id' => 7,
                'title' => 'MOOYOUNG CM',
                'type' => 'ad',
                'image' => '/images/ads/mooyoung.png',
                'link' => '#',
            ],
            [
                'id' => 8,
                'title' => '부일엔지니어링건축사사무소',
                'type' => 'ad',
                'image' => '/images/ads/buil.png',
                'link' => '#',
            ],
            [
                'id' => 9,
                'title' => 'SAMOO CM',
                'type' => 'ad',
                'image' => '/images/ads/samoo.png',
                'link' => '#',
            ],
        ];
    }
}
