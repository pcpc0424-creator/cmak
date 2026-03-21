@extends('admin.layouts.app')

@section('title', ($boardConfig['name'] ?? '게시판') . ' 작성')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $boardConfig['name'] ?? '게시판' }} 작성</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 게시물을 작성합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/posts/' . $boardType) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 제목 --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="제목을 입력하세요">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 작성자 --}}
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">작성자 <span class="text-red-500">*</span></label>
                <input type="text" name="author" id="author" value="{{ old('author') }}" required
                       class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="작성자명을 입력하세요">
                @error('author')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 호수 (has_issue_number인 경우) --}}
            @if(!empty($boardConfig['has_issue_number']))
                <div>
                    <label for="issue_number" class="block text-sm font-medium text-gray-700 mb-1">호수</label>
                    <input type="text" name="issue_number" id="issue_number" value="{{ old('issue_number') }}"
                           class="w-full sm:w-1/3 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="예: 2026년 3월호">
                    @error('issue_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            {{-- 내용 --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">내용 <span class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="15" required
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                          placeholder="내용을 입력하세요">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 요약 (has_summary인 경우) --}}
            @if(!empty($boardConfig['has_summary']))
                <div>
                    <label for="summary" class="block text-sm font-medium text-gray-700 mb-1">요약</label>
                    <textarea name="summary" id="summary" rows="3"
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                              placeholder="게시물 요약을 입력하세요 (목록에 표시됩니다)">{{ old('summary') }}</textarea>
                    @error('summary')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            {{-- 옵션 체크박스 --}}
            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-500">
                    <span class="text-sm text-gray-700">주요글</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published', '1') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">발행</span>
                </label>
            </div>

            {{-- 첨부파일 (has_attachments인 경우) --}}
            @if(!empty($boardConfig['has_attachments']))
                <div class="pt-2">
                    <label for="attachments" class="block text-sm font-medium text-gray-700 mb-1">첨부파일</label>
                    <input type="file" name="attachments[]" id="attachments" multiple
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="mt-1 text-xs text-gray-400">여러 파일을 선택할 수 있습니다.</p>
                    @error('attachments')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    @error('attachments.*')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif
        </div>

        {{-- 버튼 --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/posts/' . $boardType) }}"
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
