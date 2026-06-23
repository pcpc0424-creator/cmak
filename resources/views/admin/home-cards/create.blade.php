@extends('admin.layouts.app')

@section('title', '바로가기 카드 등록')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">바로가기 카드 등록</h1>
        <p class="mt-1 text-sm text-gray-500">이미지를 넣으면 평소엔 이미지만 보이고, 마우스를 올리면 어둡게 처리되며 제목·설명이 표시됩니다.</p>
    </div>

    <form action="{{ url('/admin/home-cards') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="bg-white rounded-lg shadow p-6 space-y-5">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="예: CM관련서식">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">설명</label>
                <input type="text" name="subtitle" value="{{ old('subtitle') }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="예: CM 업무 관련 서식">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">링크 URL</label>
                <input type="text" name="link_url" value="{{ old('link_url') }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm" placeholder="/business/cm-forms 또는 https://...">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">아이콘 (이미지 없을 때 표시)</label>
                <select name="icon" class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm text-sm">
                    <option value="">기본</option>
                    @foreach($icons as $key => $label)
                        <option value="{{ $key }}" {{ old('icon') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">이미지 (선택)</label>
                <input type="file" name="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">등록 시 카드가 이미지로 표시되고, hover하면 dim+제목/설명이 나타납니다.</p>
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div class="flex flex-wrap items-center gap-6 pt-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">노출</span>
                </label>
                <div class="flex items-center gap-2">
                    <label class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order') }}" min="0" placeholder="자동" class="w-20 rounded-md border-gray-300 shadow-sm text-sm text-center">
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/home-cards') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">목록으로</a>
            <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">저장</button>
        </div>
    </form>
</div>
@endsection
