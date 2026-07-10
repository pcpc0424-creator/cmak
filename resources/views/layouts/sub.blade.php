<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="한국CM협회 - 건설사업관리 전문가 협회">
    <title>@yield('title', '한국CM협회 - CMAK')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        /* 서브 페이지 전용 스타일 */
        .sub-page-hero {
            background: linear-gradient(135deg, #0a3d7c 0%, #0061c2 100%);
            padding: 180px 20px 50px;
            position: relative;
            overflow: hidden;
        }
        .sub-page-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
        }
        .sub-page-hero-inner {
            max-width: 1420px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .sub-page-hero h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .sub-page-breadcrumb {
            display: flex;
            align-items: center;
            gap: 8px;
            color: rgba(255,255,255,0.7);
            font-size: 13px;
        }
        .sub-page-breadcrumb a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }
        .sub-page-breadcrumb a:hover {
            color: #fff;
        }
        .sub-page-breadcrumb svg {
            width: 12px;
            height: 12px;
            opacity: 0.5;
        }

        .sub-page-body {
            background: #f5f6f8;
            min-height: 60vh;
        }
        .sub-page-container {
            max-width: 1420px;
            margin: 0 auto;
            padding: 40px 20px 80px;
            display: flex;
            gap: 30px;
        }

        /* 좌측 사이드 메뉴 */
        .sub-side-menu {
            width: 220px;
            flex-shrink: 0;
        }
        .sub-side-title {
            background: linear-gradient(135deg, #0a3d7c, #0061c2);
            color: #fff;
            font-size: 18px;
            font-weight: 700;
            padding: 18px 20px;
            border-radius: 8px 8px 0 0;
        }
        .sub-side-list {
            background: #fff;
            border: 1px solid #e1e1e1;
            border-top: none;
            border-radius: 0 0 8px 8px;
            overflow: hidden;
        }
        .sub-side-list a {
            display: block;
            padding: 13px 20px;
            font-size: 14px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.15s;
        }
        .sub-side-list a:last-child {
            border-bottom: none;
        }
        .sub-side-list a:hover,
        .sub-side-list a.active {
            background: #f0f4fa;
            color: #0061c2;
            font-weight: 600;
            padding-left: 25px;
        }

        /* 우측 콘텐츠 */
        .sub-content {
            flex: 1;
            min-width: 0;
        }
        .sub-content-card {
            background: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 40px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.04);
        }
        .sub-content-title {
            font-size: 22px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 8px;
            padding-bottom: 16px;
            border-bottom: 2px solid #0061c2;
        }
        .sub-content-desc {
            font-size: 14px;
            color: #888;
            margin-bottom: 30px;
        }

        /* 콘텐츠 내부 스타일 */
        .sub-section {
            margin-bottom: 40px;
        }
        .sub-section:last-child {
            margin-bottom: 0;
        }
        .sub-section-title {
            font-size: 17px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 16px;
            padding-left: 12px;
            border-left: 3px solid #0061c2;
        }
        .sub-section p {
            font-size: 14.5px;
            line-height: 1.8;
            color: #444;
        }

        /* 테이블 스타일 */
        .sub-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }
        .sub-table thead th {
            background: #f0f4fa;
            color: #1a1a1a;
            font-weight: 600;
            padding: 12px 16px;
            border: 1px solid #dde3ed;
            text-align: center;
            white-space: nowrap;
        }
        .sub-table tbody td {
            padding: 11px 16px;
            border: 1px solid #e8ecf1;
            color: #444;
            vertical-align: middle;
        }
        .sub-table tbody tr:hover {
            background: #fafbfc;
        }

        /* 이미지 콘텐츠 */
        .sub-img-content {
            max-width: 100%;
            border-radius: 4px;
        }

        /* 인포 박스 */
        .sub-info-box {
            background: #f8f9fb;
            border: 1px solid #e8ecf1;
            border-radius: 8px;
            padding: 24px 28px;
            margin-bottom: 20px;
        }
        .sub-info-box dt {
            font-size: 13px;
            font-weight: 600;
            color: #0061c2;
            margin-bottom: 4px;
        }
        .sub-info-box dd {
            font-size: 14px;
            color: #444;
            margin-bottom: 12px;
            line-height: 1.6;
        }
        .sub-info-box dd:last-child {
            margin-bottom: 0;
        }

        /* 반응형 */
        @media (max-width: 1024px) {
            .sub-page-hero { padding-top: 120px; }
            .sub-page-container { flex-direction: column; }
            .sub-side-menu { width: 100%; }
            .sub-side-list { display: flex; flex-wrap: wrap; }
            .sub-side-list a { flex: 1; min-width: 120px; text-align: center; border-bottom: none; border-right: 1px solid #f0f0f0; }
            .sub-content-card { padding: 24px; }
        }
        @media (max-width: 768px) {
            /* 가로 스크롤 원천 차단 */
            html, body { overflow-x: hidden; }
            .sub-page-body, .sub-page-container, .sub-content { max-width: 100%; overflow-x: hidden; }

            .sub-page-hero { padding: 120px 16px 30px; }
            .sub-page-hero h1 { font-size: 1.35rem; word-break: keep-all; }
            .sub-page-breadcrumb { flex-wrap: wrap; font-size: 12px; gap: 4px; word-break: keep-all; }

            .sub-page-container { padding: 20px 12px 40px; gap: 16px; }

            /* 사이드 메뉴 — 메뉴명이 잘리지 않게 2줄 허용, 글자 세로쌓임 방지 */
            .sub-side-title { font-size: 16px; padding: 14px 16px; }
            .sub-side-list a {
                flex: 1 1 33%;
                min-width: 0;
                padding: 11px 6px;
                font-size: 12.5px;
                line-height: 1.35;
                word-break: keep-all;
                overflow-wrap: break-word;
                text-align: center;
            }

            /* 본문 카드 */
            .sub-content-card { padding: 16px 14px; border-radius: 6px; max-width: 100%; }
            .sub-content-title { font-size: 17px; padding-bottom: 12px; margin-bottom: 6px; word-break: keep-all; }
            .sub-content-desc { font-size: 13px; margin-bottom: 20px; word-break: keep-all; }

            .sub-section { margin-bottom: 28px; max-width: 100%; }
            .sub-section-title { font-size: 15px; margin-bottom: 12px; word-break: keep-all; }
            .sub-section p { font-size: 13.5px; line-height: 1.75; word-break: keep-all; overflow-wrap: break-word; }
            .sub-section ul, .sub-section ol { padding-left: 20px !important; font-size: 13.5px; line-height: 1.75; }
            .sub-section ul li, .sub-section ol li { word-break: keep-all; overflow-wrap: break-word; }

            /* 테이블 — 좁은 화면에서 콘텐츠가 글자 세로쌓임 없이 자연스럽게 wrap */
            .sub-table { font-size: 12.5px; table-layout: auto; width: 100%; }
            .sub-table thead th {
                padding: 8px 6px;
                white-space: normal;
                word-break: keep-all;
                overflow-wrap: break-word;
                font-size: 12px;
                line-height: 1.4;
            }
            .sub-table tbody td {
                padding: 8px 6px;
                word-break: keep-all;
                overflow-wrap: break-word;
                line-height: 1.55;
            }
            .sub-table tbody td a { word-break: break-all; overflow-wrap: anywhere; }

            /* 테이블이 넘치면 테이블만 가로 스크롤 (페이지 스크롤 X) */
            .sub-section > .sub-table,
            .sub-section .sub-table-wrap,
            .sub-table-wrap {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            /* 게시판 목록: 좁은 화면에서 제목란이 뭉개지지 않도록 최소너비 확보 후 가로 스크롤 */
            .sub-table-wrap .sub-table { min-width: 620px; }

            /* 이미지 — 원본 지정 width 무시하고 컨테이너 맞춤 */
            .sub-content-card img { max-width: 100% !important; height: auto !important; }

            /* 인포 박스 */
            .sub-info-box { padding: 16px 18px; }
            .sub-info-box dd { font-size: 13px; word-break: keep-all; overflow-wrap: break-word; }

            /* 역대 ConsMa 배너 높이 조정 */
            .consma-banner { padding-top: 50% !important; }
            .consma-btn { right: 10px !important; bottom: 10px !important; padding: 6px 12px !important; font-size: 11px !important; }

            /* 부서별 업무 카드 */
            .dept-grid { grid-template-columns: 1fr !important; gap: 14px !important; }
            .dept-header { padding: 12px 14px !important; flex-direction: column !important; align-items: flex-start !important; gap: 2px !important; }
            .dept-duties { padding: 12px 18px !important; }
            .dept-duties li { font-size: 12.5px !important; }

            /* 연혁 페이지 */
            .history-year-img { max-width: 100% !important; }
            .history-events { padding-left: 16px !important; font-size: 13px !important; }
            .history-events li { word-break: keep-all; overflow-wrap: break-word; }

            /* 인라인 style grid (회원가입 절차, 혜택 박스 등) — 2~3열짜리 모바일 1열 */
            [style*="grid-template-columns"][style*="minmax"] {
                grid-template-columns: 1fr !important;
            }

            /* 가로 flex 박스 래핑 & 간격 축소 */
            [style*="display:flex"][style*="flex-wrap"] { gap: 6px !important; }

            /* 회원가입 STEP 박스 등 고정 너비 min-width 해제 */
            .sub-content-card [style*="min-width:120px"],
            .sub-content-card [style*="min-width:280px"],
            .sub-content-card [style*="min-width:250px"],
            .sub-content-card [style*="min-width:200px"] {
                min-width: 0 !important;
            }
        }
        @media (max-width: 480px) {
            .sub-page-hero h1 { font-size: 1.2rem; }
            .sub-content-card { padding: 14px 10px; }
            .sub-side-list a { font-size: 12px; padding: 10px 4px; flex: 1 1 50%; }
            .sub-table { font-size: 11.5px; }
            .sub-table thead th, .sub-table tbody td { padding: 6px 4px; font-size: 11px; }
        }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    @include('components.header')

    {{-- 서브 페이지 히어로 --}}
    <div class="sub-page-hero">
        <div class="sub-page-hero-inner">
            <div class="sub-page-breadcrumb">
                <a href="/cmak">HOME</a>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                <a href="@yield('category-link', '#')">@yield('category', '')</a>
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                <span style="color:#fff;">@yield('page-title', '')</span>
            </div>
            <h1>@yield('page-title', '')</h1>
        </div>
    </div>

    {{-- 서브 페이지 본문 --}}
    <div class="sub-page-body">
        <div class="sub-page-container">
            {{-- 좌측 사이드 메뉴 --}}
            <aside class="sub-side-menu">
                <div class="sub-side-title">@yield('category', '')</div>
                <nav class="sub-side-list">
                    @yield('side-menu')
                </nav>
            </aside>

            {{-- 우측 콘텐츠 --}}
            <div class="sub-content">
                @yield('content')
            </div>
        </div>
    </div>

    @include('components.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // 헤더 스크롤 효과 (서브페이지는 항상 scrolled 상태)
        var header = document.getElementById('mainHeader');
        if (header) header.classList.add('scrolled');

        // === 팝업 (서브 페이지에서는 기본 접힘, 토글 가능) ===
        var topPop = document.getElementById('topPop');
        var topPopBtn = document.getElementById('topPopBtn');
        var topPopBtnSpan = document.getElementById('topPopBtnSpan');
        var subWraps = document.querySelectorAll('.icak-sub-wrap');
        var POPUP_HEIGHT = window.innerWidth <= 1024 ? 70 : 120;
        var HEADER_HEIGHT = 125;
        var popupOpen = false;

        function applyHeaderTop(open) {
            var headerTop = open ? POPUP_HEIGHT : 0;
            if (header) header.style.top = headerTop + 'px';
            var heroEl = document.querySelector('.sub-page-hero');
            if (heroEl) heroEl.style.paddingTop = (headerTop + HEADER_HEIGHT + 55) + 'px';
            subWraps.forEach(function(sw) { sw.style.top = (headerTop + HEADER_HEIGHT) + 'px'; });
        }

        if (topPop) {
            topPop.classList.add('active');
            if (topPopBtnSpan) topPopBtnSpan.classList.add('active');
            applyHeaderTop(false);

            if (topPopBtn) {
                topPopBtn.addEventListener('click', function() {
                    popupOpen = !popupOpen;
                    if (popupOpen) {
                        topPop.classList.remove('active');
                        if (topPopBtnSpan) topPopBtnSpan.classList.remove('active');
                    } else {
                        topPop.classList.add('active');
                        if (topPopBtnSpan) topPopBtnSpan.classList.add('active');
                    }
                    applyHeaderTop(popupOpen);
                });
            }

            window.addEventListener('resize', function() {
                POPUP_HEIGHT = window.innerWidth <= 1024 ? 70 : 120;
                applyHeaderTop(popupOpen);
            });
        } else {
            subWraps.forEach(function(sw) { sw.style.top = HEADER_HEIGHT + 'px'; });
        }

        // 전체메뉴 토글
        var mainMenu = document.getElementById('mainMenu');
        var mainMenuBtn = document.querySelector('.icak-btn-mainmenu a');
        if (mainMenuBtn && mainMenu) {
            mainMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                mainMenu.classList.toggle('active');
            });
            mainMenu.addEventListener('click', function(e) {
                if (e.target === mainMenu) mainMenu.classList.remove('active');
            });
            // 닫기(X) 버튼
            var mainMenuClose = document.getElementById('mainMenuClose');
            if (mainMenuClose) {
                mainMenuClose.addEventListener('click', function() {
                    mainMenu.classList.remove('active');
                });
            }
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && mainMenu.classList.contains('active')) mainMenu.classList.remove('active');
            });
        }
    });
    </script>
</body>
</html>
