@extends('admin.layouts.app')

@section('title', ($boardConfig['name'] ?? '게시판') . ' 수정')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $boardConfig['name'] ?? '게시판' }} 수정</h1>
        <p class="mt-1 text-sm text-gray-500">게시물 #{{ $post->id }}을 수정합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/posts/' . $boardType . '/' . $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 제목 --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="제목을 입력하세요">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 작성자 --}}
            <div>
                <label for="author" class="block text-sm font-medium text-gray-700 mb-1">작성자 <span class="text-red-500">*</span></label>
                <input type="text" name="author" id="author" value="{{ old('author', $post->author) }}" required
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
                    <input type="text" name="issue_number" id="issue_number" value="{{ old('issue_number', $post->issue_number) }}"
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
                          placeholder="내용을 입력하세요">{{ old('content', $post->content) }}</textarea>
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
                              placeholder="게시물 요약을 입력하세요 (목록에 표시됩니다)">{{ old('summary', $post->summary) }}</textarea>
                    @error('summary')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            {{-- 조회수 (읽기 전용) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">조회수</label>
                <div class="px-3 py-2 bg-gray-50 rounded-md border border-gray-200 text-sm text-gray-600 w-32">
                    {{ number_format($post->view_count ?? 0) }}
                </div>
            </div>

            {{-- 옵션 체크박스 --}}
            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1"
                           {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-yellow-500 shadow-sm focus:ring-yellow-500">
                    <span class="text-sm text-gray-700">주요글</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_published" value="1"
                           {{ old('is_published', $post->is_published) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">발행</span>
                </label>
            </div>

            {{-- 기존 첨부파일 목록 (has_attachments인 경우) --}}
            @if(!empty($boardConfig['has_attachments']))
                @if($post->attachments && $post->attachments->count() > 0)
                    <div class="pt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">기존 첨부파일</label>
                        <div class="space-y-2">
                            @foreach($post->attachments as $attachment)
                                <div class="flex items-center justify-between bg-gray-50 rounded-md px-3 py-2 border border-gray-200">
                                    <div class="flex items-center gap-2 text-sm text-gray-700">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                        </svg>
                                        <span>{{ $attachment->file_name }}</span>
                                        @if($attachment->file_size)
                                            <span class="text-xs text-gray-400">({{ number_format($attachment->file_size / 1024, 1) }} KB)</span>
                                        @endif
                                    </div>
                                    <form action="{{ url('/admin/posts/' . $boardType . '/' . $post->id . '/attachments/' . $attachment->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('이 첨부파일을 삭제하시겠습니까?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-500 hover:text-red-700 text-xs font-medium transition">
                                            삭제
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- 새 첨부파일 업로드 --}}
                <div class="pt-2">
                    <label for="attachments" class="block text-sm font-medium text-gray-700 mb-1">새 첨부파일 추가</label>
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
