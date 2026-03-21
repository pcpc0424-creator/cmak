@extends('admin.layouts.app')

@section('title', '회원사 수정')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">회원사 수정</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $memberCompany->company_name }} 정보를 수정합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/member-companies/' . $memberCompany->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 2열 그리드 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- 회사명 --}}
                <div>
                    <label for="company_name" class="block text-sm font-medium text-gray-700 mb-1">회사명 <span class="text-red-500">*</span></label>
                    <input type="text" name="company_name" id="company_name" value="{{ old('company_name', $memberCompany->company_name) }}" required
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
                        @foreach(['서울', '경기', '부산', '대전', '대구', '광주', '기타'] as $region)
                            <option value="{{ $region }}" {{ old('region', $memberCompany->region) == $region ? 'selected' : '' }}>{{ $region }}</option>
                        @endforeach
                    </select>
                    @error('region')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 업종 --}}
                <div>
                    <label for="business_type" class="block text-sm font-medium text-gray-700 mb-1">업종</label>
                    <input type="text" name="business_type" id="business_type" value="{{ old('business_type', $memberCompany->business_type) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="업종을 입력하세요">
                    @error('business_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 대표자 --}}
                <div>
                    <label for="representative" class="block text-sm font-medium text-gray-700 mb-1">대표자</label>
                    <input type="text" name="representative" id="representative" value="{{ old('representative', $memberCompany->representative) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="대표자명을 입력하세요">
                    @error('representative')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 전화번호 --}}
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">전화번호</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone', $memberCompany->phone) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="02-0000-0000">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 팩스 --}}
                <div>
                    <label for="fax" class="block text-sm font-medium text-gray-700 mb-1">팩스</label>
                    <input type="text" name="fax" id="fax" value="{{ old('fax', $memberCompany->fax) }}"
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
                <input type="text" name="address" id="address" value="{{ old('address', $memberCompany->address) }}"
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
                    <input type="url" name="website" id="website" value="{{ old('website', $memberCompany->website) }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="https://example.com">
                    @error('website')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- 로고 --}}
                <div>
                    <label for="logo" class="block text-sm font-medium text-gray-700 mb-1">로고</label>
                    @if($memberCompany->logo)
                        <div class="mb-2 flex items-center gap-3">
                            <img src="/cmak/{{ $memberCompany->logo }}" alt="현재 로고"
                                 class="h-12 w-auto object-contain border border-gray-200 rounded p-1 bg-white">
                            <span class="text-xs text-gray-500">현재 로고</span>
                        </div>
                    @endif
                    <input type="file" name="logo" id="logo" accept="image/*"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                    <p class="mt-1 text-xs text-gray-400">JPG, PNG, GIF 형식 (최대 2MB). 새 파일 업로드 시 기존 로고가 교체됩니다.</p>
                    @error('logo')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 체크박스 & 정렬순서 --}}
            <div class="flex flex-wrap items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_verified" value="1"
                           {{ old('is_verified', $memberCompany->is_verified) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-green-600 shadow-sm focus:ring-green-500">
                    <span class="text-sm text-gray-700">인증여부</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_integrated" value="1"
                           {{ old('is_integrated', $memberCompany->is_integrated) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">
                    <span class="text-sm text-gray-700">통합회원</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $memberCompany->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">활성</span>
                </label>
                <div class="flex items-center gap-2">
                    <label for="sort_order" class="text-sm text-gray-700">정렬순서</label>
                    <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', $memberCompany->sort_order) }}"
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
