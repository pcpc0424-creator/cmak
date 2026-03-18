/**
 * CMAK 데이터 추출 v5 - http/https 문제 해결 + 발견된 URL 전부 크롤링
 * cmak.or.kr 콘솔에 붙여넣기
 */
(async function() {
    'use strict';

    var DELAY = 1500;
    var BASE = 'https://www.cmak.or.kr';
    var BASE_HTTP = 'http://www.cmak.or.kr';

    console.log('=== CMAK v5 시작 ===');

    var result = {
        extractedAt: new Date().toISOString(),
        mainPage: { images: [], links: [], tables: [] },
        pages: {}
    };

    // 메인 페이지 이미지
    document.querySelectorAll('img').forEach(function(img) {
        var src = img.getAttribute('src') || img.getAttribute('data-src') || '';
        if (src) {
            try { src = new URL(src, BASE).href; } catch(e) {}
            result.mainPage.images.push({
                src: src, alt: img.getAttribute('alt') || '',
                width: img.naturalWidth || img.width || 0,
                height: img.naturalHeight || img.height || 0,
                parentClass: img.parentElement ? img.parentElement.className : ''
            });
        }
    });

    // 메인 페이지 테이블
    document.querySelectorAll('table').forEach(function(tbl, idx) {
        var tData = { index: idx, id: tbl.id || '', className: tbl.className || '', headers: [], rows: [] };
        tbl.querySelectorAll('tr').forEach(function(tr, ri) {
            if (ri > 30) return;
            var rowArr = [];
            tr.querySelectorAll('th,td').forEach(function(cell) {
                var c = { tag: cell.tagName.toLowerCase(), text: cell.textContent.trim().substring(0, 500) };
                var a = cell.querySelector('a');
                if (a) { c.href = a.getAttribute('href') || ''; c.onclick = a.getAttribute('onclick') || ''; }
                var img = cell.querySelector('img');
                if (img) { try { c.img = new URL(img.getAttribute('src') || '', BASE).href; } catch(e) {} }
                rowArr.push(c);
                if (ri === 0 && cell.tagName === 'TH') tData.headers.push(cell.textContent.trim());
            });
            tData.rows.push(rowArr);
        });
        if (tData.rows.length > 0) result.mainPage.tables.push(tData);
    });

    // 메인 페이지 전체 HTML
    result.mainPage.fullHTML = document.documentElement.outerHTML.substring(0, 500000);

    console.log('메인: 이미지 ' + result.mainPage.images.length + ', 테이블 ' + result.mainPage.tables.length);

    // === URL 수집 (http/https 모두 처리) ===
    var urlMap = {};

    function addUrl(href, text) {
        if (!href || href === '#' || href === '/') return;
        if (href.indexOf('javascript:') === 0 || href.indexOf('mailto:') === 0) return;
        if (/\.(jpg|jpeg|png|gif|pdf|zip|hwp|doc|xls|css|js|ico)(\?|$)/i.test(href)) return;
        if (href.indexOf('counter.gabia') !== -1) return;

        var full;
        try {
            // http → https 통일
            full = new URL(href, BASE).href;
            full = full.replace('http://www.cmak.or.kr', 'https://www.cmak.or.kr');
        } catch(e) { return; }

        if (full.indexOf(BASE) !== 0) return;
        if (full === BASE || full === BASE + '/') return;

        var path = full.replace(BASE, '');
        if (!urlMap[path]) {
            urlMap[path] = { url: full, path: path, text: (text || '').substring(0, 100) || path };
        }
    }

    // a 태그에서
    document.querySelectorAll('a').forEach(function(a) {
        addUrl(a.getAttribute('href'), a.textContent.trim());
    });

    // onclick에서
    document.querySelectorAll('[onclick]').forEach(function(el) {
        var onclick = el.getAttribute('onclick') || '';
        var matches = onclick.match(/['"]([^'"]*?\.asp[^'"]*?)['"]/gi);
        if (matches) matches.forEach(function(m) { addUrl(m.replace(/['"]/g, ''), el.textContent.trim()); });
    });

    // 스크립트에서
    document.querySelectorAll('script:not([src])').forEach(function(s) {
        var code = s.textContent || '';
        var matches = code.match(/['"]([^'"]*?\.asp[^'"]*?)['"]/gi);
        if (matches) matches.forEach(function(m) { addUrl(m.replace(/['"]/g, ''), ''); });
    });

    var pages = Object.values(urlMap);
    console.log('발견된 서브 페이지: ' + pages.length + '개');
    pages.forEach(function(p) { console.log('  ' + p.path + ' (' + p.text + ')'); });

    // === 서브 페이지 크롤링 ===
    console.log('\n크롤링 시작...');

    for (var i = 0; i < pages.length; i++) {
        var pg = pages[i];
        console.log('(' + (i+1) + '/' + pages.length + ') ' + pg.path);

        try {
            // 원본 사이트는 http일 수 있으므로 둘 다 시도
            var resp;
            try {
                resp = await fetch(pg.url, { credentials: 'include' });
            } catch(e) {
                // https 실패시 http 시도
                resp = await fetch(pg.url.replace('https://', 'http://'), { credentials: 'include' });
            }

            if (!resp.ok) {
                console.warn('  HTTP ' + resp.status);
                result.pages[pg.path] = { title: pg.text, error: 'HTTP ' + resp.status };
                continue;
            }

            var html = await resp.text();
            var doc = new DOMParser().parseFromString(html, 'text/html');

            var pageData = {
                title: pg.text,
                url: pg.url,
                pageTitle: doc.title || '',
                content: { headings: [], text: '', tables: [], images: [], links: [] }
            };

            // 텍스트
            var clone = doc.body.cloneNode(true);
            clone.querySelectorAll('script,style').forEach(function(el) { el.remove(); });
            pageData.content.text = clone.textContent.trim().replace(/\s+/g, ' ').substring(0, 15000);

            // 제목
            doc.querySelectorAll('h1,h2,h3,h4').forEach(function(h) {
                pageData.content.headings.push({ tag: h.tagName, text: h.textContent.trim() });
            });

            // 테이블
            doc.querySelectorAll('table').forEach(function(tbl) {
                var tData = { headers: [], rows: [] };
                tbl.querySelectorAll('tr').forEach(function(tr, ri) {
                    if (ri > 30) return;
                    var rowArr = [];
                    tr.querySelectorAll('th,td').forEach(function(cell) {
                        var c = { tag: cell.tagName.toLowerCase(), text: cell.textContent.trim().substring(0, 500) };
                        var a = cell.querySelector('a');
                        if (a) { c.href = a.getAttribute('href') || ''; c.onclick = a.getAttribute('onclick') || ''; }
                        rowArr.push(c);
                        if (ri === 0 && cell.tagName === 'TH') tData.headers.push(cell.textContent.trim());
                    });
                    tData.rows.push(rowArr);
                });
                if (tData.rows.length > 0) pageData.content.tables.push(tData);
            });

            // 이미지
            doc.querySelectorAll('img').forEach(function(img) {
                var src = img.getAttribute('src') || '';
                if (src && !/btn_|icon_|bullet|bg_|spacer/i.test(src)) {
                    try { src = new URL(src, BASE).href; } catch(e) {}
                    pageData.content.images.push({ src: src, alt: img.getAttribute('alt') || '' });
                }
            });

            // 링크
            doc.querySelectorAll('a').forEach(function(a) {
                var t = a.textContent.trim();
                if (t) {
                    pageData.content.links.push({
                        text: t.substring(0, 200),
                        href: a.getAttribute('href') || '',
                        onclick: a.getAttribute('onclick') || ''
                    });
                }
            });

            result.pages[pg.path] = pageData;
            console.log('  OK (테이블:' + pageData.content.tables.length + ' 이미지:' + pageData.content.images.length + ')');

        } catch (err) {
            console.error('  에러: ' + err.message);
            result.pages[pg.path] = { title: pg.text, error: err.message };
        }

        await new Promise(function(r) { setTimeout(r, DELAY); });
    }

    // === 다운로드 ===
    var jsonStr = JSON.stringify(result, null, 2);
    var ok = Object.values(result.pages).filter(function(p) { return !p.error; }).length;
    var fail = Object.values(result.pages).filter(function(p) { return p.error; }).length;

    console.log('\n=== 결과 ===');
    console.log('메인: 이미지 ' + result.mainPage.images.length + ', 테이블 ' + result.mainPage.tables.length);
    console.log('서브: 성공 ' + ok + ', 실패 ' + fail);
    console.log('크기: ' + (jsonStr.length / 1024 / 1024).toFixed(2) + 'MB');

    try {
        var blob = new Blob([jsonStr], { type: 'application/json' });
        var a = document.createElement('a');
        a.href = URL.createObjectURL(blob);
        a.download = 'cmak_data_v5.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        console.log('다운로드 완료!');
    } catch(e) {
        console.log('다운로드 실패 → copy(JSON.stringify(window.__cmakData))');
    }

    window.__cmakData = result;
    console.log('window.__cmakData 에서 확인 가능');
})();
