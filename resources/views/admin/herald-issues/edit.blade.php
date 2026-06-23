@extends('admin.layouts.app')

@section('title', 'CM Herald 호 수정')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">CM Herald 호 수정</h1>
    </div>

    <form action="{{ url('/admin/herald-issues/' . $heraldIssue->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">제목(호수) <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title', $heraldIssue->title) }}" required class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">발행일</label>
                    <input type="date" name="issue_date" value="{{ old('issue_date', optional($heraldIssue->issue_date)->format('Y-m-d')) }}" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">정렬순서</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $heraldIssue->sort_order) }}" min="0" class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                </div>
            </div>

            @if($heraldIssue->cover_image)
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">현재 표지</label>
                @if(file_exists(public_path($heraldIssue->cover_image)))
                    <img src="/cmak/{{ $heraldIssue->cover_image }}" alt="{{ $heraldIssue->title }}" class="h-40 rounded-md border border-gray-200">
                @else
                    <p class="text-xs text-red-500">파일 없음: {{ $heraldIssue->cover_image }}</p>
                @endif
            </div>
            @endif

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">표지 이미지 {{ $heraldIssue->cover_image ? '교체' : '등록' }}</label>
                <input type="file" name="cover" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">비워두면 기존 표지 유지.</p>
                @error('cover')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="border-t pt-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">웹진보기 — 링크 URL</label>
                <input type="text" name="webzine_url" value="{{ old('webzine_url', $heraldIssue->webzine_url) }}" placeholder="https://... 또는 PDF 업로드"
                       class="w-full rounded-md border-gray-300 shadow-sm text-sm">
                @if($heraldIssue->webzine_url)
                    <p class="mt-1 text-xs text-gray-500">현재: {{ $heraldIssue->webzine_url }}</p>
                @endif
                @error('webzine_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror

                <label class="block text-sm font-medium text-gray-700 mb-1 mt-4">웹진보기 — PDF 업로드 (선택)</label>
                <input type="file" name="webzine_file" accept="application/pdf"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">새 PDF를 올리면 위 URL 대신 이 PDF로 연결됩니다.</p>
                @error('webzine_file')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">설명 (선택)</label>
                <textarea name="description" rows="3" class="w-full rounded-md border-gray-300 shadow-sm text-sm">{{ old('description', $heraldIssue->description) }}</textarea>
            </div>

            <label class="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $heraldIssue->is_published) ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                <span class="text-sm text-gray-700">노출</span>
            </label>
        </div>

        <div class="mt-6 flex items-center justify-between gap-3">
            <button type="button" onclick="if(confirm('삭제하시겠습니까?')) document.getElementById('del-form').submit();"
                    class="inline-flex items-center px-4 py-2 bg-white border border-red-300 text-sm font-medium text-red-600 rounded-md hover:bg-red-50 transition">삭제</button>
            <div class="flex items-center gap-3">
                <a href="{{ url('/admin/herald-issues') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">목록으로</a>
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">수정 저장</button>
            </div>
        </div>
    </form>

    <form id="del-form" action="{{ url('/admin/herald-issues/' . $heraldIssue->id) }}" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</div>
@endsection
