{{-- 사이트 레이어 팝업 (관리자 팝업관리 연동) --}}
@php
    $activePopups = collect();
    try {
        $activePopups = \App\Models\Popup::active()->orderBy('sort_order')->orderBy('id')->get();
    } catch (\Throwable $e) {
        $activePopups = collect();
    }
    $popupBase = '/cmak';
    // 레이어형(페이지 내 플로팅) vs 윈도우형(새 창) 구분
    $layerPopups = $activePopups->filter(fn($p) => ($p->popup_type ?? 'layer') !== 'window');
    $windowPopups = $activePopups->filter(fn($p) => ($p->popup_type ?? 'layer') === 'window');
@endphp

@if($layerPopups->isNotEmpty() || $windowPopups->isNotEmpty())
<div id="site-popups">
    @foreach($layerPopups as $popup)
        <div class="site-popup" id="site-popup-{{ $popup->id }}" data-popup-id="{{ $popup->id }}"
             data-pos-x="{{ $popup->position_x !== null ? (int)$popup->position_x : '' }}"
             data-pos-y="{{ $popup->position_y !== null ? (int)$popup->position_y : '' }}"
             style="display:none; width: {{ (int)($popup->width ?? 400) }}px;">
            <div class="site-popup-head">
                <span class="site-popup-title">{{ $popup->title }}</span>
                <button type="button" class="site-popup-x" data-close="{{ $popup->id }}" aria-label="닫기">&times;</button>
            </div>
            <div class="site-popup-body">
                @if($popup->image_path)
                    @php $img = $popupBase . '/' . ltrim($popup->image_path, '/'); @endphp
                    @if($popup->link_url)
                        <a href="{{ $popup->link_url }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ $img }}" alt="{{ $popup->title }}">
                        </a>
                    @else
                        <img src="{{ $img }}" alt="{{ $popup->title }}">
                    @endif
                @endif
                @if($popup->content)
                    <div class="site-popup-content">{!! $popup->content !!}</div>
                @endif
            </div>
            <div class="site-popup-foot">
                <label class="site-popup-hide">
                    <input type="checkbox" class="site-popup-hide-today" data-popup-id="{{ $popup->id }}"> 오늘 하루 보지 않기
                </label>
                <button type="button" class="site-popup-close-btn" data-close="{{ $popup->id }}">닫기</button>
            </div>
        </div>
    @endforeach
</div>

<script>
(function () {
    function todayStr() {
        var d = new Date();
        return d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
    }
    function hide(id) {
        var el = document.getElementById('site-popup-' + id);
        if (el) el.style.display = 'none';
        layout();
    }
    // 위치 배치: 명시적 좌표가 있으면 그대로, 없으면 히어로 타이틀(좌측)을
    // 가리지 않도록 오른쪽에 자동 배치하고, 여러 개면 계단식으로 겹침 방지
    function layout() {
        var vw = window.innerWidth;
        var autoIdx = 0;
        document.querySelectorAll('.site-popup').forEach(function (el) {
            if (el.style.display === 'none') return;
            var w = el.offsetWidth || parseInt(el.style.width, 10) || 400;
            var px = el.getAttribute('data-pos-x');
            var py = el.getAttribute('data-pos-y');
            var hasX = px !== '' && px !== null;
            var hasY = py !== '' && py !== null;
            if (hasX && hasY) {
                el.style.left = parseInt(px, 10) + 'px';
                el.style.top = parseInt(py, 10) + 'px';
            } else {
                var offset = autoIdx * 32;
                autoIdx++;
                var left = (vw - w - 40) - offset;
                var top = 150 + offset;
                if (left < 12) left = 12;
                el.style.left = left + 'px';
                el.style.top = top + 'px';
            }
        });
    }
    // 표시 여부 결정 ('오늘 하루 보지 않기' 적용)
    document.querySelectorAll('.site-popup').forEach(function (el) {
        var id = el.getAttribute('data-popup-id');
        if (localStorage.getItem('cmak_popup_hide_' + id) === todayStr()) {
            el.style.display = 'none';
        } else {
            el.style.display = 'block';
        }
    });
    layout();
    window.addEventListener('resize', layout);
    // 닫기 버튼들
    document.querySelectorAll('[data-close]').forEach(function (btn) {
        btn.addEventListener('click', function () { hide(this.getAttribute('data-close')); });
    });
    // 오늘 하루 보지 않기
    document.querySelectorAll('.site-popup-hide-today').forEach(function (cb) {
        cb.addEventListener('change', function () {
            var id = this.getAttribute('data-popup-id');
            if (this.checked) {
                localStorage.setItem('cmak_popup_hide_' + id, todayStr());
                hide(id);
            } else {
                localStorage.removeItem('cmak_popup_hide_' + id);
            }
        });
    });
})();
</script>

@if($windowPopups->isNotEmpty())
<script>
(function () {
    function todayStr() {
        var d = new Date();
        return d.getFullYear() + '-' + (d.getMonth() + 1) + '-' + d.getDate();
    }
    function cookieHide(id) {
        var m = document.cookie.match(new RegExp('(?:^|; )cmak_popup_hide_' + id + '=([^;]*)'));
        return m ? decodeURIComponent(m[1]) : null;
    }
    var winPops = [
        @foreach($windowPopups as $wp)
        { id: {{ $wp->id }}, w: {{ (int)($wp->width ?? 500) }}, h: {{ (int)($wp->height ?? 600) }}, x: {{ $wp->position_x !== null ? (int)$wp->position_x : 'null' }}, y: {{ $wp->position_y !== null ? (int)$wp->position_y : 'null' }} },
        @endforeach
    ];
    winPops.forEach(function (p, i) {
        if (cookieHide(p.id) === todayStr()) return;
        if (localStorage.getItem('cmak_popup_hide_' + p.id) === todayStr()) return;
        var left = p.x !== null ? p.x : (140 + i * 30);
        var top = p.y !== null ? p.y : (140 + i * 30);
        var features = 'width=' + p.w + ',height=' + p.h + ',left=' + left + ',top=' + top + ',scrollbars=yes,resizable=yes';
        window.open('{{ $popupBase }}/popup/' + p.id + '/window', 'cmak_popup_' + p.id, features);
    });
})();
</script>
@endif
@endif
