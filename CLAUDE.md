# CMAK 메인 페이지 리뉴얼 작업 내역

## 프로젝트 개요
- **사이트**: 한국CM협회 (cmak.or.kr)
- **작업**: 메인 페이지 리뉴얼 - 기존 레이아웃 유지 + 최신 트렌드 적용
- **참고 사이트**: https://www.icak.or.kr/

## 레이아웃 구조

### 1. 메인 배너 슬라이더
- 위치: 페이지 최상단
- 이미지: `/public/images/banners/main_visual1~4.jpg`
- 기능: 5초 자동 슬라이드, 좌우 네비게이션, 하단 인디케이터
- 컴포넌트: `components/home/main-banner.blade.php`

### 2. 3단 레이아웃 (메인 콘텐츠)
- **좌측 (280px)**: 새소식 + 협회소식
  - 컴포넌트: `components/home/latest-news.blade.php`
- **중앙 (flex-1)**:
  - 뉴스탭 (국내외소식/법령소식/유관기관소식): `components/home/news-tabs.blade.php`
  - 공지사항/보도자료 탭: `components/home/notice-tabs.blade.php`
- **우측 (180px)**: 세로 광고 배너
  - 컴포넌트: `components/home/sidebar-ads.blade.php`

### 3. 회원사 가로 배너 슬라이더
- 컴포넌트: `components/home/member-banners.blade.php`
- 회원사: SHINHWA, JUNGLIM CM, 포스코A&C, PCM, heerim

### 4. 퀵메뉴 아이콘 (8개)
- 컴포넌트: `components/home/quick-icons.blade.php`
- 메뉴: CM이란?, 협회안내, 주요행사일정, 부서별연락처, 회원현황, 회원가입, CM능력평가/공시, 자격검정

### 5. 전문가 칼럼 + BookReview
- 컴포넌트: `components/home/columns-section.blade.php`

## 주요 파일 목록

### 메인 페이지
- `resources/views/home.blade.php`

### 컴포넌트
- `resources/views/components/home/main-banner.blade.php` - 메인 배너 슬라이더
- `resources/views/components/home/latest-news.blade.php` - 새소식/협회소식
- `resources/views/components/home/news-tabs.blade.php` - 뉴스 탭
- `resources/views/components/home/notice-tabs.blade.php` - 공지사항/보도자료 탭
- `resources/views/components/home/sidebar-ads.blade.php` - 우측 세로 광고
- `resources/views/components/home/member-banners.blade.php` - 회원사 배너
- `resources/views/components/home/quick-icons.blade.php` - 퀵메뉴 아이콘
- `resources/views/components/home/columns-section.blade.php` - 칼럼/북리뷰

### 데이터
- `app/Data/HomeData.php` - 모든 더미 데이터 (추후 API/DB 연동 예정)

## 이미지 경로 설정
- nginx가 `/cmak` 경로로 설정되어 있음
- 이미지 경로는 `/cmak/images/...` 형태로 사용
- `$basePath = '/cmak'` 변수 사용

## 기술 스택
- Laravel + Blade
- Tailwind CSS
- Alpine.js (슬라이더, 탭 전환)

## 주의사항
- APP_URL이 localhost로 되어있어 `asset()` 함수 대신 직접 경로 사용
- 이미지 파일 권한: `www-data:www-data`, `644`
- 캐시 클리어: `php artisan view:clear && php artisan cache:clear`

## 빌드 명령어
```bash
cd /var/www/cmak
npm run build
php artisan optimize
php artisan route:cache
php artisan view:cache
```

## 캐시 클리어
```bash
php artisan optimize:clear
```

## 최적화 완료 (2026-02-12)
- Laravel 캐시 최적화 (config, routes, views)
- Vite 프로덕션 빌드
- 테스트 파일 정리
