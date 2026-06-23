@extends('admin.layouts.app')

@section('title', '상단 POPUP 버튼 등록')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">상단 POPUP 버튼 등록</h1>
        <p class="mt-1 text-sm text-gray-500">헤더 상단 POPUP 영역에 표시할 버튼을 추가합니다.</p>
    </div>

    <form action="{{ url('/admin/top-popup-items') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label for="label" class="block text-sm font-medium text-gray-700 mb-1">텍스트(라벨) <span class="text-red-500">*</span></label>
                <input type="text" name="label" id="label" value="{{ old('label') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="예: CM능력평가공시">
                <p class="mt-1 text-xs text-gray-400">이미지가 없을 때 표시되는 텍스트입니다.</p>
                @error('label')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="link_url" class="block text-sm font-medium text-gray-700 mb-1">링크 URL</label>
                <input type="text" name="link_url" id="link_url" value="{{ old('link_url') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="/business/certification 또는 https://...">
                @error('link_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="link_target" class="block text-sm font-medium text-gray-700 mb-1">링크 열기</label>
                <select name="link_target" id="link_target" class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="_self" {{ old('link_target') == '_self' ? 'selected' : '' }}>현재 창</option>
                    <option value="_blank" {{ old('link_target') == '_blank' ? 'selected' : '' }}>새 창</option>
                </select>
            </div>

            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">이미지 (선택)</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">등록 시 텍스트 대신 이미지로 표시됩니다. 권장 높이 100px. JPG, PNG</p>
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">노출</span>
                </label>
                <div class="flex items-center gap-2">
                    <label for="sort_order" class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order') }}" min="0" placeholder="자동"
                           class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-center">
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/top-popup-items') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">목록으로</a>
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">저장</button>
        </div>
    </form>
</div>
@endsection
