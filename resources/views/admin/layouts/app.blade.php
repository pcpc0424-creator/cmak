<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '관리자') - CMAK 관리자</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        /* Custom scrollbar for sidebar */
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 2px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }

        /* 콘텐츠 영역 반응형 유동폭 — 각 페이지의 고정 max-width를 해제해 화면 폭에 맞춰 확장.
           (폼은 지나치게 넓어지지 않도록 큰 화면에서 상한만 적용) */
        .admin-main .max-w-2xl,
        .admin-main .max-w-3xl,
        .admin-main .max-w-4xl,
        .admin-main .max-w-5xl,
        .admin-main .max-w-6xl,
        .admin-main .max-w-7xl { max-width: 100% !important; }
        /* 목록/표는 화면 폭을 채우되, 입력 폼(create/edit)은 읽기 좋은 너비로 제한
           — 폼이 초광폭으로 늘어나 버튼 바가 과도하게 벌어지는 것 방지 */
        .admin-main form { max-width: 960px; }
        /* 단, 검색바처럼 카드 안에 들어간 가로 폼은 너비 제한 없이 그대로 */
        .admin-main .bg-white form,
        .admin-main form.flex,
        .admin-main form.inline-flex { max-width: none; }

        /* 버튼 줄바꿈(세로 텍스트) 방지 — 버튼/액션 링크는 한 줄 유지 */
        .admin-main button,
        .admin-main a.inline-flex,
        .admin-main a[class*="rounded"] { white-space: nowrap; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    @php $basePath = ''; @endphp

    {{-- Sidebar --}}
    @include('admin.layouts.sidebar', ['basePath' => $basePath])

    {{-- Main Content Area --}}
    <div class="ml-[260px]">
        {{-- Topbar --}}
        @include('admin.layouts.topbar', ['basePath' => $basePath])

        {{-- Page Content --}}
        <main class="admin-main pt-16">
            <div class="px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Flash Message Toast --}}
    @if(session('success') || session('error'))
    <div
        x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-6 right-6 z-50"
    >
        @if(session('success'))
        <div class="flex items-center gap-3 bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-2 hover:opacity-80">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="flex items-center gap-3 bg-red-600 text-white px-5 py-3 rounded-lg shadow-lg">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span>{{ session('error') }}</span>
            <button @click="show = false" class="ml-2 hover:opacity-80">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
        @endif
    </div>
    @endif

    @stack('scripts')
</body>
</html>
