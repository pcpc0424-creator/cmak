{{--
    Quick Menu - ICAK 스타일 참고
    주요 서비스 바로가기 그리드
--}}
@props(['menus' => []])

<nav aria-label="주요 서비스" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{-- 섹션 헤더 --}}
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-xl font-bold text-gray-900">주요 서비스</h2>
            <a href="/business" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                전체보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- 서비스 그리드 --}}
        <div class="grid grid-cols-3 sm:grid-cols-4 lg:grid-cols-8 gap-3 lg:gap-4">
            {{-- CM 능력평가 --}}
            <a href="/business/certification" class="group flex flex-col items-center p-4 rounded-xl hover:bg-primary-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-primary-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-primary-700">CM 능력평가</span>
            </a>

            {{-- 자격검정 --}}
            <a href="/business/inspection" class="group flex flex-col items-center p-4 rounded-xl hover:bg-purple-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-purple-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-purple-700">자격검정</span>
            </a>

            {{-- CM 전문교육 --}}
            <a href="/business/education" class="group flex flex-col items-center p-4 rounded-xl hover:bg-cyan-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-cyan-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-cyan-700">전문교육</span>
            </a>

            {{-- 회원가입 --}}
            <a href="/business/membership" class="group flex flex-col items-center p-4 rounded-xl hover:bg-blue-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-blue-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-blue-700">회원가입</span>
            </a>

            {{-- CM Herald --}}
            <a href="/business/herald" class="group flex flex-col items-center p-4 rounded-xl hover:bg-orange-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-orange-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-orange-700">CM Herald</span>
            </a>

            {{-- 입찰정보 --}}
            <a href="/notice/tender" class="group flex flex-col items-center p-4 rounded-xl hover:bg-emerald-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-emerald-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-emerald-700">입찰정보</span>
            </a>

            {{-- CM이란 --}}
            <a href="/cmdata/about" class="group flex flex-col items-center p-4 rounded-xl hover:bg-indigo-50 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-indigo-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-indigo-700">CM이란</span>
            </a>

            {{-- 협회소개 --}}
            <a href="/intro/about" class="group flex flex-col items-center p-4 rounded-xl hover:bg-slate-100 transition-all duration-200">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-slate-600 to-slate-700 flex items-center justify-center mb-3 group-hover:scale-105 transition-transform shadow-lg shadow-slate-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <span class="text-xs sm:text-sm font-medium text-gray-700 text-center group-hover:text-slate-700">협회소개</span>
            </a>
        </div>
    </div>
</nav>
