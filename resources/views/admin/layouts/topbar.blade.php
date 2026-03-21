{{-- Admin Topbar - Fixed Top --}}
<header class="fixed top-0 left-[260px] right-0 h-16 bg-white shadow-sm z-30 flex items-center justify-between px-6">
    {{-- Left: Page Title --}}
    <h1 class="text-lg font-semibold text-gray-800">
        @yield('title', '관리자')
    </h1>

    {{-- Right: User Info & Logout --}}
    <div class="flex items-center gap-4">
        {{-- Site Link --}}
        <a href="{{ url('/') }}" target="_blank" class="text-sm text-gray-500 hover:text-blue-600 transition-colors flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            사이트 보기
        </a>

        <div class="w-px h-6 bg-gray-200"></div>

        {{-- User Name --}}
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <span class="text-sm text-gray-700 font-medium">
                {{ Auth::check() ? Auth::user()->name : '관리자' }}
            </span>
        </div>

        {{-- Logout Button --}}
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
