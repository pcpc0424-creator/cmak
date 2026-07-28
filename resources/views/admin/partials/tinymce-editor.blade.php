{{-- TinyMCE 7 WYSIWYG 에디터 (관리자 게시글 작성/수정용) --}}
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea#content',
        license_key: 'gpl',
        promotion: false,
        branding: false,
        language: 'ko_KR',
        language_url: 'https://cdn.jsdelivr.net/npm/tinymce-i18n@latest/langs7/ko_KR.js',
        height: 500,
        // 절대경로(/cmak/...)를 상대경로로 자동변환하지 않음 — 변환되면 페이지 URL 깊이가 달라 이미지/링크가 깨짐
        convert_urls: false,
        relative_urls: false,
        menubar: 'edit view insert format table',
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
            'preview', 'anchor', 'searchreplace', 'visualblocks', 'code',
            'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar:
            'undo redo | blocks fontfamily fontsize | ' +
            'bold italic underline strikethrough | forecolor backcolor | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist outdent indent | ' +
            'link image media table | ' +
            'removeformat | preview code fullscreen | help',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Pretendard", "Apple SD Gothic Neo", sans-serif; font-size: 14px; line-height: 1.7; }',
        // 이미지를 base64로 인라인 삽입 (별도 업로드 endpoint 불필요)
        images_upload_handler: function (blobInfo) {
            return new Promise(function (resolve) {
                var reader = new FileReader();
                reader.onloadend = function () { resolve(reader.result); };
                reader.readAsDataURL(blobInfo.blob());
            });
        },
        paste_data_images: true,
        // 관리자 전용 CMS — 자유로운 편집 허용(모든 요소/속성). 조직도 등 SVG·CSS 직접 편집 대응.
        valid_elements: '*[*]',
        // SVG 원본 마크업 · <style> CSS 블록 · iframe 임베드가 저장 시 제거되지 않도록 명시 허용
        extended_valid_elements: 'style,svg[*],path[*],g[*],defs[*],use[*],symbol[*],circle[*],ellipse[*],rect[*],line[*],polyline[*],polygon[*],text[*],tspan[*],image[*],clipPath[*],mask[*],pattern[*],marker[*],linearGradient[*],radialGradient[*],stop[*],filter[*],feGaussianBlur[*],iframe[src|width|height|frameborder|style|allow|allowfullscreen|loading|referrerpolicy|title|name|scrolling]',
        valid_children: '+body[style|svg|link],+div[style|svg|iframe],+p[svg|iframe],+svg[*]',
        // <style>/SVG 등 특수 마크업이 HTML 검증 단계에서 손실되지 않도록 완화
        verify_html: false,
        sandbox_iframes: false,
        // 이미지 삽입 다이얼로그에서 SVG·webp 파일도 선택 가능
        images_file_types: 'jpg,jpeg,jpe,png,gif,bmp,webp,svg',
        // 한글 입력 안정성
        forced_root_block: 'p',
        // 링크 옵션
        link_default_target: '_blank',
        link_assume_external_targets: true,
        // 폼 제출 전 textarea에 값 동기화
        setup: function (editor) {
            editor.on('change', function () { editor.save(); });
        }
    });
</script>
