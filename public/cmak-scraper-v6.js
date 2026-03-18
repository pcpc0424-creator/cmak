/**
 * CMAK v6 - new URL() 사용하지 않음 (구형 사이트 호환)
 * cmak.or.kr 콘솔에 붙여넣기
 */
(async function() {
    'use strict';

    var BASE = location.protocol + '//' + location.host;
    var DELAY = 1500;

    console.log('=== CMAK v6 시작 ===');
    console.log('Base: ' + BASE);

    function toFull(href) {
        if (!href) return '';
        href = href.replace(/^\s+|\s+$/g, '');
        if (href.indexOf('http://') === 0 || href.indexOf('https://') === 0) {
            return href;
        }
        if (href.indexOf('/') === 0) {
            return BASE + href;
        }
        return BASE + '/' + href;
    }

    var result = {
        extractedAt: new Date().toISOString(),
        mainPage: { images: [], tables: [], links: [] },
        pages: {}
    };

    // === 메인 페이지 데이터 ===

    // 이미지
    document.querySelectorAll('img').forEach(function(img) {
        var src = img.getAttribute('src') || img.getAttribute('data-src') || '';
        if (src) {
            result.mainPage.images.push({
                src: toFull(src), alt: img.getAttribute('alt') || '',
                width: img.naturalWidth || img.width || 0,
                height: img.naturalHeight || img.height || 0,
                parentClass: img.parentElement ? img.parentElement.className : ''
            });
        }
    });

    // 테이블
    document.querySelectorAll('table').forEach(function(tbl, idx) {
        var tData = { index: idx, id: tbl.id || '', className: tbl.className || '', headers: [], rows: [] };
        var trs = tbl.querySelectorAll('tr');
        for (var r = 0; r < trs.length && r <= 30; r++) {
            var rowArr = [];
            var cells = trs[r].querySelectorAll('th,td');
            for (var c = 0; c < cells.length; c++) {
                var cell = cells[c];
                var obj = { tag: cell.tagName.toLowerCase(), text: cell.textContent.trim().substring(0, 500) };
                var a = cell.querySelector('a');
                if (a) { obj.href = a.getAttribute('href') || ''; obj.onclick = a.getAttribute('onclick') || ''; }
                var im = cell.querySelector('img');
                if (im) obj.img = toFull(im.getAttribute('src') || '');
                rowArr.push(obj);
                if (r === 0 && cell.tagName === 'TH') tData.headers.push(cell.textContent.trim());
            }
            tData.rows.push(rowArr);
        }
        if (tData.rows.length > 0) result.mainPage.tables.push(tData);
    });

    // 전체 HTML
    result.mainPage.fullHTML = document.documentElement.outerHTML.substring(0, 500000);

    console.log('메인: 이미지 ' + result.mainPage.images.length + ', 테이블 ' + result.mainPage.tables.length);

    // === URL 수집 ===
    var urlMap = {};

    function addUrl(href, text) {
        if (!href) return;
        href = href.replace(/^\s+|\s+$/g, '');
        if (!href || href === '#' || href === '/') return;
        if (href.indexOf('javascript:') === 0 || href.indexOf('mailto:') === 0 || href.indexOf('tel:') === 0) return;
        if (/\.(jpg|jpeg|png|gif|pdf|zip|hwp|doc|xls|css|js|ico)(\?|$)/i.test(href)) return;
        if (href.indexOf('counter.gabia') !== -1 || href.indexOf('youtube.com') !== -1) return;

        var full = toFull(href);

        // cmak.or.kr 도메인만
        if (full.indexOf('cmak.or.kr') === -1) return;

        // path 추출
        var path = full.replace(/https?:\/\/[^\/]+/, '');
        if (!path || path === '/') return;

        if (!urlMap[path]) {
            urlMap[path] = { url: full, path: path, text: (text || '').substring(0, 100) || path };
        }
    }

    // a 태그
    document.querySelectorAll('a').forEach(function(a) {
        addUrl(a.getAttribute('href'), a.textContent.trim());
    });

    // onclick에서 URL 추출
    document.querySelectorAll('[onclick]').forEach(function(el) {
        var onclick = el.getAttribute('onclick') || '';
        var matches = onclick.match(/['"]([^'"]*?\.asp[^'"]*?)['"]/gi);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                addUrl(matches[i].replace(/['"]/g, ''), el.textContent.trim());
            }
        }
    });

    // 스크립트에서
    document.querySelectorAll('script:not([src])').forEach(function(s) {
        var code = s.textContent || '';
        var matches = code.match(/['"]([^'"]*?\.asp[^'"]*?)['"]/gi);
        if (matches) {
            for (var i = 0; i < matches.length; i++) {
                addUrl(matches[i].replace(/['"]/g, ''), '');
            }
        }
    });

    var pages = [];
    for (var key in urlMap) {
        if (urlMap.hasOwnProperty(key)) {
            pages.push(urlMap[key]);
        }
    }

    console.log('서브 페이지: ' + pages.length + '개');
    for (var p = 0; p < pages.length; p++) {
        console.log('  ' + pages[p].path + ' (' + pages[p].text + ')');
    }

    // === 서브 페이지 크롤링 ===
    console.log('\n크롤링 시작...');

    for (var i = 0; i < pages.length; i++) {
        var pg = pages[i];
        // http로 통일 (원본 사이트가 http 기반)
        var fetchUrl = pg.url.replace('https://', 'http://');
        // 같은 origin이면 상대경로 사용
        if (pg.path) fetchUrl = pg.path;

        console.log('(' + (i+1) + '/' + pages.length + ') ' + pg.path);

        try {
            var resp = await fetch(fetchUrl, { credentials: 'include' });

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
                var trs = tbl.querySelectorAll('tr');
                for (var r = 0; r < trs.length && r <= 30; r++) {
                    var rowArr = [];
                    var cells = trs[r].querySelectorAll('th,td');
                    for (var c = 0; c < cells.length; c++) {
                        var obj = { tag: cells[c].tagName.toLowerCase(), text: cells[c].textContent.trim().substring(0, 500) };
                        var a = cells[c].querySelector('a');
                        if (a) { obj.href = a.getAttribute('href') || ''; obj.onclick = a.getAttribute('onclick') || ''; }
                        rowArr.push(obj);
                        if (r === 0 && cells[c].tagName === 'TH') tData.headers.push(cells[c].textContent.trim());
                    }
                    tData.rows.push(rowArr);
                }
                if (tData.rows.length > 0) pageData.content.tables.push(tData);
            });

            // 이미지
            doc.querySelectorAll('img').forEach(function(img) {
                var src = img.getAttribute('src') || '';
                if (src && !/btn_|icon_|bullet|bg_|spacer/i.test(src)) {
                    pageData.content.images.push({ src: toFull(src), alt: img.getAttribute('alt') || '' });
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
    var okCount = 0; var failCount = 0;
    for (var k in result.pages) {
        if (result.pages[k].error) failCount++; else okCount++;
    }

    console.log('\n=== 결과 ===');
    console.log('메인: 이미지 ' + result.mainPage.images.length + ', 테이블 ' + result.mainPage.tables.length);
    console.log('서브: 성공 ' + okCount + ', 실패 ' + failCount);
    console.log('크기: ' + (jsonStr.length / 1024 / 1024).toFixed(2) + 'MB');

    try {
        var blob = new Blob([jsonStr], { type: 'application/json' });
        var blobUrl = window.webkitURL ? window.webkitURL.createObjectURL(blob) : '';
        if (!blobUrl) {
            // Blob URL 실패시 data URI 사용
            throw new Error('no blob url');
        }
        var a = document.createElement('a');
        a.href = blobUrl;
        a.download = 'cmak_data_v6.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        console.log('다운로드 완료!');
    } catch(e) {
        // data URI 방식
        try {
            var a2 = document.createElement('a');
            a2.href = 'data:application/json;charset=utf-8,' + encodeURIComponent(jsonStr);
            a2.download = 'cmak_data_v6.json';
            document.body.appendChild(a2);
            a2.click();
            document.body.removeChild(a2);
            console.log('다운로드 완료! (data URI)');
        } catch(e2) {
            console.log('다운로드 실패. copy(JSON.stringify(window.__cmakData)) 사용');
        }
    }

    window.__cmakData = result;
    console.log('window.__cmakData 에서 확인 가능');
})();
