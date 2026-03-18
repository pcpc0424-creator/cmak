/**
 * CMAK 데이터 추출 스크립트 v4
 *
 * 개선사항:
 * - onclick, javascript:, iframe 등에서도 URL 추출
 * - 메인 페이지의 전체 HTML 구조 분석
 * - Mixed Content 문제 해결 (다운로드만 사용)
 * - 기존 알려진 URL + 자동 발견 URL 병합
 *
 * 사용법: cmak.or.kr 콘솔에 붙여넣기
 */

(async function() {
    'use strict';

    var BASE = location.origin;
    var DELAY = 1500;

    console.log('=== CMAK 데이터 추출 v4 시작 ===');
    console.log('Base URL: ' + BASE);

    var result = {
        extractedAt: new Date().toISOString(),
        siteBase: BASE,
        mainPage: {},
        pages: {}
    };

    // =============================================
    // 1단계: 메인 페이지 완전 분석
    // =============================================
    console.log('\n[1단계] 메인 페이지 완전 분석...');

    // 전체 HTML 소스 저장
    result.mainPage.fullHTML = document.documentElement.outerHTML;

    // 모든 이미지
    var allImgs = [];
    document.querySelectorAll('img').forEach(function(img) {
        var src = img.getAttribute('src') || img.getAttribute('data-src') || '';
        if (src) {
            try { src = new URL(src, BASE).href; } catch(e) {}
            allImgs.push({
                src: src,
                alt: img.getAttribute('alt') || '',
                width: img.naturalWidth || img.width || 0,
                height: img.naturalHeight || img.height || 0,
                parentTag: img.parentElement ? img.parentElement.tagName : '',
                parentClass: img.parentElement ? img.parentElement.className : ''
            });
        }
    });
    result.mainPage.images = allImgs;
    console.log('  이미지: ' + allImgs.length + '개');

    // 모든 링크 (href + onclick + javascript: 전부)
    var allLinks = [];
    document.querySelectorAll('a').forEach(function(a) {
        var href = a.getAttribute('href') || '';
        var onclick = a.getAttribute('onclick') || '';
        var text = a.textContent.trim().replace(/\s+/g, ' ');
        var target = a.getAttribute('target') || '';

        allLinks.push({
            text: text.substring(0, 200),
            href: href,
            onclick: onclick,
            target: target,
            parentId: a.closest('[id]') ? a.closest('[id]').id : '',
            parentClass: a.parentElement ? a.parentElement.className : ''
        });
    });
    result.mainPage.links = allLinks;
    console.log('  링크(a태그): ' + allLinks.length + '개');

    // 모든 테이블 데이터
    var allTables = [];
    document.querySelectorAll('table').forEach(function(tbl, idx) {
        var tData = {
            index: idx,
            id: tbl.id || '',
            className: tbl.className || '',
            parentId: tbl.closest('[id]') ? tbl.closest('[id]').id : '',
            headers: [],
            rows: []
        };

        var rows = tbl.querySelectorAll('tr');
        for (var r = 0; r < rows.length && r <= 30; r++) {
            var cells = rows[r].querySelectorAll('th, td');
            var rowData = [];
            for (var c = 0; c < cells.length; c++) {
                var cell = cells[c];
                var cellData = {
                    tag: cell.tagName.toLowerCase(),
                    text: cell.textContent.trim().substring(0, 500),
                    colspan: cell.getAttribute('colspan') || '',
                    rowspan: cell.getAttribute('rowspan') || ''
                };

                // 셀 안의 링크
                var cellLink = cell.querySelector('a');
                if (cellLink) {
                    cellData.linkHref = cellLink.getAttribute('href') || '';
                    cellData.linkOnclick = cellLink.getAttribute('onclick') || '';
                }

                // 셀 안의 이미지
                var cellImg = cell.querySelector('img');
                if (cellImg) {
                    var cSrc = cellImg.getAttribute('src') || '';
                    try { cSrc = new URL(cSrc, BASE).href; } catch(e) {}
                    cellData.imgSrc = cSrc;
                }

                rowData.push(cellData);

                if (r === 0 && cell.tagName === 'TH') {
                    tData.headers.push(cell.textContent.trim());
                }
            }
            tData.rows.push(rowData);
        }
        allTables.push(tData);
    });
    result.mainPage.tables = allTables;
    console.log('  테이블: ' + allTables.length + '개');

    // iframe 내용
    var iframes = [];
    document.querySelectorAll('iframe').forEach(function(iframe) {
        var iframeSrc = iframe.getAttribute('src') || '';
        try { iframeSrc = new URL(iframeSrc, BASE).href; } catch(e) {}
        var iframeData = {
            src: iframeSrc,
            id: iframe.id || '',
            name: iframe.name || '',
            width: iframe.width || '',
            height: iframe.height || ''
        };

        // 같은 origin이면 내부 내용도 추출
        try {
            var iDoc = iframe.contentDocument || iframe.contentWindow.document;
            if (iDoc) {
                iframeData.html = iDoc.documentElement.outerHTML.substring(0, 50000);
                iframeData.text = iDoc.body ? iDoc.body.textContent.trim().replace(/\s+/g, ' ').substring(0, 10000) : '';

                // iframe 내 링크
                iframeData.links = [];
                iDoc.querySelectorAll('a').forEach(function(a) {
                    iframeData.links.push({
                        text: a.textContent.trim().substring(0, 200),
                        href: a.getAttribute('href') || '',
                        onclick: a.getAttribute('onclick') || ''
                    });
                });
            }
        } catch(e) {
            iframeData.crossOrigin = true;
        }

        iframes.push(iframeData);
    });
    result.mainPage.iframes = iframes;
    console.log('  iframe: ' + iframes.length + '개');

    // 인라인 스크립트에서 URL 패턴 추출
    var scriptUrls = [];
    document.querySelectorAll('script:not([src])').forEach(function(script) {
        var code = script.textContent || '';
        // .asp, .php, /html/ 경로 찾기
        var urlPattern = /['"]([^'"]*?\.(?:asp|php|html?|jsp)[^'"]*?)['"]/gi;
        var match;
        while ((match = urlPattern.exec(code)) !== null) {
            scriptUrls.push(match[1]);
        }
        // location.href 패턴
        var locPattern = /location\.href\s*=\s*['"]([^'"]+)['"]/gi;
        while ((match = locPattern.exec(code)) !== null) {
            scriptUrls.push(match[1]);
        }
    });
    // onclick 속성에서도 URL 추출
    document.querySelectorAll('[onclick]').forEach(function(el) {
        var onclick = el.getAttribute('onclick') || '';
        var urlPattern = /['"]([^'"]*?(?:\.asp|\.php|\/html\/|\/board\/)[^'"]*?)['"]/gi;
        var match;
        while ((match = urlPattern.exec(onclick)) !== null) {
            scriptUrls.push(match[1]);
        }
        var locPattern = /location\.href\s*=\s*['"]([^'"]+)['"]/gi;
        while ((match = locPattern.exec(onclick)) !== null) {
            scriptUrls.push(match[1]);
        }
    });
    result.mainPage.scriptUrls = [...new Set(scriptUrls)];
    console.log('  스크립트 내 URL: ' + result.mainPage.scriptUrls.length + '개');

    // =============================================
    // 2단계: 발견된 URL로 서브 페이지 크롤링
    // =============================================

    // URL 수집: href, onclick, script 등에서 모두 모음
    var urlMap = {};

    // a 태그 href
    allLinks.forEach(function(link) {
        var href = link.href;
        if (href && href !== '#' && href.indexOf('javascript:') !== 0 && href.indexOf('mailto:') !== 0) {
            try {
                var full = new URL(href, BASE).href;
                if (full.indexOf(BASE) === 0 && full !== BASE + '/') {
                    var path = full.replace(BASE, '');
                    if (!/\.(jpg|jpeg|png|gif|pdf|zip|hwp|doc|xls|css|js)(\?|$)/i.test(path)) {
                        urlMap[full] = { url: full, path: path, text: link.text || path };
                    }
                }
            } catch(e) {}
        }

        // onclick에서 URL 추출
        if (link.onclick) {
            var onclickUrls = link.onclick.match(/['"]([^'"]*?(?:\.asp|\.php|\/html\/)[^'"]*?)['"]/gi);
            if (onclickUrls) {
                onclickUrls.forEach(function(u) {
                    u = u.replace(/['"]/g, '');
                    try {
                        var full = new URL(u, BASE).href;
                        if (full.indexOf(BASE) === 0) {
                            urlMap[full] = { url: full, path: full.replace(BASE, ''), text: link.text || u };
                        }
                    } catch(e) {}
                });
            }
        }
    });

    // 스크립트/onclick에서 발견된 URL
    result.mainPage.scriptUrls.forEach(function(u) {
        try {
            var full = new URL(u, BASE).href;
            if (full.indexOf(BASE) === 0) {
                urlMap[full] = { url: full, path: full.replace(BASE, ''), text: u };
            }
        } catch(e) {}
    });

    // iframe 내 링크
    iframes.forEach(function(iframe) {
        if (iframe.links) {
            iframe.links.forEach(function(link) {
                var href = link.href;
                if (href && href !== '#' && href.indexOf('javascript:') !== 0) {
                    try {
                        var full = new URL(href, BASE).href;
                        if (full.indexOf(BASE) === 0) {
                            urlMap[full] = { url: full, path: full.replace(BASE, ''), text: link.text || href };
                        }
                    } catch(e) {}
                }
            });
        }
    });

    var uniquePages = Object.values(urlMap);
    console.log('\n[2단계] 발견된 서브 페이지: ' + uniquePages.length + '개');
    uniquePages.forEach(function(p) {
        console.log('  ' + p.text.substring(0, 30) + ' → ' + p.path);
    });

    if (uniquePages.length > 0) {
        console.log('\n[3단계] 서브 페이지 크롤링...');

        for (var pi = 0; pi < uniquePages.length; pi++) {
            var pg = uniquePages[pi];
            console.log('(' + (pi+1) + '/' + uniquePages.length + ') ' + pg.text.substring(0,30) + ' → ' + pg.path);

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
                    html: html.substring(0, 100000),
                    content: {
                        headings: [],
                        text: '',
                        tables: [],
                        images: [],
                        links: []
                    }
                };

                // body에서 텍스트
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
                    var rows = tbl.querySelectorAll('tr');
                    for (var r = 0; r < rows.length && r <= 30; r++) {
                        var cells = rows[r].querySelectorAll('th,td');
                        var rowArr = [];
                        for (var c = 0; c < cells.length; c++) {
                            var cellObj = {
                                tag: cells[c].tagName.toLowerCase(),
                                text: cells[c].textContent.trim().substring(0, 500)
                            };
                            var cellA = cells[c].querySelector('a');
                            if (cellA) {
                                cellObj.href = cellA.getAttribute('href') || '';
                                cellObj.onclick = cellA.getAttribute('onclick') || '';
                            }
                            rowArr.push(cellObj);
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
                        try { src = new URL(src, BASE).href; } catch(e) {}
                        pageData.content.images.push({ src: src, alt: img.getAttribute('alt') || '' });
                    }
                });

                // 링크
                doc.querySelectorAll('a').forEach(function(a) {
                    var aText = a.textContent.trim();
                    var aHref = a.getAttribute('href') || '';
                    var aClick = a.getAttribute('onclick') || '';
                    if (aText) {
                        pageData.content.links.push({
                            text: aText.substring(0, 200),
                            href: aHref,
                            onclick: aClick
                        });
                    }
                });

                result.pages[pg.path] = pageData;
                console.log('  OK (테이블: ' + pageData.content.tables.length + ', 이미지: ' + pageData.content.images.length + ')');

            } catch (err) {
                console.error('  에러: ' + err.message);
                result.pages[pg.path] = { title: pg.text, url: pg.url, error: err.message };
            }

            await new Promise(function(r) { setTimeout(r, DELAY); });
        }
    }

    // =============================================
    // 최종: JSON 다운로드
    // =============================================
    console.log('\n[최종] 데이터 저장...');

    // fullHTML은 너무 크면 제거
    if (result.mainPage.fullHTML && result.mainPage.fullHTML.length > 500000) {
        result.mainPage.fullHTML = result.mainPage.fullHTML.substring(0, 500000) + '... (truncated)';
    }

    var jsonStr = JSON.stringify(result, null, 2);
    var totalPages = Object.keys(result.pages).length;
    var errorPages = Object.values(result.pages).filter(function(p) { return p.error; }).length;

    console.log('메인 페이지: 이미지 ' + allImgs.length + '개, 링크 ' + allLinks.length + '개, 테이블 ' + allTables.length + '개');
    console.log('서브 페이지: ' + totalPages + '개 (성공: ' + (totalPages - errorPages) + ', 실패: ' + errorPages + ')');
    console.log('JSON 크기: ' + (jsonStr.length / 1024 / 1024).toFixed(2) + 'MB');

    // Blob 다운로드
    try {
        var blob = new Blob([jsonStr], { type: 'application/json' });
        var url = URL.createObjectURL(blob);
        var a = document.createElement('a');
        a.href = url;
        a.download = 'cmak_data_v4.json';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        console.log('다운로드 완료: cmak_data_v4.json');
    } catch(e) {
        console.log('Blob 다운로드 실패, copy() 사용:');
        console.log('  copy(JSON.stringify(window.__cmakData))');
    }

    window.__cmakData = result;
    console.log('\n=== 완료! ===');
    console.log('window.__cmakData 에서 확인 가능');
    console.log('다운로드 안 됐으면: copy(JSON.stringify(window.__cmakData))');

})();
