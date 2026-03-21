@extends('admin.layouts.app')

@section('title', '회원사 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">회원사 등록</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 회원사를 등록합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/member-companies') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 2열 그리드 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- 회사명 --}}
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">회사명 <span class="text-red-500">*</span></label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name') }}" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="회사명을 입력하세요">
                    @error('company_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 지역 --}}
                <div>
                    <label for="region" class="block text-sm font-medium text-gray-700 mb-1">지역</label>
                    <select name="region" id="region"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        <option value="">선택하세요</option>
                        <option value="서울" {{ old('region') == '서울' ? 'selected' : '' }}>서울</option>
                        <option value="경기" {{ old('region') == '경기' ? 'selected' : '' }}>경기</option>
                        <option value="부산" {{ old('region') == '부산' ? 'selected' : '' }}>부산</option>
                        <option value="대전" {{ old('region') == '대전' ? 'selected' : '' }}>대전</option>
                        <option value="대구" {{ old('region') == '대구' ? 'selected' : '' }}>대구</option>
                        <option value="광주" {{ old('region') == '광주' ? 'selected' : '' }}>광주</option>
                        <option value="기타" {{ old('region') == '기타' ? 'selected' : '' }}>기타</option>
                    </select>
                    @error('region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 업종 --}}
                <div>
                    <label for="business_type" class="block text-sm font-medium text-gray-700 mb-1">업종</label>
                    <input type="text" name="business_type" id="business_type" value="{{ old('business_type') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="업종을 입력하세요">
                    @error('business_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 대표자 --}}
                <div>
                    <label for="representative" class="block text-sm font-medium text-gray-700 mb-1">대표자</label>
                    <input type="text" name="representative" id="representative" value="{{ old('representative') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="대표자명을 입력하세요">
                    @error('representative')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 전화번호 --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">전화번호</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="02-0000-0000">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 팩스 --}}
                <div>
                    <label for="fax" class="block text-sm font-medium text-gray-700 mb-1">팩스</label>
                    <input type="text" name="fax" id="fax" value="{{ old('fax') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="02-0000-0000">
                    @error('fax')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 주소 (전체 너비) --}}
            <div>
                <label for="address" class="block text-sm font-medium text-gray-700 mb-1">주소</label>
                <input type="text" name="address" id="address" value="{{ old('address') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="주소를 입력하세요">
                @error('address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 2열 그리드 (하단) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- 웹사이트 --}}
                <div>
                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1">웹사이트</label>
                    <input type="url" name="website" id="website" value="{{ old('website') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="https://example.com">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 로고 --}}
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">로고</label>
                    <input type="file" name="logo" id="logo" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="mt-1 text-xs text-gray-400">JPG, PNG, GIF 형식 (최대 2MB)</p>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 체크박스 & 정렬순서 --}}
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_verified" value="1" {{ old('is_verified') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                    <span class="text-sm text-gray-700">인증여부</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_integrated" value="1" {{ old('is_integrated') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">
                    <span class="text-sm text-gray-700">통합회원</span>
                </label>
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
            <a href="{{ url('/admin/member-companies') }}"
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
