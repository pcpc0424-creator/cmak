<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="한국CM협회 - 건설사업관리 전문가 협회">
    <title>@yield('title', '한국CM협회 - CMAK')</title>

    <!-- Pretendard 폰트 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.min.css">

    <!-- Heroicons -->
    <script src="https://unpkg.com/@heroicons/v2.0.18/24/outline/index.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    <!-- 헤더 -->
    @include('components.header')

    <!-- 메인 콘텐츠 -->
    <main>
        @yield('content')
    </main>

    <!-- 푸터 -->
    @include('components.footer')

    <!-- Alpine.js + Plugins -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
