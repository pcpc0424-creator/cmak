{{--
    Footer Component
    사이트 푸터: 연락처, 링크, 저작권 정보

    접근성:
    - 시맨틱 footer 요소
    - 연락처 정보에 적절한 마크업
    - 링크 목록에 nav 및 aria-label 적용
--}}
<footer class="bg-slate-800 text-gray-300" role="contentinfo">
    <!-- Main Footer -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
            <!-- Logo & Contact Info -->
            <div class="lg:col-span-2">
                <a href="/" class="inline-flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-primary-600 rounded-lg flex items-center justify-center" aria-hidden="true">
                        <span class="text-white font-bold">CM</span>
                    </div>
                    <div>
                        <span class="block text-white font-bold text-lg">한국CM협회</span>
                        <span class="block text-xs text-gray-500">CMAK</span>
                    </div>
                </a>

                <p class="text-sm leading-relaxed mb-6 max-w-md text-gray-400">
                    1996년 설립 이래 대한민국 건설사업관리 분야의 발전과 전문 인력 양성을 위해 노력하고 있습니다.
                </p>

                <address class="not-italic space-y-2 text-sm">
                    <p class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>서울특별시 서초구 서초대로 398 플라티넘타워 7층</span>
                    </p>
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <a href="tel:02-585-4712" class="hover:text-white transition-colors">02-585-4712~3</a>
                    </p>
                    <p class="flex items-center gap-3">
                        <svg class="w-5 h-5 text-gray-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <a href="mailto:cm@cmak.or.kr" class="hover:text-white transition-colors">cm@cmak.or.kr</a>
                    </p>
                </address>
            </div>

            <!-- Quick Links -->
            <nav aria-label="빠른 링크">
                <h2 class="text-white font-semibold mb-4">바로가기</h2>
                <ul class="space-y-2 text-sm">
                    <li><a href="/business/certification" class="hover:text-white transition-colors">CM 능력평가 공시</a></li>
                    <li><a href="/business/inspection" class="hover:text-white transition-colors">자격검정</a></li>
                    <li><a href="/business/education" class="hover:text-white transition-colors">CM 전문교육</a></li>
                    <li><a href="/business/herald" class="hover:text-white transition-colors">CM Herald</a></li>
                    <li><a href="/cmdata/about" class="hover:text-white transition-colors">CM이란</a></li>
                </ul>
            </nav>

            <!-- Support & Social -->
            <div>
                <nav aria-label="고객지원">
                    <h2 class="text-white font-semibold mb-4">고객지원</h2>
                    <ul class="space-y-2 text-sm">
                        <li><a href="/community/faq" class="hover:text-white transition-colors">자주 묻는 질문</a></li>
                        <li><a href="/notice" class="hover:text-white transition-colors">공지사항</a></li>
                        <li><a href="/intro/location" class="hover:text-white transition-colors">오시는 길</a></li>
                        <li><a href="/community/board" class="hover:text-white transition-colors">자유게시판</a></li>
                    </ul>
                </nav>

                <!-- Social Links -->
                <div class="mt-6">
                    <h2 class="text-white font-semibold mb-3">소셜 미디어</h2>
                    <div class="flex gap-3">
                        <a
                            href="https://www.youtube.com/channel/UCcVZEpnpnFrPzG73IvT_48Q"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="w-10 h-10 bg-slate-700 hover:bg-slate-600 rounded-lg flex items-center justify-center transition-colors"
                            aria-label="YouTube 채널 (새 창에서 열림)"
                        >
                            <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">
                    &copy; {{ date('Y') }} 한국CM협회(CMAK). All rights reserved.
                </p>
                <nav class="flex items-center gap-6 text-sm" aria-label="법적 정보">
                    <a href="/privacy" class="text-gray-500 hover:text-white transition-colors">개인정보처리방침</a>
                    <a href="/terms" class="text-gray-500 hover:text-white transition-colors">이용약관</a>
                    <a href="/intro/location" class="text-gray-500 hover:text-white transition-colors">찾아오시는 길</a>
                </nav>
            </div>
        </div>
    </div>
</footer>
