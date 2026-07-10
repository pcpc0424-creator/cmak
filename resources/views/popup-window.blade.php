<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $popup->title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, "Apple SD Gothic Neo", "Malgun Gothic", sans-serif; background: #fff; }
        .pw-body { }
        .pw-body img { display: block; width: 100%; height: auto; }
        .pw-content { padding: 16px; font-size: 14px; line-height: 1.7; color: #333; }
        .pw-foot {
            display: flex; align-items: center; justify-content: space-between;
            padding: 8px 12px; background: #f4f6f9; border-top: 1px solid #e5e7eb; font-size: 13px;
        }
        .pw-foot label { color: #555; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
        .pw-foot button { border: 0; background: #444; color: #fff; padding: 5px 14px; border-radius: 4px; cursor: pointer; font-size: 13px; }
        .pw-foot button:hover { background: #222; }
    </style>
</head>
<body>
    @php $popupBase = '/cmak'; @endphp
    <div class="pw-body">
        @if($popup->image_path)
            @php $img = $popupBase . '/' . ltrim($popup->image_path, '/'); @endphp
            @if($popup->link_url)
                <a href="{{ $popup->link_url }}" target="_blank" rel="noopener noreferrer"><img src="{{ $img }}" alt="{{ $popup->title }}"></a>
            @else
                <img src="{{ $img }}" alt="{{ $popup->title }}">
            @endif
        @endif
        @if($popup->content)
            <div class="pw-content">{!! $popup->content !!}</div>
        @endif
    </div>
    <div class="pw-foot">
        <label><input type="checkbox" id="pwHideToday"> 오늘 하루 보지 않기</label>
        <button type="button" onclick="window.close();">닫기</button>
    </div>
    <script>
        document.getElementById('pwHideToday').addEventListener('change', function () {
            if (this.checked) {
                var d = new Date();
                var today = d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
                // 도메인 전역 쿠키(자정까지) — 메인 페이지가 이 값을 읽어 재오픈 차단
                var expire = new Date(d.getFullYear(), d.getMonth(), d.getDate() + 1, 0, 0, 0);
                document.cookie = 'cmak_popup_hide_{{ $popup->id }}=' + today + '; expires=' + expire.toUTCString() + '; path=/';
                window.close();
            }
        });
    </script>
</body>
</html>
