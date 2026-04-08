{{-- English Footer --}}
<footer class="eng-footer">
    <div class="eng-footer-top">
        <div class="eng-footer-top-inner">
            <div class="eng-footer-links">
                <a href="/cmak/eng/about/contact">Contact Us</a>
                <a href="/cmak/eng/about/organization">Organization</a>
                <a href="/cmak/eng/membership">Membership</a>
            </div>
            <div class="eng-footer-family">
                <select onchange="if(this.value) window.open(this.value)">
                    <option value="">RELATED SITES</option>
                    <option value="https://www.ipma.world/">IPMA</option>
                    <option value="https://www.cmaanet.org/">CMAA</option>
                    <option value="https://www.molit.go.kr/english/">MOLIT (Korea)</option>
                </select>
            </div>
        </div>
    </div>

    <div class="eng-footer-bottom">
        <div class="eng-footer-bottom-inner">
            <div class="eng-footer-logo">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-white/20 rounded flex items-center justify-center">
                        <span class="text-white font-bold text-sm">CM</span>
                    </div>
                    <span class="text-white font-bold">CMAK</span>
                </div>
            </div>
            <div class="eng-footer-info">
                <p><strong>7F, Platinum Tower, 398 Seocho-daero, Seocho-gu, Seoul, Republic of Korea &nbsp; TEL : +82-2-585-4712~3</strong></p>
                <p class="copyright">Copyright &copy; 1996-{{ date('Y') }} Construction Management Association of Korea. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
