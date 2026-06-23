@extends('admin.layouts.app')

@section('title', '상단 POPUP 버튼 수정')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">상단 POPUP 버튼 수정</h1>
    </div>

    <form action="{{ url('/admin/top-popup-items/' . $topPopupItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label for="label" class="block text-sm font-medium text-gray-700 mb-1">텍스트(라벨) <span class="text-red-500">*</span></label>
                <input type="text" name="label" id="label" value="{{ old('label', $topPopupItem->label) }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('label')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="link_url" class="block text-sm font-medium text-gray-700 mb-1">링크 URL</label>
                <input type="text" name="link_url" id="link_url" value="{{ old('link_url', $topPopupItem->link_url) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="/business/certification 또는 https://...">
                @error('link_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="link_target" class="block text-sm font-medium text-gray-700 mb-1">링크 열기</label>
                <select name="link_target" id="link_target" class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="_self" {{ old('link_target', $topPopupItem->link_target) == '_self' ? 'selected' : '' }}>현재 창</option>
                    <option value="_blank" {{ old('link_target', $topPopupItem->link_target) == '_blank' ? 'selected' : '' }}>새 창</option>
                </select>
            </div>

            @if($topPopupItem->image_path)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">현재 이미지</label>
                @if(file_exists(public_path($topPopupItem->image_path)))
                    <img src="/cmak/{{ $topPopupItem->image_path }}" alt="{{ $topPopupItem->label }}" class="h-20 rounded-md border border-gray-200">
                @else
                    <p class="text-xs text-red-500">이미지 파일 없음: {{ $topPopupItem->image_path }}</p>
                @endif
            </div>
            @endif

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">이미지 {{ $topPopupItem->image_path ? '교체' : '등록' }} (선택)</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">새 이미지를 선택하면 교체됩니다. 비워두면 유지됩니다.</p>
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $topPopupItem->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">노출</span>
                </label>
                <div class="flex items-center gap-2">
                    <label for="sort_order" class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $topPopupItem->sort_order) }}" min="0"
                           class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-center">
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between gap-3">
            <button type="button" onclick="if(confirm('삭제하시겠습니까?')) document.getElementById('del-form').submit();"
                    class="inline-flex items-center px-4 py-2 bg-white border border-red-300 text-sm font-medium text-red-600 rounded-md hover:bg-red-50 transition">삭제</button>
            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/top-popup-items') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">목록으로</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">수정 저장</button>
            </div>
        </div>
    </form>

    <form id="del-form" action="{{ url('/admin/top-popup-items/' . $topPopupItem->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection
