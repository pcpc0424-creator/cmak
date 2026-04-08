<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="CMAK - Construction Management Association of Korea">
    <title>@yield('title', 'CMAK - Construction Management Association of Korea')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @hasSection('hero') @else <link rel="preload" as="image" href="/cmak/images/eng/eng1.jpg"> @endif

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }

        body.eng-body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            color: #1a1a1a;
            background: #fff;
        }

        /* === Header === */
        .eng-header {
            position: fixed;
            top: 0; left: 0; right: 0;
            height: 80px;
            background: rgba(255,255,255,0.97);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.06);
            z-index: 100;
            transition: all 0.3s;
        }
        .eng-header-inner {
            max-width: 1420px;
            height: 100%;
            margin: 0 auto;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }
        .eng-logo a {
            display: flex; align-items: center; gap: 12px;
            text-decoration: none;
        }
        .eng-logo-icon {
            display: inline-flex;
            align-items: center; justify-content: center;
            width: 44px; height: 44px;
            background: linear-gradient(135deg, #0a3d7c, #0061c2);
            color: #fff;
            font-weight: 800; font-size: 16px;
            border-radius: 8px;
            letter-spacing: -0.5px;
        }
        .eng-logo-text strong {
            display: block;
            font-size: 18px; font-weight: 800;
            color: #0a3d7c;
            line-height: 1;
            letter-spacing: -0.5px;
        }
        .eng-logo-text em {
            display: block;
            font-size: 10px;
            color: #777;
            font-style: normal;
            margin-top: 3px;
            letter-spacing: 0.2px;
        }

        .eng-gnb {
            display: flex;
            list-style: none;
            margin: 0; padding: 0;
            flex: 1;
            justify-content: center;
            gap: 8px;
        }
        .eng-gnb > li { position: relative; }
        .eng-gnb > li > a {
            display: block;
            padding: 28px 18px;
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
            text-decoration: none;
            transition: color 0.2s;
        }
        .eng-gnb > li > a:hover { color: #0061c2; }
        .eng-gnb > li:hover .eng-sub-wrap { display: block; }

        .eng-sub-wrap {
            display: none;
            position: absolute;
            top: 80px; left: 50%;
            transform: translateX(-50%);
            min-width: 240px;
            background: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 0 0 8px 8px;
            box-shadow: 0 12px 32px rgba(0,0,0,0.08);
            padding: 12px 0;
            z-index: 99;
        }
        .eng-sub-area { padding: 0; }
        .eng-sub-title {
            display: none;
        }
        .eng-sub-list a {
            display: block;
            padding: 11px 22px;
            font-size: 14px;
            color: #444;
            text-decoration: none;
            transition: all 0.15s;
        }
        .eng-sub-list a:hover {
            background: #f0f4fa;
            color: #0061c2;
            padding-left: 28px;
        }

        .eng-header-util {
            display: flex; align-items: center; gap: 10px;
        }
        .eng-lang-btn {
            display: inline-flex;
            align-items: center; justify-content: center;
            padding: 8px 16px;
            font-size: 12px; font-weight: 700;
            color: #0a3d7c;
            border: 1.5px solid #0a3d7c;
            border-radius: 999px;
            text-decoration: none;
            transition: all 0.2s;
            letter-spacing: 0.5px;
        }
        .eng-lang-btn:hover {
            background: #0a3d7c; color: #fff;
        }
        .eng-special-btn {
            display: inline-flex;
            align-items: center; justify-content: center;
            padding: 9px 18px;
            font-size: 12px; font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #0a3d7c, #0061c2);
            border-radius: 999px;
            text-decoration: none;
            transition: all 0.2s;
            letter-spacing: 0.5px;
        }
        .eng-special-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(10,61,124,0.25);
        }
        .eng-mobile-btn {
            display: none;
            background: none;
            border: none;
            cursor: pointer;
            color: #1a1a1a;
        }
        .eng-mobile-menu {
            display: none;
            position: absolute;
            top: 80px; left: 0; right: 0;
            background: #fff;
            border-top: 1px solid #e1e1e1;
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }
        .eng-mobile-menu nav { padding: 12px 20px; }
        .eng-mobile-item {
            display: flex; align-items: center; justify-content: space-between;
            width: 100%; padding: 14px 8px;
            background: none; border: none; border-bottom: 1px solid #f0f0f0;
            font-size: 15px; font-weight: 600; color: #1a1a1a;
            text-align: left; cursor: pointer;
        }
        .eng-mobile-sub { background: #f8f9fb; padding: 6px 0; }
        .eng-mobile-sub a {
            display: block; padding: 10px 24px;
            font-size: 14px; color: #555; text-decoration: none;
        }
        .eng-mobile-sub a:hover { color: #0061c2; }

        @media (max-width: 1100px) {
            .eng-gnb { display: none; }
            .eng-mobile-btn { display: block; }
            .eng-mobile-menu { display: block; }
            .eng-header-util { gap: 6px; }
            .eng-special-btn { padding: 7px 12px; font-size: 11px; }
        }

        /* === Sub Page Hero === */
        .eng-sub-hero {
            margin-top: 80px;
            background: linear-gradient(135deg, #0a3d7c 0%, #0061c2 100%);
            padding: 80px 20px 60px;
            position: relative;
            overflow: hidden;
        }
        .eng-sub-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
        .eng-sub-hero-inner {
            max-width: 1420px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .eng-breadcrumb {
            display: flex; align-items: center; gap: 8px;
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            margin-bottom: 14px;
        }
        .eng-breadcrumb a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
        }
        .eng-breadcrumb a:hover { color: #fff; }
        .eng-breadcrumb svg { width: 12px; height: 12px; opacity: 0.5; }
        .eng-sub-hero h1 {
            color: #fff;
            font-size: 2.4rem;
            font-weight: 800;
            letter-spacing: -0.5px;
            margin: 0;
        }

        /* === Sub Page Body === */
        .eng-sub-body {
            background: #f5f6f8;
            min-height: 60vh;
        }
        .eng-sub-container {
            max-width: 1420px;
            margin: 0 auto;
            padding: 50px 20px 100px;
            display: flex;
            gap: 36px;
        }
        .eng-side {
            width: 240px;
            flex-shrink: 0;
        }
        .eng-side-title {
            background: linear-gradient(135deg, #0a3d7c, #0061c2);
            color: #fff;
            font-size: 17px;
            font-weight: 700;
            padding: 22px 22px;
            border-radius: 10px 10px 0 0;
            letter-spacing: -0.3px;
        }
        .eng-side-list {
            background: #fff;
            border: 1px solid #e1e1e1;
            border-top: none;
            border-radius: 0 0 10px 10px;
            overflow: hidden;
        }
        .eng-side-list a {
            display: block;
            padding: 14px 22px;
            font-size: 14px;
            color: #444;
            text-decoration: none;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.15s;
            position: relative;
        }
        .eng-side-list a:last-child { border-bottom: none; }
        .eng-side-list a:hover,
        .eng-side-list a.active {
            background: #f0f4fa;
            color: #0061c2;
            font-weight: 600;
            padding-left: 28px;
        }
        .eng-side-list a.active::before {
            content: '';
            position: absolute;
            left: 0; top: 0; bottom: 0;
            width: 3px;
            background: #0061c2;
        }

        .eng-content {
            flex: 1;
            min-width: 0;
        }
        .eng-card {
            background: #fff;
            border: 1px solid #e1e1e1;
            border-radius: 12px;
            padding: 50px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.04);
        }
        .eng-card h2 {
            font-size: 26px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 8px;
            padding-bottom: 18px;
            border-bottom: 2px solid #0061c2;
            letter-spacing: -0.5px;
        }
        .eng-card .desc {
            font-size: 14px;
            color: #888;
            margin-bottom: 32px;
        }
        .eng-card h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 32px 0 14px;
            padding-left: 14px;
            border-left: 3px solid #0061c2;
        }
        .eng-card p {
            font-size: 15px;
            line-height: 1.85;
            color: #444;
            margin-bottom: 16px;
        }
        .eng-card ul, .eng-card ol {
            margin: 12px 0 18px 22px;
            color: #444;
            font-size: 15px;
            line-height: 1.85;
        }
        .eng-card li { margin-bottom: 6px; }

        .eng-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            margin: 18px 0;
        }
        .eng-table thead th {
            background: #f0f4fa;
            color: #1a1a1a;
            font-weight: 700;
            padding: 14px 16px;
            border: 1px solid #dde3ed;
            text-align: center;
        }
        .eng-table tbody td {
            padding: 12px 16px;
            border: 1px solid #e8ecf1;
            color: #444;
        }
        .eng-table tbody tr:hover { background: #fafbfc; }

        .eng-info-box {
            background: #f8f9fb;
            border: 1px solid #e8ecf1;
            border-radius: 10px;
            padding: 26px 30px;
            margin: 18px 0;
        }
        .eng-info-box dt {
            font-size: 12px;
            font-weight: 700;
            color: #0061c2;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }
        .eng-info-box dd {
            font-size: 15px;
            color: #1a1a1a;
            margin-bottom: 14px;
            line-height: 1.6;
        }
        .eng-info-box dd:last-child { margin-bottom: 0; }

        /* === Footer === */
        .eng-footer {
            background: #4e5761;
            color: #fff;
        }
        .eng-footer-top {
            background: #424a54;
            padding: 14px 20px;
        }
        .eng-footer-top-inner {
            max-width: 1420px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
        }
        .eng-footer-links {
            display: flex; gap: 26px;
        }
        .eng-footer-links a {
            color: #c8cdd3;
            font-size: 13px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .eng-footer-links a:hover { color: #fff; }
        .eng-footer-family select {
            background: #5a626c;
            color: #fff;
            border: 1px solid #6a727c;
            padding: 7px 14px;
            font-size: 13px;
            border-radius: 4px;
            cursor: pointer;
        }
        .eng-footer-bottom {
            padding: 32px 20px;
        }
        .eng-footer-bottom-inner {
            max-width: 1420px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 36px;
            flex-wrap: wrap;
        }
        .eng-footer-info p {
            font-size: 13px;
            color: #c8cdd3;
            line-height: 1.7;
            margin: 0;
        }
        .eng-footer-info .copyright {
            margin-top: 6px;
            font-size: 12px;
            color: #9aa1a8;
        }

        @media (max-width: 1024px) {
            .eng-sub-container { flex-direction: column; }
            .eng-side { width: 100%; }
            .eng-side-list { display: flex; flex-wrap: wrap; }
            .eng-side-list a { flex: 1; min-width: 140px; text-align: center; border-bottom: none; border-right: 1px solid #f0f0f0; }
            .eng-card { padding: 30px; }
        }
        @media (max-width: 768px) {
            .eng-sub-hero { padding: 60px 20px 40px; }
            .eng-sub-hero h1 { font-size: 1.7rem; }
            .eng-card { padding: 22px; }
            .eng-card h2 { font-size: 20px; }
        }
    </style>

    @stack('styles')
</head>
<body class="eng-body antialiased">
    @include('components.eng.header')

    @hasSection('hero')
        <div class="eng-sub-hero">
            <div class="eng-sub-hero-inner">
                <div class="eng-breadcrumb">
                    <a href="/cmak/eng">HOME</a>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                    <a href="@yield('category-link', '#')">@yield('category', '')</a>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"/></svg>
                    <span style="color:#fff;">@yield('page-title', '')</span>
                </div>
                <h1>@yield('page-title', '')</h1>
            </div>
        </div>

        <div class="eng-sub-body">
            <div class="eng-sub-container">
                <aside class="eng-side">
                    <div class="eng-side-title">@yield('category', '')</div>
                    <nav class="eng-side-list">
                        @yield('side-menu')
                    </nav>
                </aside>
                <div class="eng-content">
                    @yield('content')
                </div>
            </div>
        </div>
    @else
        @yield('content')
    @endif

    @include('components.eng.footer')

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('scripts')
</body>
</html>
