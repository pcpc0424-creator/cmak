@extends('admin.layouts.app')

@section('title', '팝업 수정')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">팝업 수정</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $popup->title }} 팝업을 수정합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/popups/' . $popup->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 제목 --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $popup->title) }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="팝업 제목을 입력하세요">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 유형 --}}
            <div>
                <label for="popup_type" class="block text-sm font-medium text-gray-700 mb-1">유형</label>
                <select name="popup_type" id="popup_type"
                        class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="layer" {{ old('popup_type', $popup->popup_type) == 'layer' ? 'selected' : '' }}>레이어 (layer)</option>
                    <option value="window" {{ old('popup_type', $popup->popup_type) == 'window' ? 'selected' : '' }}>윈도우 (window)</option>
                </select>
                @error('popup_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 내용 --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">내용</label>
                <textarea name="content" id="content" rows="8"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                          placeholder="팝업 내용을 입력하세요 (HTML 사용 가능)">{{ old('content', $popup->content) }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 현재 이미지 --}}
            @if($popup->image_path)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">현재 이미지</label>
                @if(file_exists(public_path($popup->image_path)))
                    <img src="/cmak/{{ $popup->image_path }}" alt="{{ $popup->title }}" class="rounded-md border border-gray-200 max-h-44">
                @else
                    <p class="text-xs text-red-500">이미지 파일 없음: {{ $popup->image_path }}</p>
                @endif
                <label class="mt-2 flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 shadow-sm focus:ring-red-500">
                    <span class="text-sm text-red-600">기존 이미지 삭제</span>
                </label>
            </div>
            @endif

            {{-- 이미지 교체/등록 --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">이미지 {{ $popup->image_path ? '교체' : '등록' }} (선택)</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">새 이미지를 선택하면 교체됩니다. 비워두면 유지됩니다.</p>
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- 링크 URL --}}
            <div>
                <label for="link_url" class="block text-sm font-medium text-gray-700 mb-1">링크 URL (선택)</label>
                <input type="text" name="link_url" id="link_url" value="{{ old('link_url', $popup->link_url) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="https://example.com 또는 /business/certification">
                <p class="mt-1 text-xs text-gray-400">입력 시 팝업(이미지) 클릭하면 이 주소로 이동합니다.</p>
                @error('link_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- 크기 & 위치 (4열 그리드) --}}
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                <div>
                    <label for="width" class="block text-sm font-medium text-gray-700 mb-1">너비 (px)</label>
                    <input type="number" name="width" id="width" value="{{ old('width', $popup->width) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           min="100">
                    @error('width')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="height" class="block text-sm font-medium text-gray-700 mb-1">높이 (px)</label>
                    <input type="number" name="height" id="height" value="{{ old('height', $popup->height) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           min="100">
                    @error('height')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="position_x" class="block text-sm font-medium text-gray-700 mb-1">X 위치 (px)</label>
                    <input type="number" name="position_x" id="position_x" value="{{ old('position_x', $popup->position_x) }}"
                           placeholder="비우면 자동"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           min="0">
                    @error('position_x')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="position_y" class="block text-sm font-medium text-gray-700 mb-1">Y 위치 (px)</label>
                    <input type="number" name="position_y" id="position_y" value="{{ old('position_y', $popup->position_y) }}"
                           placeholder="비우면 자동"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           min="0">
                    @error('position_y')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <p class="mt-2 text-xs text-gray-500">
                위치는 작성자가 직접 지정합니다. <b>X</b>는 화면 왼쪽 끝, <b>Y</b>는 화면 위쪽 끝 기준 픽셀 값입니다.
                비워두면 히어로 타이틀을 가리지 않도록 <b>오른쪽에 자동 배치</b>되고, 여러 개면 계단식으로 겹치지 않게 표시됩니다.
            </p>

            {{-- 기간 (2열) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="started_at" class="block text-sm font-medium text-gray-700 mb-1">시작일</label>
                    <input type="datetime-local" name="started_at" id="started_at"
                           value="{{ old('started_at', $popup->started_at ? \Carbon\Carbon::parse($popup->started_at)->format('Y-m-d\TH:i') : '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('started_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="ended_at" class="block text-sm font-medium text-gray-700 mb-1">종료일</label>
                    <input type="datetime-local" name="ended_at" id="ended_at"
                           value="{{ old('ended_at', $popup->ended_at ? \Carbon\Carbon::parse($popup->ended_at)->format('Y-m-d\TH:i') : '') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('ended_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 활성 --}}
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $popup->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">활성</span>
                </label>
            </div>
        </div>

        {{-- 버튼 --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/popups') }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">
                목록으로
            </a>
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                저장
            </button>
        </div>
    </form>
</div>
@endsection
