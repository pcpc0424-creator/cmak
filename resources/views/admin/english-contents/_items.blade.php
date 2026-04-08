{{-- Items management section --}}
<div class="mt-10 bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 bg-gradient-to-r from-blue-700 to-blue-600 text-white">
        <h2 class="text-base font-bold">📋 이 페이지의 항목들</h2>
        <p class="text-xs text-blue-100 mt-0.5">
            영문 페이지에 표시되는 리스트형 콘텐츠 (뉴스 / 출판물 / 이벤트 / 갤러리 / 멤버 / 슬라이드 등) 입니다.<br>
            각 항목을 클릭해서 수정하거나 삭제할 수 있습니다.
        </p>
    </div>

    {{-- 기존 항목 목록 --}}
    @if($items->count() > 0)
        <div class="divide-y divide-gray-200">
            @foreach($items as $item)
                <div class="px-6 py-4 hover:bg-gray-50">
                    <details class="group">
                        <summary class="flex items-start gap-4 cursor-pointer list-none">
                            {{-- 썸네일 --}}
                            @if($item->image_path)
                                <img src="{{ $item->image_path }}" alt="" class="w-20 h-14 object-cover rounded flex-shrink-0">
                            @else
                                <div class="w-20 h-14 bg-gray-100 rounded flex items-center justify-center flex-shrink-0">
                                    <span class="text-xs text-gray-400 font-mono">{{ $item->type }}</span>
                                </div>
                            @endif

                            {{-- 정보 --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <span class="text-xs font-mono text-gray-500">#{{ $item->sort_order }}</span>
                                    @if($item->tag)
                                        <span class="px-2 py-0.5 text-xs font-bold text-blue-700 bg-blue-100 rounded">{{ $item->tag }}</span>
                                    @endif
                                    @if($item->date_text)
                                        <span class="text-xs text-gray-500">{{ $item->date_text }}</span>
                                    @endif
                                    @if(!$item->is_active)
                                        <span class="px-2 py-0.5 text-xs font-bold text-gray-500 bg-gray-200 rounded">비활성</span>
                                    @endif
                                </div>
                                <div class="mt-1 text-sm font-semibold text-gray-900 truncate">{{ $item->title ?: '(제목 없음)' }}</div>
                                @if($item->subtitle)
                                    <div class="text-xs text-gray-500 truncate">{{ $item->subtitle }}</div>
                                @endif
                            </div>

                            <div class="flex-shrink-0 text-xs text-gray-400 group-open:rotate-180 transition-transform">▼</div>
                        </summary>

                        {{-- 인라인 편집 폼 --}}
                        <form action="{{ url('/admin/english-contents/' . $content->id . '/items/' . $item->id) }}" method="POST" class="mt-4 ml-24 grid grid-cols-2 gap-3">
                            @csrf @method('PUT')
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">타입</label>
                                <input type="text" name="type" value="{{ $item->type }}" required class="w-full rounded border-gray-300 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">정렬 순서</label>
                                <input type="number" name="sort_order" value="{{ $item->sort_order }}" class="w-full rounded border-gray-300 text-sm">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">제목 (Title)</label>
                                <input type="text" name="title" value="{{ $item->title }}" class="w-full rounded border-gray-300 text-sm">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">부제 / 서브타이틀 (Subtitle)</label>
                                <input type="text" name="subtitle" value="{{ $item->subtitle }}" class="w-full rounded border-gray-300 text-sm">
                            </div>
                            <div class="col-span-2">
                                <label class="block text-xs font-medium text-gray-700 mb-1">설명 (Description)</label>
                                <textarea name="description" rows="3" class="w-full rounded border-gray-300 text-sm">{{ $item->description }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">이미지 경로</label>
                                <input type="text" name="image_path" value="{{ $item->image_path }}" placeholder="/cmak/images/eng/eng1.jpg" class="w-full rounded border-gray-300 text-sm font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">링크 URL</label>
                                <input type="text" name="link" value="{{ $item->link }}" class="w-full rounded border-gray-300 text-sm font-mono">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">태그 / 라벨</label>
                                <input type="text" name="tag" value="{{ $item->tag }}" placeholder="NEWS, MAGAZINE, EVENT..." class="w-full rounded border-gray-300 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-700 mb-1">날짜 / 기간 표기</label>
                                <input type="text" name="date_text" value="{{ $item->date_text }}" placeholder="15 APR 2026 / 40 hours / Annual" class="w-full rounded border-gray-300 text-sm">
                            </div>
                            <div class="col-span-2 flex items-center justify-between">
                                <label class="inline-flex items-center text-sm">
                                    <input type="checkbox" name="is_active" value="1" {{ $item->is_active ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                                    <span class="ml-2">활성</span>
                                </label>
                                <div class="flex gap-2">
                                    <button type="submit" class="px-4 py-1.5 bg-blue-600 text-white text-xs font-bold rounded hover:bg-blue-700">저장</button>
                            </div>
                            </div>
                        </form>

                        {{-- 삭제 폼 (별도) --}}
                        <form action="{{ url('/admin/english-contents/' . $content->id . '/items/' . $item->id) }}" method="POST"
                              onsubmit="return confirm('이 항목을 삭제하시겠습니까?');"
                              class="mt-2 ml-24 text-right">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-3 py-1 text-xs text-red-700 bg-red-50 rounded hover:bg-red-100">삭제</button>
                        </form>
                    </details>
                </div>
            @endforeach
        </div>
    @else
        <div class="px-6 py-12 text-center text-sm text-gray-500">
            이 페이지에는 리스트형 항목이 없습니다.
        </div>
    @endif
</div>
