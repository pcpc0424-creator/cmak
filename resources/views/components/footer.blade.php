{{-- ICAK 스타일 푸터 - 단일 회색 배경 #4e5761 --}}
<footer class="icak-footer">
    {{-- 상단: 정책 링크 + 패밀리사이트 --}}
    <div class="icak-footer-top">
        <div class="icak-footer-top-inner">
            <div class="icak-footer-links">
                @php $bp = '/cmak'; @endphp
                <a href="{{ $bp }}/privacy" class="privacy">개인정보처리방침</a>
                <a href="{{ $bp }}/intro/location">찾아오시는 길</a>
                <a href="{{ $bp }}/intro/organization">부서별 연락처 안내</a>
            </div>
            <div class="icak-footer-family">
                <select onchange="if(this.value) window.open(this.value)">
                    <option value="">FAMILY SITE</option>
                    <option value="https://www.molit.go.kr">국토교통부</option>
                    <option value="https://www.g2b.go.kr">나라장터</option>
                    <option value="https://www.pps.go.kr">조달청</option>
                    <option value="https://www.kict.re.kr">한국건설기술연구원</option>
                </select>
            </div>
        </div>
    </div>

    {{-- 하단: 로고 + 주소 + 저작권 --}}
    <div class="icak-footer-bottom">
        <div class="icak-footer-bottom-inner">
            <div class="icak-footer-logo">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white/20 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">CM</span>
                    </div>
                    <span class="text-white font-bold">한국CM협회</span>
                </div>
            </div>
            <div class="icak-footer-info">
                <p><strong>서울특별시 서초구 서초대로 398 플라티넘타워 7층 &nbsp; TEL : 02-585-4712~3</strong></p>
                <p class="copyright">Copyright &copy; 1996-{{ date('Y') }} 한국CM협회 Construction Management Association of Korea</p>
            </div>
        </div>
    </div>
</footer>
