{{-- 사이트 레이어 팝업 (관리자 팝업관리 연동) --}}
@php
    $activePopups = collect();
    try {
        $activePopups = \App\Models\Popup::active()->orderBy('sort_order')->orderBy('id')->get();
    } catch (\Throwable $e) {
        $activePopups = collect();
    }
    $popupBase = '/cmak';
@endphp

@if($activePopups->isNotEmpty())
<div id="site-popups">
    @foreach($activePopups as $popup)
        <div class="site-popup" id="site-popup-{{ $popup->id }}" data-popup-id="{{ $popup->id }}"
             style="display:none; left: {{ (int)($popup->position_x ?? 100) }}px; top: {{ (int)($popup->position_y ?? 100) }}px; width: {{ (int)($popup->width ?? 400) }}px;">
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
@endif
