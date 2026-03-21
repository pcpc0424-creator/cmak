@extends('admin.layouts.app')

@section('title', '배너 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">배너 등록</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 배너를 등록합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/banners') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 제목 --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="배너 제목을 입력하세요">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 2열 그리드 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- 화면유형 --}}
                <div>
                    <label for="screen_type" class="block text-sm font-medium text-gray-700 mb-1">화면유형</label>
                    <select name="screen_type" id="screen_type"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="main" {{ old('screen_type') == 'main' ? 'selected' : '' }}>메인 (main)</option>
                        <option value="sub" {{ old('screen_type') == 'sub' ? 'selected' : '' }}>서브 (sub)</option>
                        <option value="sidebar" {{ old('screen_type') == 'sidebar' ? 'selected' : '' }}>사이드바 (sidebar)</option>
                    </select>
                    @error('screen_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            {{-- 이미지 --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">이미지</label>
                <input type="file" name="image" id="image" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">JPG, PNG, GIF 형식 (권장 사이즈: 메인 1920x500, 서브 1200x300, 사이드바 300x600)</p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 2열 그리드 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- 링크URL --}}
                <div>
                    <label for="link_url" class="block text-sm font-medium text-gray-700 mb-1">링크URL</label>
                    <input type="url" name="link_url" id="link_url" value="{{ old('link_url') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="https://example.com">
                    @error('link_url')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 시작일 --}}
                <div>
                    <label for="started_at" class="block text-sm font-medium text-gray-700 mb-1">시작일</label>
                    <input type="datetime-local" name="started_at" id="started_at" value="{{ old('started_at') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('started_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 종료일 --}}
                <div>
                    <label for="ended_at" class="block text-sm font-medium text-gray-700 mb-1">종료일</label>
                    <input type="datetime-local" name="ended_at" id="ended_at" value="{{ old('ended_at') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('ended_at')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 활성 & 정렬순서 --}}
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">활성</span>
                </label>
                <div class="flex items-center gap-2">
                    <label for="sort_order" class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}"
                           class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-center"
                           min="0">
                </div>
            </div>
        </div>

        {{-- 버튼 --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/banners') }}"
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
