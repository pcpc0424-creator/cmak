@extends('admin.layouts.app')

@section('title', '협회업무 페이지 수정')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">{{ $page->page_title }} 수정</h1>
            <p class="mt-1 text-sm text-gray-500 font-mono">/business/{{ $page->slug }}</p>
        </div>
        <a href="{{ url('/cmak/business/' . $page->slug) }}" target="_blank"
           class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
            새 창에서 보기 →
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded text-red-800 text-sm">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    <form action="{{ url('/admin/page-contents/' . $page->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            {{-- 제목 --}}
            <div>
                <label for="page_title" class="block text-sm font-medium text-gray-700 mb-1">페이지 제목</label>
                <input type="text" name="page_title" id="page_title"
                       value="{{ old('page_title', $page->page_title) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm" required>
                <p class="mt-1 text-xs text-gray-400">화면 상단에 크게 표시되는 제목입니다.</p>
            </div>

            {{-- 고급 설정 (메타) --}}
            <details class="border border-gray-200 rounded-md bg-gray-50">
                <summary class="cursor-pointer select-none px-4 py-3 text-sm font-medium text-gray-700">
                    고급 설정 <span class="text-xs text-gray-400 font-normal">(브라우저 제목 · 카테고리 · 노출 순서)</span>
                </summary>
                <div class="px-4 pb-4 pt-1 space-y-4 border-t border-gray-200">
                    {{-- 브라우저 탭 제목 --}}
                    <div>
                        <label for="browser_title" class="block text-sm font-medium text-gray-700 mb-1">브라우저 탭 제목</label>
                        <input type="text" name="browser_title" id="browser_title"
                               value="{{ old('browser_title', $page->browser_title) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <p class="mt-1 text-xs text-gray-400">브라우저 탭/검색결과에 표시되는 제목. 비워두면 페이지 제목이 사용됩니다.</p>
                    </div>

                    {{-- 상단 카테고리 라벨 --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-1">상단 카테고리 라벨</label>
                            <input type="text" name="category" id="category"
                                   value="{{ old('category', $page->category) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <p class="mt-1 text-xs text-gray-400">제목 위 작은 글씨. 비우면 '협회업무'.</p>
                        </div>
                        <div>
                            <label for="category_link" class="block text-sm font-medium text-gray-700 mb-1">카테고리 링크</label>
                            <input type="text" name="category_link" id="category_link"
                                   value="{{ old('category_link', $page->category_link) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm font-mono">
                            <p class="mt-1 text-xs text-gray-400">예: /cmak/business/membership</p>
                        </div>
                    </div>

                    {{-- 노출 순서 --}}
                    <div>
                        <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-1">노출 순서</label>
                        <input type="number" name="sort_order" id="sort_order" min="0"
                               value="{{ old('sort_order', $page->sort_order) }}"
                               class="w-32 px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-sm">
                        <p class="mt-1 text-xs text-gray-400">숫자가 작을수록 목록·사이드바에서 위에 표시됩니다.</p>
                    </div>
                </div>
            </details>

            {{-- 본문 --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">내용</label>
                <p class="mb-2 text-xs text-gray-500">
                    아래 편집기에서 글자, 이미지, 표 등을 워드처럼 자유롭게 수정할 수 있습니다.
                    이미지는 드래그하거나 <strong>이미지</strong> 버튼으로 넣을 수 있습니다.
                </p>
                <textarea name="content" id="content" rows="20"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm">{{ old('content', $page->content) }}</textarea>
            </div>

            {{-- 게시 여부 --}}
            <div class="flex items-center">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       {{ old('is_published', $page->is_published) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <label for="is_published" class="ml-2 text-sm text-gray-700">이 페이지를 사이트에 게시</label>
                <span class="ml-2 text-xs text-gray-400">(체크 해제 시 방문자에게는 이전 기본 내용이 보입니다)</span>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-between">
            <a href="{{ url('/admin/page-contents') }}" class="text-sm text-gray-500 hover:text-gray-700">← 목록으로</a>
            <button type="submit"
                    class="inline-flex items-center px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 shadow">
                저장하기
            </button>
        </div>
    </form>
</div>

@include('admin.partials.tinymce-editor')
@endsection
