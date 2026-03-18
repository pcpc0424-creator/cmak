/**
 * CMAK 원본 사이트 데이터 추출 스크립트 v2
 *
 * 사용법:
 * 1. https://www.cmak.or.kr/ 접속
 * 2. F12 → Console 탭 열기
 * 3. 이 스크립트 전체를 복사하여 콘솔에 붙여넣기
 * 4. Enter → 자동 실행
 * 5. 완료 후 cmak_data.json 파일이 자동 다운로드됨
 */

(async function() {
    'use strict';

    var BASE = 'https://www.cmak.or.kr';
    var DELAY = 2000;

    var result = {
        extractedAt: new Date().toISOString(),
        pages: {}
    };

    // 원본 사이트에서 보이는 실제 메뉴 URL 목록
    var pages = [
        // 협회업무
        { id: 'join', title: '회원가입', url: '/html/business/member.asp' },
        { id: 'eval', title: 'CM적격성자문평가발전위원회', url: '/html/business/bm1.asp' },
        { id: 'confirm', title: '온라인CM실적확인서', url: '/html/business/bm2.asp' },
        { id: 'inspect', title: '건설사업관리사자격검정', url: '/html/business/bm3.asp' },
        { id: 'edu', title: 'CM전문교육및필수교육과정', url: '/html/business/bm4.asp' },
        { id: 'herald', title: 'CM HERALD', url: '/html/business/bm5.asp' },
        { id: 'consma', title: 'CONSMA', url: '/html/business/bm6.asp' },
        { id: 'bmintro', title: '협회사업소개', url: '/html/business/bmintro.asp' },

        // CM자료방
        { id: 'cmintro', title: 'CM이란', url: '/html/cmdata/cmintro.asp' },
        { id: 'cmlaw', title: '법령정보제도', url: '/html/cmdata/cmlaw.asp' },
        { id: 'cmreport', title: '논문/발표/연구보고서', url: '/html/cmdata/cmreport.asp' },
        { id: 'cmcase', title: '수행사례', url: '/html/cmdata/cmcase.asp' },
        { id: 'bookreview', title: 'BookReview', url: '/html/free/bookreview.asp' },
        { id: 'wordbook', title: 'WordBook', url: '/html/free/wordbook.asp' },
        { id: 'cmcolumn', title: '전문가칼럼', url: '/html/cmdata/cmcolumn.asp' },
        { id: 'cmguide', title: 'CM업무가이드북', url: '/html/cmdata/cmguide.asp' },

        // 알림마당
        { id: 'news', title: '국내소식', url: '/html/notice/news.asp' },
        { id: 'bids', title: '입찰소식', url: '/html/notice/ntrnder.asp' },
        { id: 'abroad', title: '해외소식', url: '/html/notice/abroad.asp' },
        { id: 'member_trend', title: '회원동향', url: '/html/notice/memberNews.asp' },
        { id: 'faq', title: 'FAQ', url: '/html/notice/faq.asp' },

        // 참여마당
        { id: 'notice', title: '공지사항', url: '/html/notice/nleague1.asp?code=1' },
        { id: 'press', title: '보도자료', url: '/html/notice/nleague1.asp?code=6' },
        { id: 'gallery', title: '갤러리', url: '/html/notice/nleague1.asp?code=5' },

        // 협회소개
        { id: 'intro', title: '협회장인사말', url: '/html/intro/intro.asp' },
        { id: 'intro2', title: '협회안내', url: '/html/intro/intro2.asp' },
        { id: 'intro3', title: '연혁', url: '/html/intro/intro3.asp' },
        { id: 'intro4', title: '조직도', url: '/html/intro/intro4.asp' },
        { id: 'intro5', title: '찾아오시는길', url: '/html/intro/intro5.asp' },
        { id: 'members', title: '회원현황', url: '/html/intro/member.asp' },

        // 관련사이트
        { id: 'related', title: '국내외기관', url: '/html/intro/site.asp' },
    ];

    console.log('=== CMAK 데이터 추출 시작 ===');
    console.log('총 ' + pages.length + '개 페이지 수집 예정');

    var count = 0;

    for (var i = 0; i < pages.length; i++) {
        var page = pages[i];
        count++;
        console.log('(' + count + '/' + pages.length + ') ' + page.title + ' ...');

        try {
            var resp = await fetch(BASE + page.url, {
                credentials: 'include'
            });

            if (!resp.ok) {
                console.warn('  HTTP ' + resp.status);
                result.pages[page.id] = { title: page.title, error: 'HTTP ' + resp.status };
                continue;
            }

            var html = await resp.text();
            var parser = new DOMParser();
            var doc = parser.parseFromString(html, 'text/html');

            var pageData = {
                title: page.title,
                sourceUrl: BASE + page.url,
                sideMenu: [],
                content: {
                    type: 'unknown',
                    text: '',
                    tables: [],
                    images: [],
                    boardList: [],
                    links: []
                }
            };

            // --- 좌측 메뉴 추출 ---
            var lnbSelectors = ['#snb', '.snb', '#lnb', '.lnb', '.sub_menu', '.leftMenu', '.left_menu', '.sub_nav'];
            var lnbEl = null;
            for (var s = 0; s < lnbSelectors.length; s++) {
                lnbEl = doc.querySelector(lnbSelectors[s]);
                if (lnbEl) break;
            }
            if (lnbEl) {
                var lnbLinks = lnbEl.querySelectorAll('a');
                for (var j = 0; j < lnbLinks.length; j++) {
                    var la = lnbLinks[j];
                    var lhref = la.getAttribute('href') || '';
                    if (lhref && lhref !== '#' && lhref.indexOf('javascript:void') === -1) {
                        pageData.sideMenu.push({
                            title: la.textContent.trim(),
                            link: lhref
                        });
                    }
                }
            }

            // --- 콘텐츠 영역 찾기 ---
            var contentSelectors = ['#container', '.container', '#content', '.content', '.sub_content', '.cont_area', '#sub_content', '.subContent', 'table.bbslist', '.board_area'];
            var contentEl = null;
            for (var s2 = 0; s2 < contentSelectors.length; s2++) {
                contentEl = doc.querySelector(contentSelectors[s2]);
                if (contentEl) break;
            }

            // 못 찾으면 body 전체
            if (!contentEl) contentEl = doc.body;

            // --- 게시판 테이블 감지 ---
            var allTables = contentEl.querySelectorAll('table');
            var boardTable = null;

            for (var t = 0; t < allTables.length; t++) {
                var tbl = allTables[t];
                var trCount = tbl.querySelectorAll('tr').length;
                // 행이 5개 이상이고, th가 있으면 게시판으로 판단
                if (trCount >= 5 && tbl.querySelector('th')) {
                    boardTable = tbl;
                    break;
                }
            }

            if (boardTable) {
                // === 게시판 타입 ===
                pageData.content.type = 'board';

                var bRows = boardTable.querySelectorAll('tr');
                var bHeaders = [];

                // 헤더
                var thEls = bRows[0] ? bRows[0].querySelectorAll('th') : [];
                for (var h = 0; h < thEls.length; h++) {
                    bHeaders.push(thEls[h].textContent.trim());
                }

                // 데이터 행
                for (var r = 1; r < bRows.length; r++) {
                    var tds = bRows[r].querySelectorAll('td');
                    if (tds.length < 2) continue;

                    var rowObj = {};
                    for (var c = 0; c < tds.length; c++) {
                        var colName = bHeaders[c] || ('col' + c);
                        rowObj[colName] = tds[c].textContent.trim();

                        var tdLink = tds[c].querySelector('a');
                        if (tdLink) {
                            var tdHref = tdLink.getAttribute('href') || '';
                            var tdOnclick = tdLink.getAttribute('onclick') || '';
                            if (tdHref && tdHref !== '#') rowObj[colName + '_link'] = tdHref;
                            if (tdOnclick) rowObj[colName + '_onclick'] = tdOnclick;
                        }
                    }
                    pageData.content.boardList.push(rowObj);
                }

            } else {
                // === 일반 콘텐츠 타입 ===
                pageData.content.type = 'article';

                // 텍스트 (스크립트, 스타일, 메뉴 제외)
                var cloneEl = contentEl.cloneNode(true);
                var removes = cloneEl.querySelectorAll('script, style, .snb, #snb, .lnb, #lnb, .gnb, #gnb, .sub_menu, .leftMenu, nav');
                for (var rm = 0; rm < removes.length; rm++) {
                    removes[rm].remove();
                }
                pageData.content.text = cloneEl.textContent.trim().replace(/\s+/g, ' ').substring(0, 15000);

                // 테이블
                var infoTables = contentEl.querySelectorAll('table');
                for (var it = 0; it < infoTables.length; it++) {
                    var tData = { rows: [] };
                    var itRows = infoTables[it].querySelectorAll('tr');
                    for (var ir = 0; ir < itRows.length; ir++) {
                        var cells = itRows[ir].querySelectorAll('th, td');
                        var rowArr = [];
                        for (var ic = 0; ic < cells.length; ic++) {
                            rowArr.push({
                                type: cells[ic].tagName.toLowerCase(),
                                text: cells[ic].textContent.trim().substring(0, 500)
                            });
                        }
                        if (rowArr.length > 0) tData.rows.push(rowArr);
                    }
                    if (tData.rows.length > 0) pageData.content.tables.push(tData);
                }
            }

            // --- 이미지 추출 ---
            var imgs = contentEl.querySelectorAll('img');
            for (var im = 0; im < imgs.length; im++) {
                var src = imgs[im].getAttribute('src') || '';
                // 아이콘/버튼 제외
                if (src && src.indexOf('btn_') === -1 && src.indexOf('icon_') === -1 && src.indexOf('bullet') === -1 && src.indexOf('bg_') === -1) {
                    var fullSrc = src;
                    if (!src.startsWith('http')) {
                        fullSrc = BASE + (src.startsWith('/') ? '' : '/') + src;
                    }
                    pageData.content.images.push({
                        src: fullSrc,
                        alt: imgs[im].getAttribute('alt') || ''
                    });
                }
            }

            result.pages[page.id] = pageData;
            console.log('  OK (' + pageData.content.type + ')');

        } catch (err) {
            console.error('  에러: ' + err.message);
            result.pages[page.id] = { title: page.title, error: err.message };
        }

        // 대기
        await new Promise(function(resolve) { setTimeout(resolve, DELAY); });
    }

    // === JSON 다운로드 ===
    console.log('');
    console.log('JSON 파일 생성 중...');

    var jsonStr = JSON.stringify(result, null, 2);

    // 서버로 직접 전송
    console.log('서버로 데이터 전송 중...');
    try {
        var uploadResp = await fetch('http://115.68.216.152/cmak/cmak-upload.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: jsonStr
        });
        if (uploadResp.ok) {
            console.log('서버 업로드 성공!');
        } else {
            console.log('서버 업로드 실패, data: URI 방식으로 다운로드합니다.');
        }
    } catch(e) {
        console.log('서버 전송 실패: ' + e.message);
    }

    // data: URI 방식 다운로드 (백업)
    try {
        var downloadLink = document.createElement('a');
        downloadLink.href = 'data:application/json;charset=utf-8,' + encodeURIComponent(jsonStr);
        downloadLink.download = 'cmak_data.json';
        downloadLink.style.display = 'none';
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
        console.log('파일 다운로드 시도 완료');
    } catch(e2) {
        console.log('다운로드도 실패. 아래 데이터를 복사하세요:');
        console.log(jsonStr.substring(0, 100) + '...');
    }

    var pageCount = Object.keys(result.pages).length;
    console.log('=== 완료! ' + pageCount + '개 페이지 추출됨 ===');
    console.log('cmak_data.json이 다운로드되지 않으면 서버에 직접 전송되었습니다.');

})();
