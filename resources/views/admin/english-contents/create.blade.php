@extends('admin.layouts.app')

@section('title', '영문 콘텐츠 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">영문 콘텐츠 등록</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 영문 콘텐츠를 등록합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/english-contents') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 제목 --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="Title">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 섹션 --}}
            <div>
                <label for="section" class="block text-sm font-medium text-gray-700 mb-1">섹션</label>
                <select name="section" id="section"
                        class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="about" {{ old('section') === 'about' ? 'selected' : '' }}>About</option>
                    <option value="members" {{ old('section') === 'members' ? 'selected' : '' }}>Members</option>
                    <option value="services" {{ old('section') === 'services' ? 'selected' : '' }}>Services</option>
                    <option value="contact" {{ old('section') === 'contact' ? 'selected' : '' }}>Contact</option>
                    <option value="news" {{ old('section') === 'news' ? 'selected' : '' }}>News</option>
                </select>
                @error('section')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 내용 --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">내용 <span class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="20" required
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                          placeholder="Content">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 발행여부 & 정렬순서 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                        <span class="text-sm text-gray-700">발행여부</span>
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
            <a href="{{ url('/admin/english-contents') }}"
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
