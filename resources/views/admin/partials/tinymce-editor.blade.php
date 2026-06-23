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
