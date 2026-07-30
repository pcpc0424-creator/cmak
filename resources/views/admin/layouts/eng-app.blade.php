<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '영문사이트 관리') - CMAK 관리자</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-scroll::-webkit-scrollbar { width: 4px; }
        .sidebar-scroll::-webkit-scrollbar-track { background: transparent; }
        .sidebar-scroll::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 2px; }
        .sidebar-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.3); }
        .admin-main .max-w-2xl, .admin-main .max-w-3xl, .admin-main .max-w-4xl,
        .admin-main .max-w-5xl, .admin-main .max-w-6xl, .admin-main .max-w-7xl { max-width: 100% !important; }
        .admin-main form { max-width: 960px; }
        .admin-main .bg-white form, .admin-main form.flex, .admin-main form.inline-flex { max-width: none; }
        .admin-main button, .admin-main a.inline-flex, .admin-main a[class*="rounded"] { white-space: nowrap; }
    </style>
</head>
<body class="bg-gray-100 min-h-screen">
    {{-- English Sidebar --}}
    @include('admin.layouts.eng-sidebar')

    {{-- Main Content Area --}}
    <div class="ml-[260px]">
        {{-- Topbar --}}
        <header class="fixed top-0 left-[260px] right-0 h-16 bg-white shadow-sm z-30 flex items-center justify-between px-6">
            <h1 class="text-lg font-semibold text-gray-800">
                <span class="text-indigo-600">EN</span> @yield('title', '영문사이트 관리')
            </h1>
            <div class="flex items-center gap-4">
                <a href="{{ url('/eng') }}" target="_blank" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                    영문 사이트 보기
                </a>
                <div class="w-px h-6 bg-gray-200"></div>
                <span class="text-sm text-gray-700 font-medium">{{ Auth::check() ? Auth::user()->name : '관리자' }}</span>
                <form method="POST" action="{{ url('/admin/logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 text-sm text-gray-500 hover:text-red-600 transition-colors px-3 py-1.5 rounded-md hover:bg-red-50">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        로그아웃
                    </button>
                </form>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="admin-main pt-16">
            <div class="px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </div>
        </main>
    </div>

    {{-- Flash Message Toast --}}
    @if(session('success') || session('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
        class="fixed bottom-6 right-6 z-50">
        @if(session('success'))
        <div class="flex items-center gap-3 bg-green-600 text-white px-5 py-3 rounded-lg shadow-lg">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="ml-2 hover:opacity-80"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        @endif
        @if(session('error'))
        <div class="flex items-center gap-3 bg-red-600 text-white px-5 py-3 rounded-lg shadow-lg">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>{{ session('error') }}</span>
            <button @click="show = false" class="ml-2 hover:opacity-80"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg></button>
        </div>
        @endif
    </div>
    @endif

    @stack('scripts')
</body>
</html>
