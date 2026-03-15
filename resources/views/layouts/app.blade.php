<!DOCTYPE html>
<html lang="ko" class="fp-enabled">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="한국CM협회 - 건설사업관리 전문가 협회">
    <title>@yield('title', '한국CM협회 - CMAK')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard/dist/web/static/pretendard.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans antialiased bg-white text-gray-900">
    @include('components.header')

    <main id="fullpage" class="fullpage-wrapper">
        @yield('content')
    </main>

    {{-- 우측 점 네비게이션 --}}
    <nav id="fp-nav">
        <ul></ul>
    </nav>

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // === 요소 참조 ===
        var header = document.getElementById('mainHeader');
        var topPop = document.getElementById('topPop');
        var topPopBtn = document.getElementById('topPopBtn');
        var topPopBtnSpan = document.getElementById('topPopBtnSpan');
        var wrapper = document.getElementById('fullpage');
        var sections = wrapper ? wrapper.querySelectorAll('.fp-section') : [];
        var fpNav = document.querySelector('#fp-nav ul');
        var subWraps = document.querySelectorAll('.icak-sub-wrap');

        // === 새로고침 시 항상 섹션1부터 ===
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual';
        }
        window.scrollTo(0, 0);
        if (wrapper) {
            wrapper.style.transition = 'none';
            wrapper.style.transform = 'translate3d(0, 0, 0)';
            // fp-section-inner 스크롤도 리셋
            var inners = wrapper.querySelectorAll('.fp-section-inner');
            inners.forEach(function(el) { el.scrollTop = 0; });
            setTimeout(function() { wrapper.style.transition = 'transform 0.7s ease'; }, 100);
        }

        // === 상태 ===
        var popupOpen = true;
        var userClosedPopup = false;
        var currentSection = 0;
        var isAnimating = false;
        var totalSections = sections.length;
        var POPUP_HEIGHT = 120;
        var HEADER_HEIGHT = 125;

        // === 헤더/팝업 위치 업데이트 ===
        function updatePositions() {
            var headerTop = popupOpen ? POPUP_HEIGHT : 0;

            if (header) {
                header.style.top = headerTop + 'px';
                header.style.transition = 'top 0.3s, background-color 0.3s';

                // 섹션2에서는 헤더 항상 흰색
                if (currentSection > 0) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }

            // 드롭다운 위치
            var subTop = headerTop + HEADER_HEIGHT;
            subWraps.forEach(function(sw) {
                sw.style.top = subTop + 'px';
            });
        }

        // === 팝업 토글 ===
        function closePopup() {
            if (!popupOpen) return;
            popupOpen = false;
            topPop.classList.add('active');
            if (topPopBtnSpan) topPopBtnSpan.classList.add('active');
            updatePositions();
        }

        function openPopup() {
            if (popupOpen) return;
            popupOpen = true;
            topPop.classList.remove('active');
            if (topPopBtnSpan) topPopBtnSpan.classList.remove('active');
            updatePositions();
        }

        function togglePopup() {
            if (popupOpen) closePopup();
            else openPopup();
        }

        if (topPopBtn) {
            topPopBtn.addEventListener('click', function() {
                userClosedPopup = !userClosedPopup;
                togglePopup();
            });
        }

        // === 전체메뉴 토글 ===
        var mainMenu = document.getElementById('mainMenu');
        var mainMenuBtn = document.querySelector('.icak-btn-mainmenu a');
        if (mainMenuBtn && mainMenu) {
            mainMenuBtn.addEventListener('click', function(e) {
                e.preventDefault();
                mainMenu.classList.toggle('active');
            });
            // 배경 클릭으로 닫기
            mainMenu.addEventListener('click', function(e) {
                if (e.target === mainMenu) {
                    mainMenu.classList.remove('active');
                }
            });
            // ESC로 닫기
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && mainMenu.classList.contains('active')) {
                    mainMenu.classList.remove('active');
                }
            });
        }

        // === 점 네비게이션 생성 ===
        if (fpNav && totalSections > 0) {
            for (var i = 0; i < totalSections; i++) {
                var li = document.createElement('li');
                var a = document.createElement('a');
                var span = document.createElement('span');
                a.href = '#';
                a.dataset.index = i;
                if (i === 0) a.classList.add('active');
                a.appendChild(span);
                li.appendChild(a);
                fpNav.appendChild(li);

                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    goToSection(parseInt(this.dataset.index));
                });
            }
        }

        // === 섹션 전환 ===
        function goToSection(index) {
            if (isAnimating || index === currentSection || index < 0 || index >= totalSections) return;
            isAnimating = true;
            currentSection = index;

            wrapper.style.transform = 'translate3d(0, -' + (index * 100) + 'vh, 0)';

            // 점 네비게이션 업데이트
            var navLinks = fpNav.querySelectorAll('a');
            navLinks.forEach(function(link) { link.classList.remove('active'); });
            if (navLinks[index]) navLinks[index].classList.add('active');

            // 섹션2로 갈 때: 팝업 자동 닫기
            if (index > 0) {
                closePopup();
            }

            // 섹션1로 돌아올 때: 사용자가 직접 닫지 않았으면 다시 열기
            if (index === 0 && !userClosedPopup) {
                openPopup();
            }

            updatePositions();

            setTimeout(function() { isAnimating = false; }, 700);
        }

        // === 마우스 휠 ===
        document.addEventListener('wheel', function(e) {
            if (isAnimating) return;

            // 섹션2: 내부 스크롤
            if (currentSection === 1) {
                var inner = sections[1].querySelector('.fp-section-inner');
                if (inner) {
                    var atTop = inner.scrollTop <= 0;
                    if (e.deltaY < 0 && atTop) {
                        e.preventDefault();
                        goToSection(0);
                        return;
                    }
                    return; // 내부 스크롤 허용
                }
            }

            // 섹션1: 섹션 전환
            e.preventDefault();
            if (e.deltaY > 0) goToSection(currentSection + 1);
            else if (e.deltaY < 0) goToSection(currentSection - 1);
        }, { passive: false });

        // === 터치 (모바일) ===
        var touchStartY = 0;
        document.addEventListener('touchstart', function(e) {
            touchStartY = e.touches[0].clientY;
        }, { passive: true });
        document.addEventListener('touchend', function(e) {
            var diff = touchStartY - e.changedTouches[0].clientY;
            if (Math.abs(diff) > 50) {
                if (diff > 0) goToSection(currentSection + 1);
                else goToSection(currentSection - 1);
            }
        }, { passive: true });

        // === 키보드 ===
        document.addEventListener('keydown', function(e) {
            if (e.key === 'ArrowDown' || e.key === 'PageDown') {
                e.preventDefault(); goToSection(currentSection + 1);
            } else if (e.key === 'ArrowUp' || e.key === 'PageUp') {
                e.preventDefault(); goToSection(currentSection - 1);
            }
        });

        // === 초기화 ===
        updatePositions();
    });
    </script>
</body>
</html>
