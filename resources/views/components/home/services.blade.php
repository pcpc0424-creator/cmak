{{--
    Services Section - ICAK 스타일 참고
    주요 사업 소개 카드 (실용적 디자인)
--}}
@props(['services' => []])

<section role="region" aria-labelledby="services-heading" class="py-16 lg:py-20 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- 섹션 헤더 --}}
        <header class="text-center mb-12">
            <span class="inline-block px-4 py-1.5 bg-primary-100 text-primary-700 text-sm font-semibold rounded-full mb-4">
                주요 사업
            </span>
            <h2 id="services-heading" class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                협회 주요 사업
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                CM 전문가의 역량 강화와 건설산업 발전을 위한 다양한 서비스를 제공합니다
            </p>
        </header>

        {{-- 서비스 카드 그리드 --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            {{-- CM 능력평가 공시 --}}
            <article class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:border-primary-200 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-lg shadow-primary-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-primary-600 transition-colors">CM 능력평가 공시</h3>
                <p class="text-sm text-gray-600 mb-4 leading-relaxed">기업의 CM 수행능력을 객관적으로 평가하고 공시합니다.</p>
                <a href="/business/certification" class="inline-flex items-center text-sm font-semibold text-primary-600 group-hover:text-primary-700">
                    자세히 보기
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </article>

            {{-- 자격검정 --}}
            <article class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:border-purple-200 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-lg shadow-purple-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-purple-600 transition-colors">건설사업관리사 자격검정</h3>
                <p class="text-sm text-gray-600 mb-4 leading-relaxed">CM 전문가 양성을 위한 자격검정 시험을 주관합니다.</p>
                <a href="/business/inspection" class="inline-flex items-center text-sm font-semibold text-purple-600 group-hover:text-purple-700">
                    자세히 보기
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </article>

            {{-- CM 전문교육 --}}
            <article class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:border-cyan-200 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-lg shadow-cyan-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-cyan-600 transition-colors">CM 전문교육</h3>
                <p class="text-sm text-gray-600 mb-4 leading-relaxed">체계적인 교육 프로그램으로 CM 역량을 강화하세요.</p>
                <a href="/business/education" class="inline-flex items-center text-sm font-semibold text-cyan-600 group-hover:text-cyan-700">
                    자세히 보기
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </article>

            {{-- CM Herald --}}
            <article class="group bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300">
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-lg shadow-orange-500/20">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2 group-hover:text-orange-600 transition-colors">CM Herald</h3>
                <p class="text-sm text-gray-600 mb-4 leading-relaxed">월간 소식지로 최신 CM 동향과 정보를 전달합니다.</p>
                <a href="/business/herald" class="inline-flex items-center text-sm font-semibold text-orange-600 group-hover:text-orange-700">
                    자세히 보기
                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </article>
        </div>

        {{-- 추가 서비스 링크 --}}
        <div class="mt-10 text-center">
            <a href="/business" class="inline-flex items-center gap-2 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium transition-colors">
                전체 사업 보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
