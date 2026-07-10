@extends('admin.layouts.app')

@section('title', '히어로 슬라이드 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">히어로 슬라이드 등록</h1>
        <p class="mt-1 text-sm text-gray-500">메인 상단 큰 배경 슬라이드를 추가합니다.</p>
    </div>

    <form action="{{ url('/admin/hero-slides') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            {{-- 라벨(eyebrow) --}}
            <div>
                <label for="eyebrow" class="block text-sm font-medium text-gray-700 mb-1">상단 라벨</label>
                <input type="text" name="eyebrow" id="eyebrow" value="{{ old('eyebrow') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="예: CMAK · Since 1996">
                @error('eyebrow')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                <label class="mt-2 flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="show_eyebrow" value="1" {{ old('show_eyebrow', '1') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">상단 라벨 표시 (해제 시 라벨 숨김)</span>
                </label>
            </div>

            {{-- 제목 --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">제목 (첫 줄)</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="예: 대한민국 건설사업관리의">
                @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                <label class="mt-2 flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="title_bold" value="1" {{ old('title_bold') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">제목(첫 줄) 굵게(볼드) 표시</span>
                </label>
            </div>

            {{-- 강조 문구 --}}
            <div>
                <label for="highlight" class="block text-sm font-medium text-gray-700 mb-1">강조 문구 (둘째 줄)</label>
                <input type="text" name="highlight" id="highlight" value="{{ old('highlight') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="예: 미래를 선도합니다">
                @error('highlight')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                <label class="mt-2 flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="highlight_bold" value="1" {{ old('highlight_bold', '1') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">강조 문구(둘째 줄) 굵게(볼드) 표시</span>
                </label>
            </div>

            {{-- 배경 이미지 --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">배경 이미지 <span class="text-red-500">*</span></label>
                <input type="file" name="image" id="image" accept="image/*" required
                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                <p class="mt-1 text-xs text-gray-400">권장 사이즈: 가로 1920px 이상 (예: 1920x1080). JPG, PNG</p>
                @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            {{-- 활성 & 정렬순서 --}}
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">노출</span>
                </label>
                <div class="flex items-center gap-2">
                    <label for="sort_order" class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order') }}"
                           class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-center" min="0"
                           placeholder="자동">
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/hero-slides') }}"
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">목록으로</a>
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                저장
            </button>
        </div>
    </form>
</div>
@endsection
