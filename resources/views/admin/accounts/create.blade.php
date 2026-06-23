@extends('admin.layouts.app')

@section('title', '계정 등록')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">계정 등록</h1>
        <p class="mt-1 text-sm text-gray-500">새로운 관리자 계정을 등록합니다.</p>
    </div>

    {{-- 폼 --}}
    <form action="{{ url('/admin/accounts') }}" method="POST">
        @csrf

        <div class="bg-white rounded-lg shadow p-6 space-y-6">

            {{-- 이름 --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">이름 <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                       class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="이름을 입력하세요">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 이메일 --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">이메일 <span class="text-red-500">*</span></label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                       placeholder="email@example.com">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- 비밀번호 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">비밀번호 <span class="text-red-500">*</span></label>
                    <input type="password" name="password" id="password" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="비밀번호를 입력하세요">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">비밀번호 확인</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="비밀번호를 다시 입력하세요">
                </div>
            </div>

            {{-- 역할 & 권한 --}}
            @php $curPerms = old('permissions', []); @endphp
            <div x-data="{ role: '{{ old('role', 'editor') }}' }">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">역할</label>
                <select name="role" id="role" x-model="role"
                        class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="admin">관리자 (전체 권한)</option>
                    <option value="editor">편집자 (선택 권한)</option>
                    <option value="user">뷰어 (관리자 접근 불가)</option>
                </select>
                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror

                {{-- 권한 (편집자일 때만) --}}
                <div x-show="role === 'editor'" x-cloak class="mt-4 p-4 bg-gray-50 border border-gray-200 rounded-md">
                    <p class="text-sm font-medium text-gray-700 mb-3">접근 허용 메뉴 <span class="text-gray-400 font-normal">(편집자에게만 적용 · 관리자는 전체 허용)</span></p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        @foreach(\App\Models\User::PERMISSIONS as $key => $label)
                            <label class="flex items-start gap-2 text-sm text-gray-700">
                                <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                       {{ in_array($key, $curPerms, true) ? 'checked' : '' }}
                                       class="mt-0.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span>{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- 부서 & 직위 --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">부서</label>
                    <input type="text" name="department" id="department" value="{{ old('department') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="부서명">
                    @error('department')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-1">직위</label>
                    <input type="text" name="position" id="position" value="{{ old('position') }}"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="직위">
                    @error('position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- 활성 --}}
            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">활성</span>
                </label>
            </div>
        </div>

        {{-- 버튼 --}}
        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/accounts') }}"
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
