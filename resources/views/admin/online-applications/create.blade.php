@extends('admin.layouts.app')

@section('title', '과정 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">과정 등록</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 교육 과정을 등록합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/online-applications') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 과정명 --}}
            <div>
                <label for="course_name" class="block text-sm font-medium text-gray-700 mb-1">과정명 <span class="text-red-500">*</span></label>
                <input type="text" name="course_name" id="course_name" value="{{ old('course_name') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="과정명을 입력하세요">
                @error('course_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 접수일 --}}
            <div>
                <label for="registration_date" class="block text-sm font-medium text-gray-700 mb-1">접수일</label>
                <input type="date" name="registration_date" id="registration_date" value="{{ old('registration_date') }}"
                       class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                @error('registration_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 교육기간 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="education_start" class="block text-sm font-medium text-gray-700 mb-1">교육시작일</label>
                    <input type="date" name="education_start" id="education_start" value="{{ old('education_start') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('education_start')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="education_end" class="block text-sm font-medium text-gray-700 mb-1">교육종료일</label>
                    <input type="date" name="education_end" id="education_end" value="{{ old('education_end') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    @error('education_end')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 교육시간 & 수강료 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="education_hours" class="block text-sm font-medium text-gray-700 mb-1">교육시간</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="education_hours" id="education_hours" value="{{ old('education_hours') }}" min="0"
                               class="w-32 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <span class="text-sm text-gray-500">시간</span>
                    </div>
                    @error('education_hours')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="fee" class="block text-sm font-medium text-gray-700 mb-1">수강료</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="fee" id="fee" value="{{ old('fee') }}" min="0"
                               class="w-40 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <span class="text-sm text-gray-500">원</span>
                    </div>
                    @error('fee')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 상태 & 정원 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">상태</label>
                    <select name="status" id="status"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="open" {{ old('status') === 'open' ? 'selected' : '' }}>접수중</option>
                        <option value="closed" {{ old('status') === 'closed' ? 'selected' : '' }}>마감</option>
                        <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>완료</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">정원</label>
                    <div class="flex items-center gap-2">
                        <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants') }}" min="0"
                               class="w-32 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <span class="text-sm text-gray-500">명</span>
                    </div>
                    @error('max_participants')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 설명 --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">설명</label>
                <textarea name="description" id="description" rows="5"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                          placeholder="과정에 대한 설명을 입력하세요">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- 버튼 --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/online-applications') }}"
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
