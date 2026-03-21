<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>팝업 미리보기 - {{ $popup->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="text-center">
        {{-- 정보 바 --}}
        <div class="mb-4 bg-white rounded-lg shadow px-6 py-3 inline-flex items-center gap-4 text-sm text-gray-600">
            <span class="font-medium text-gray-900">{{ $popup->title }}</span>
            <span class="text-gray-300">|</span>
            <span>유형: {{ $popup->popup_type == 'layer' ? '레이어' : '윈도우' }}</span>
            <span class="text-gray-300">|</span>
            <span>크기: {{ $popup->width ?? '-' }}x{{ $popup->height ?? '-' }}px</span>
            <span class="text-gray-300">|</span>
            <span>위치: ({{ $popup->position_x ?? 0 }}, {{ $popup->position_y ?? 0 }})</span>
            <span class="text-gray-300">|</span>
            <a href="{{ url('/admin/popups/' . $popup->id . '/edit') }}"
               class="text-blue-600 hover:text-blue-800 font-medium">수정하기</a>
            <button onclick="window.close()" class="text-gray-500 hover:text-gray-700 font-medium">닫기</button>
        </div>

        {{-- 팝업 미리보기 영역 --}}
        <div class="inline-block bg-white rounded-lg shadow-xl overflow-hidden border border-gray-300"
             style="width: {{ $popup->width ?? 500 }}px; min-height: {{ $popup->height ?? 400 }}px;">

            {{-- 팝업 헤더 --}}
            <div class="bg-gray-800 text-white px-4 py-2 flex items-center justify-between">
                <span class="text-sm font-medium truncate">{{ $popup->title }}</span>
                <button onclick="window.close()" class="text-gray-400 hover:text-white transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            {{-- 팝업 본문 --}}
            <div class="relative" style="min-height: {{ ($popup->height ?? 400) - 40 }}px;">
                @if($popup->content)
                    <div class="p-4 text-sm text-gray-700 leading-relaxed">
                        {!! $popup->content !!}
                    </div>
                @endif

                @if(!$popup->content)
                    <div class="flex items-center justify-center h-full p-8 text-gray-400">
                        <div class="text-center">
                            <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <p class="mt-2 text-sm">콘텐츠가 없습니다</p>
                        </div>
                    </div>
                @endif
            </div>

            {{-- 팝업 하단 --}}
            <div class="bg-gray-50 border-t border-gray-200 px-4 py-2 flex items-center justify-between">
                <label class="flex items-center gap-2 cursor-pointer text-xs text-gray-500">
                    <input type="checkbox" class="rounded border-gray-300 text-gray-600 shadow-sm">
                    <span>오늘 하루 보지 않기</span>
                </label>
                <button onclick="window.close()" class="text-xs text-gray-500 hover:text-gray-700 font-medium">
                    닫기
                </button>
            </div>
        </div>
    </div>
</body>
</html>
