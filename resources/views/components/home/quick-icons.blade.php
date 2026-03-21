{{--
    퀵메뉴 아이콘 컴포넌트
    CM이란?, 협회안내, 주요행사일정, 부서별연락처, 회원현황, 회원가입, CM능력평가/공시, 자격검정
--}}
@props(['schedule' => []])

<div class="grid grid-cols-4 sm:grid-cols-4 lg:grid-cols-8 gap-4">
    {{-- CM이란? --}}
    <a href="/cmdata/about" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-indigo-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-indigo-600">CM이란?</span>
    </a>

    {{-- 협회안내 --}}
    <a href="/intro/about" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-600 to-slate-700 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-slate-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-slate-600">협회안내</span>
    </a>

    {{-- 주요행사 일정 --}}
    <a href="{{ $schedule['link'] ?? '#' }}" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200 relative">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-cyan-500/20 relative">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            @if($schedule['month'] ?? null)
            <span class="absolute -top-1 -right-1 px-1.5 py-0.5 bg-red-500 text-white text-[9px] font-bold rounded">{{ $schedule['month'] }}</span>
            @endif
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-cyan-600">주요행사 일정</span>
        @if($schedule['title'] ?? null)
        <span class="text-[10px] text-cyan-600">{{ $schedule['title'] }}</span>
        @endif
    </a>

    {{-- 부서별연락처 --}}
    <a href="/intro/departments" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-emerald-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-emerald-600">부서별연락처</span>
    </a>

    {{-- 회원현황 --}}
    <a href="/intro/members" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-purple-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-purple-600">회원현황</span>
    </a>

    {{-- 회원가입 --}}
    <a href="/business/membership" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-blue-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-blue-600">회원가입</span>
    </a>

    {{-- CM능력평가/공시 --}}
    <a href="/business/certification" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-primary-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-primary-600">CM능력평가/공시</span>
    </a>

    {{-- 건설사업관리사 자격검정 --}}
    <a href="/business/inspection" class="group flex flex-col items-center p-3 rounded-xl hover:bg-white hover:shadow-md transition-all duration-200">
        <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center mb-2 group-hover:scale-105 transition-transform shadow-lg shadow-orange-500/20">
            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
            </svg>
        </div>
        <span class="text-xs font-medium text-gray-700 text-center group-hover:text-orange-600 leading-tight">건설사업관리사<br>자격검정</span>
    </a>
</div>
