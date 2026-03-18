/**
 * CMAK 데이터 추출 스크립트 v3
 *
 * 1단계: 현재 사이트의 모든 내부 링크를 자동 수집
 * 2단계: 각 페이지를 순회하며 데이터 추출
 * 3단계: 서버로 전송 + JSON 다운로드
 *
 * 사용법:
 * 1. https://www.cmak.or.kr/ 접속
 * 2. F12 → Console
 * 3. 이 스크립트 붙여넣기 → Enter
 */

(async function() {
    'use strict';

    var BASE = location.origin; // 현재 사이트 origin 자동 감지
    var DELAY = 1500;
    var UPLOAD_URL = 'http://115.68.216.152/cmak/cmak-upload.php';

    console.log('=== CMAK 데이터 추출 v3 시작 ===');
    console.log('Base URL: ' + BASE);

    // =============================================
    // 1단계: 현재 페이지에서 모든 내부 링크 수집
    // =============================================
    console.log('');
    console.log('[1단계] 메뉴 링크 수집 중...');

    var allLinks = document.querySelectorAll('a[href]');
    var urlMap = {};

    for (var i = 0; i < allLinks.length; i++) {
        var a = allLinks[i];
        var href = a.getAttribute('href') || '';
        var text = a.textContent.trim().replace(/\s+/g, ' ');

        // 필터링: 빈 링크, javascript, #, 외부 링크 제외
        if (!href || href === '#' || href.indexOf('javascript:') === 0) continue;
        if (href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) continue;

        // 상대 경로 → 절대 경로
        var fullUrl;
        try {
            fullUrl = new URL(href, BASE).href;
        } catch(e) {
            continue;
        }

        // 외부 링크 제외
        if (fullUrl.indexOf(BASE) !== 0) continue;

        // 이미지, 파일 다운로드 제외
        if (/\.(jpg|jpeg|png|gif|pdf|zip|hwp|doc|xls)(\?|$)/i.test(fullUrl)) continue;

        // 중복 제거 (같은 URL이면 텍스트가 긴 것 우선)
        var path = fullUrl.replace(BASE, '');
        if (!path || path === '/') continue;

        if (!urlMap[fullUrl] || text.length > (urlMap[fullUrl].text || '').length) {
            urlMap[fullUrl] = { url: fullUrl, path: path, text: text || path };
        }
    }

    var uniquePages = Object.values(urlMap);
    console.log('발견된 내부 링크: ' + uniquePages.length + '개');
    uniquePages.forEach(function(p) {
        console.log('  ' + p.text + ' → ' + p.path);
    });

    // =============================================
    // 2단계: 메인 페이지 데이터 추출
    // =============================================
    console.log('');
    console.log('[2단계] 메인 페이지 데이터 추출...');

    var result = {
        extractedAt: new Date().toISOString(),
        siteBase: BASE,
        mainPage: {},
        pages: {}
    };

    // --- 메인 페이지 분석 ---

    // 메인 배너/슬라이더 이미지
    var bannerImgs = [];
    var sliderSelectors = ['.slider img', '.slide img', '.swiper img', '.banner img', '.visual img', '.main_visual img', '#main_visual img', '.bx-wrapper img', '.bxslider img'];
    for (var si = 0; si < sliderSelectors.length; si++) {
        var found = document.querySelectorAll(sliderSelectors[si]);
        if (found.length > 0) {
            for (var fi = 0; fi < found.length; fi++) {
                var src = found[fi].getAttribute('src') || found[fi].getAttribute('data-src') || '';
                if (src) {
                    try { src = new URL(src, BASE).href; } catch(e) {}
                    bannerImgs.push({ src: src, alt: found[fi].getAttribute('alt') || '' });
                }
            }
            break;
        }
    }
    // 일반 큰 이미지도 배너일 수 있음
    if (bannerImgs.length === 0) {
        var allImgs = document.querySelectorAll('img');
        for (var ai = 0; ai < allImgs.length; ai++) {
            var img = allImgs[ai];
            if (img.naturalWidth > 600 || img.width > 600) {
                var imgSrc = img.getAttribute('src') || '';
                if (imgSrc) {
                    try { imgSrc = new URL(imgSrc, BASE).href; } catch(e) {}
                    bannerImgs.push({ src: imgSrc, alt: img.getAttribute('alt') || '' });
                }
            }
        }
    }
    result.mainPage.banners = bannerImgs;

    // 메인 네비게이션 메뉴 구조
    var navMenus = [];
    var navSelectors = ['nav', '#gnb', '.gnb', '#nav', '.nav', '.main_menu', '.top_menu', '#header_menu'];
    var navEl = null;
    for (var ni = 0; ni < navSelectors.length; ni++) {
        navEl = document.querySelector(navSelectors[ni]);
        if (navEl && navEl.querySelectorAll('a').length > 3) break;
        navEl = null;
    }
    if (navEl) {
        // 1depth 메뉴
        var topMenus = navEl.querySelectorAll(':scope > ul > li, :scope > li, :scope > div > ul > li');
        if (topMenus.length === 0) topMenus = navEl.querySelectorAll('li');

        var visited = new Set();
        topMenus.forEach(function(li) {
            var topA = li.querySelector(':scope > a');
            if (!topA) return;
            var menuText = topA.textContent.trim();
            if (!menuText || visited.has(menuText)) return;
            visited.add(menuText);

            var menuItem = { title: menuText, link: topA.getAttribute('href') || '', children: [] };

            // 2depth 서브메뉴
            var subLinks = li.querySelectorAll('ul a, .sub a, .depth2 a');
            subLinks.forEach(function(sa) {
                var subText = sa.textContent.trim();
                if (subText && subText !== menuText) {
                    menuItem.children.push({ title: subText, link: sa.getAttribute('href') || '' });
                }
            });

            navMenus.push(menuItem);
        });
    }
    result.mainPage.navigation = navMenus;

    // 메인 페이지 모든 텍스트 섹션
    var sections = [];
    var sectionEls = document.querySelectorAll('section, .section, [class*="main_"], [class*="home_"], [id*="main_"], [id*="section"]');
    sectionEls.forEach(function(sec) {
        var secData = {
            id: sec.id || '',
            className: sec.className || '',
            headings: [],
            texts: [],
            links: [],
            images: []
        };

        sec.querySelectorAll('h1,h2,h3,h4,h5').forEach(function(h) {
            secData.headings.push(h.textContent.trim());
        });

        sec.querySelectorAll('a').forEach(function(a) {
            var aText = a.textContent.trim();
            var aHref = a.getAttribute('href') || '';
            if (aText && aHref && aHref !== '#') {
                secData.links.push({ text: aText.substring(0, 200), href: aHref });
            }
        });

        sec.querySelectorAll('img').forEach(function(img) {
            var imgSrc = img.getAttribute('src') || '';
            if (imgSrc && imgSrc.indexOf('icon') === -1 && imgSrc.indexOf('btn') === -1) {
                try { imgSrc = new URL(imgSrc, BASE).href; } catch(e) {}
                secData.images.push({ src: imgSrc, alt: img.getAttribute('alt') || '' });
            }
        });

        // 주요 텍스트
        var clone = sec.cloneNode(true);
        clone.querySelectorAll('script,style,nav').forEach(function(el) { el.remove(); });
        var secText = clone.textContent.trim().replace(/\s+/g, ' ').substring(0, 3000);
        if (secText.length > 10) secData.texts.push(secText);

        if (secData.headings.length > 0 || secData.texts.length > 0 || secData.links.length > 0) {
            sections.push(secData);
        }
    });
    result.mainPage.sections = sections;

    // 게시판 형태 데이터 (테이블, 리스트)
    var boardData = [];
    var tables = document.querySelectorAll('table');
    tables.forEach(function(tbl) {
        var rows = tbl.querySelectorAll('tr');
        if (rows.length < 2) return;

        var tData = { headers: [], rows: [] };
        var ths = rows[0].querySelectorAll('th');
        ths.forEach(function(th) { tData.headers.push(th.textContent.trim()); });

        for (var r = 1; r < rows.length && r <= 20; r++) {
            var tds = rows[r].querySelectorAll('td');
            var rowObj = {};
            for (var c = 0; c < tds.length; c++) {
                var colName = tData.headers[c] || ('col' + c);
                rowObj[colName] = tds[c].textContent.trim().substring(0, 500);
                var link = tds[c].querySelector('a');
                if (link) {
                    rowObj[colName + '_link'] = link.getAttribute('href') || '';
                    rowObj[colName + '_onclick'] = link.getAttribute('onclick') || '';
                }
            }
            tData.rows.push(rowObj);
        }
        if (tData.rows.length > 0) boardData.push(tData);
    });

    // ul/li 리스트 형태 게시판
    var listSelectors = ['.board_list li', '.bbs_list li', '.notice_list li', '.news_list li', '[class*="list"] li'];
    listSelectors.forEach(function(sel) {
        var items = document.querySelectorAll(sel);
        if (items.length < 2) return;
        var listData = { type: 'list', selector: sel, items: [] };
        items.forEach(function(li) {
            var a = li.querySelector('a');
            var date = li.querySelector('.date, .time, span:last-child');
            listData.items.push({
                text: (a ? a.textContent.trim() : li.textContent.trim()).substring(0, 300),
                link: a ? (a.getAttribute('href') || '') : '',
                date: date ? date.textContent.trim() : ''
            });
        });
        if (listData.items.length > 0) boardData.push(listData);
    });

    result.mainPage.boards = boardData;

    console.log('메인 페이지: 배너 ' + bannerImgs.length + '개, 메뉴 ' + navMenus.length + '개, 섹션 ' + sections.length + '개, 게시판 ' + boardData.length + '개');

    // =============================================
    // 3단계: 서브 페이지 순회
    // =============================================
    console.log('');
    console.log('[3단계] 서브 페이지 ' + uniquePages.length + '개 크롤링...');

    var count = 0;
    for (var pi = 0; pi < uniquePages.length; pi++) {
        var pg = uniquePages[pi];
        count++;
        console.log('(' + count + '/' + uniquePages.length + ') ' + pg.text + ' → ' + pg.path);

        try {
            var resp = await fetch(pg.url, { credentials: 'include' });

            if (!resp.ok) {
                console.warn('  HTTP ' + resp.status);
                result.pages[pg.path] = { title: pg.text, url: pg.url, error: 'HTTP ' + resp.status };
                continue;
            }

            var html = await resp.text();
            var parser = new DOMParser();
            var doc = parser.parseFromString(html, 'text/html');

            var pageData = {
                title: pg.text,
                url: pg.url,
                path: pg.path,
                pageTitle: doc.title || '',
                sideMenu: [],
                content: {
                    type: 'unknown',
                    headings: [],
                    text: '',
                    tables: [],
                    images: [],
                    boardList: [],
                    links: []
                }
            };

            // 사이드 메뉴
            var sideSelectors = ['#snb', '.snb', '#lnb', '.lnb', '.sub_menu', '.leftMenu', '.left_menu', '.sub_nav', '.aside_menu', '.lnb_wrap'];
            var sideEl = null;
            for (var ss = 0; ss < sideSelectors.length; ss++) {
                sideEl = doc.querySelector(sideSelectors[ss]);
                if (sideEl) break;
            }
            if (sideEl) {
                sideEl.querySelectorAll('a').forEach(function(a) {
                    var h = a.getAttribute('href') || '';
                    if (h && h !== '#' && h.indexOf('javascript:') !== 0) {
                        pageData.sideMenu.push({ title: a.textContent.trim(), link: h });
                    }
                });
            }

            // 콘텐츠 영역
            var cSelectors = ['#container', '.container', '#content', '.content', '.sub_content', '.cont_area', '#sub_content', '.subContent', '#contents', '.contents', 'main', '.main_content'];
            var cEl = null;
            for (var cs = 0; cs < cSelectors.length; cs++) {
                cEl = doc.querySelector(cSelectors[cs]);
                if (cEl) break;
            }
            if (!cEl) cEl = doc.body;

            // 제목들
            cEl.querySelectorAll('h1,h2,h3,h4').forEach(function(h) {
                pageData.content.headings.push({ tag: h.tagName, text: h.textContent.trim() });
            });

            // 게시판 테이블 감지
            var pageTables = cEl.querySelectorAll('table');
            var boardTbl = null;
            for (var pt = 0; pt < pageTables.length; pt++) {
                var ptbl = pageTables[pt];
                if (ptbl.querySelectorAll('tr').length >= 3 && ptbl.querySelector('th')) {
                    boardTbl = ptbl;
                    break;
                }
            }

            if (boardTbl) {
                pageData.content.type = 'board';
                var bRows = boardTbl.querySelectorAll('tr');
                var bHeaders = [];
                var thEls2 = bRows[0].querySelectorAll('th');
                thEls2.forEach(function(th) { bHeaders.push(th.textContent.trim()); });

                for (var br = 1; br < bRows.length; br++) {
                    var tds = bRows[br].querySelectorAll('td');
                    if (tds.length < 2) continue;
                    var rowObj = {};
                    for (var bc = 0; bc < tds.length; bc++) {
                        var col = bHeaders[bc] || ('col' + bc);
                        rowObj[col] = tds[bc].textContent.trim();
                        var tdA = tds[bc].querySelector('a');
                        if (tdA) {
                            rowObj[col + '_link'] = tdA.getAttribute('href') || '';
                            if (tdA.getAttribute('onclick')) rowObj[col + '_onclick'] = tdA.getAttribute('onclick');
                        }
                    }
                    pageData.content.boardList.push(rowObj);
                }
            } else {
                pageData.content.type = 'article';
                var clone2 = cEl.cloneNode(true);
                clone2.querySelectorAll('script,style,nav,.snb,#snb,.lnb,#lnb,.gnb,#gnb').forEach(function(el) { el.remove(); });
                pageData.content.text = clone2.textContent.trim().replace(/\s+/g, ' ').substring(0, 15000);

                // 테이블 데이터
                pageTables.forEach(function(tbl) {
                    var tData = { rows: [] };
                    tbl.querySelectorAll('tr').forEach(function(tr) {
                        var cells = [];
                        tr.querySelectorAll('th,td').forEach(function(cell) {
                            cells.push({ type: cell.tagName.toLowerCase(), text: cell.textContent.trim().substring(0, 500) });
                        });
                        if (cells.length > 0) tData.rows.push(cells);
                    });
                    if (tData.rows.length > 0) pageData.content.tables.push(tData);
                });
            }

            // 이미지
            cEl.querySelectorAll('img').forEach(function(img) {
                var src = img.getAttribute('src') || '';
                if (src && !/btn_|icon_|bullet|bg_|spacer/i.test(src)) {
                    try { src = new URL(src, BASE).href; } catch(e) {}
                    pageData.content.images.push({ src: src, alt: img.getAttribute('alt') || '' });
                }
            });

            // 링크
            cEl.querySelectorAll('a').forEach(function(a) {
                var aHref = a.getAttribute('href') || '';
                var aText = a.textContent.trim();
                if (aHref && aHref !== '#' && aHref.indexOf('javascript:') !== 0 && aText) {
                    pageData.content.links.push({ text: aText.substring(0, 200), href: aHref });
                }
            });

            result.pages[pg.path] = pageData;
            console.log('  OK (' + pageData.content.type + ', 게시글: ' + pageData.content.boardList.length + ')');

        } catch (err) {
            console.error('  에러: ' + err.message);
            result.pages[pg.path] = { title: pg.text, url: pg.url, error: err.message };
        }

        await new Promise(function(r) { setTimeout(r, DELAY); });
    }

    // =============================================
    // 4단계: 결과 전송 + 다운로드
    // =============================================
    console.log('');
    console.log('[4단계] 데이터 저장...');

    var jsonStr = JSON.stringify(result, null, 2);
    var totalPages = Object.keys(result.pages).length;
    var errorPages = Object.values(result.pages).filter(function(p) { return p.error; }).length;

    console.log('총 ' + totalPages + '개 페이지 (성공: ' + (totalPages - errorPages) + ', 실패: ' + errorPages + ')');
    console.log('JSON 크기: ' + (jsonStr.length / 1024).toFixed(1) + 'KB');

    // 서버 전송
    try {
        var uploadResp = await fetch(UPLOAD_URL, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: jsonStr
        });
        if (uploadResp.ok) {
            var uploadResult = await uploadResp.json();
            console.log('서버 업로드 성공! ' + JSON.stringify(uploadResult));
        } else {
            console.log('서버 업로드 실패: HTTP ' + uploadResp.status);
        }
    } catch(e) {
        console.log('서버 전송 실패: ' + e.message);
    }

    // 파일 다운로드 (백업)
    try {
        var blob = new Blob([jsonStr], { type: 'application/json' });
        var url = URL.createObjectURL(blob);
        var downloadLink = document.createElement('a');
        downloadLink.href = url;
        downloadLink.download = 'cmak_data_v3.json';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
        URL.revokeObjectURL(url);
        console.log('파일 다운로드 완료: cmak_data_v3.json');
    } catch(e2) {
        console.log('다운로드 실패. 콘솔에서 copy() 사용:');
        console.log('copy(JSON.stringify(' + 'result' + '))');
    }

    // 전역에 저장 (디버깅용)
    window.__cmakData = result;
    console.log('');
    console.log('=== 완료! window.__cmakData 에서 확인 가능 ===');

})();
