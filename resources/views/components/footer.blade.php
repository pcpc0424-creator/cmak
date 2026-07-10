{{-- ICAK 스타일 푸터 - 단일 회색 배경 #4e5761 --}}
<footer class="icak-footer">
    {{-- 상단: 정책 링크 + 패밀리사이트 --}}
    <div class="icak-footer-top">
        <div class="icak-footer-top-inner">
            <div class="icak-footer-links">
                @php $bp = '/cmak'; @endphp
                <a href="{{ $bp }}/privacy" class="privacy">개인정보처리방침</a>
                <a href="{{ $bp }}/intro/location">찾아오시는 길</a>
                <a href="{{ $bp }}/intro/departments">부서별 연락처 안내</a>
            </div>
        </div>
    </div>

    {{-- 하단: 로고 + 주소 + 저작권 --}}
    <div class="icak-footer-bottom">
        <div class="icak-footer-bottom-inner">
            <div class="icak-footer-logo">
                <img src="/cmak/images/emblem_dark.png" alt="한국CM협회 CMAK" style="height:45px; width:auto;">
            </div>
            <div class="icak-footer-info">
                <p><strong>(06673) 서울특별시 서초구 서초대로88 (방배동 938-7, 유니온빌딩 4층) &nbsp; TEL : 02-585-4712~4 &nbsp; FAX : 02-585-2689</strong></p>
                <p class="copyright">Copyright &copy; 1996-{{ date('Y') }} 한국CM협회 Construction Management Association of Korea</p>
            </div>
        </div>
    </div>
</footer>
