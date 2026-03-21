@extends('admin.layouts.app')

@section('title', '관련사이트 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">관련사이트 등록</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 관련사이트를 등록합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/related-sites') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 사이트명 --}}
            <div>
                <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">사이트명 <span class="text-red-500">*</span></label>
                <input type="text" name="site_name" id="site_name" value="{{ old('site_name') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="사이트명을 입력하세요">
                @error('site_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- URL --}}
            <div>
                <label for="site_url" class="block text-sm font-medium text-gray-700 mb-1">URL <span class="text-red-500">*</span></label>
                <input type="url" name="site_url" id="site_url" value="{{ old('site_url') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="https://example.com">
                @error('site_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 유형 --}}
            <div>
                <label for="site_type" class="block text-sm font-medium text-gray-700 mb-1">유형</label>
                <select name="site_type" id="site_type"
                        class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="domestic" {{ old('site_type') === 'domestic' ? 'selected' : '' }}>국내</option>
                    <option value="overseas" {{ old('site_type') === 'overseas' ? 'selected' : '' }}>해외</option>
                    <option value="media" {{ old('site_type') === 'media' ? 'selected' : '' }}>언론</option>
                    <option value="bidding" {{ old('site_type') === 'bidding' ? 'selected' : '' }}>입찰정보</option>
                </select>
                @error('site_type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 로고 --}}
            <div>
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">로고</label>
                <input type="file" name="logo" id="logo" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">PNG, JPG, GIF 형식 (권장: 200x60px)</p>
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 활성 & 정렬순서 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="text-sm text-gray-700">활성</span>
                    </label>
                </div>
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">정렬순서</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                           class="w-32 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- 버튼 --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/related-sites') }}"
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
