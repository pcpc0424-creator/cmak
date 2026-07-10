@extends('admin.layouts.app')

@section('title', 'ConsMa 포스터 수정')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">ConsMa 포스터 수정 — {{ $consmaEdition->year }}</h1>

    <form action="{{ url('/admin/consma-editions/' . $consmaEdition->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">연도 <span class="text-red-500">*</span></label>
                <input type="text" name="year" value="{{ old('year', $consmaEdition->year) }}" required
                       class="w-40 rounded-md border-gray-300 shadow-sm text-sm">
                @error('year')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">메인 텍스트</label>
                <input type="text" name="main_text" value="{{ old('main_text', $consmaEdition->main_text) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">보조 텍스트</label>
                <input type="text" name="sub_text" value="{{ old('sub_text', $consmaEdition->sub_text) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">현재 포스터</label>
                @if($consmaEdition->thumb_path)
                    <img src="/cmak/{{ ltrim($consmaEdition->thumb_path, '/') }}" alt="{{ $consmaEdition->year }}" style="width:120px; border-radius:6px; border:1px solid #e5e7eb;">
                @endif
                <label class="block text-sm font-medium text-gray-700 mt-3 mb-1">포스터 교체 (선택)</label>
                <input type="file" name="poster" accept="image/*"
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:bg-blue-50 file:text-blue-700">
                <p class="mt-1 text-xs text-gray-400">새 이미지를 올리면 썸네일·상세 이미지가 자동 재생성됩니다.</p>
                @error('poster')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">자세히 보기 링크 (선택)</label>
                <input type="text" name="detail_url" value="{{ old('detail_url', $consmaEdition->detail_url) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">상세 본문 (선택)</label>
                <textarea name="detail_content" rows="4" class="w-full rounded-md border-gray-300 shadow-sm text-sm">{{ old('detail_content', $consmaEdition->detail_content) }}</textarea>
            </div>
            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $consmaEdition->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600">
                    <span class="text-sm text-gray-700">노출</span>
                </label>
                <div class="flex items-center gap-2">
                    <label class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $consmaEdition->sort_order) }}" min="0"
                           class="w-20 rounded-md border-gray-300 shadow-sm text-sm text-center">
                </div>
            </div>
        </div>
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ url('/admin/consma-editions') }}" class="px-4 py-2 bg-white border border-gray-300 text-sm text-gray-700 rounded-md hover:bg-gray-50">목록으로</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">저장</button>
        </div>
    </form>
</div>
@endsection
