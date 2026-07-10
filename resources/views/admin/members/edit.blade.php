@extends('admin.layouts.app')

@section('title', '회원 등급/상태 관리')

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">회원 등급/상태 관리</h1>
        <p class="mt-1 text-sm text-gray-500">{{ $member->name }} ({{ $member->username }})</p>
    </div>

    @unless(auth()->user()->isAdmin())
        <div class="mb-4 rounded-md bg-yellow-50 border border-yellow-200 px-4 py-3 text-sm text-yellow-800">
            회원 등급 변경은 관리자(admin) 권한만 가능합니다. 현재 계정은 조회만 가능합니다.
        </div>
    @endunless

    <form action="{{ url('/admin/members/' . $member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="bg-white rounded-lg shadow p-6 space-y-6">
            {{-- 기본 정보 (읽기 전용) --}}
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div><span class="text-gray-500">이름</span><div class="font-medium text-gray-900">{{ $member->name }}</div></div>
                <div><span class="text-gray-500">아이디</span><div class="font-medium text-gray-900">{{ $member->username }}</div></div>
                <div><span class="text-gray-500">이메일</span><div class="font-medium text-gray-900">{{ $member->email }}</div></div>
                <div><span class="text-gray-500">휴대폰</span><div class="font-medium text-gray-900">{{ $member->phone_mobile ?: '-' }}</div></div>
                <div><span class="text-gray-500">전화(회사)</span><div class="font-medium text-gray-900">{{ $member->phone_company ?: '-' }}</div></div>
                <div><span class="text-gray-500">가입일</span><div class="font-medium text-gray-900">{{ $member->created_at?->format('Y-m-d H:i') }}</div></div>
            </div>

            <hr>

            {{-- 소속 정보 (읽기 전용) --}}
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500">소속 (업체/기관)</span>
                    <div class="font-medium text-gray-900">
                        {{ $member->company_name ?: '-' }}
                        @if($member->is_member_company)
                            <span class="ml-1 inline-block px-1.5 py-0.5 text-xs bg-blue-50 text-blue-700 rounded">회원사 소속</span>
                        @endif
                    </div>
                </div>
                <div><span class="text-gray-500">부서 / 직위</span><div class="font-medium text-gray-900">{{ $member->department ?: '-' }} / {{ $member->position ?: '-' }}</div></div>
                <div class="col-span-2">
                    <span class="text-gray-500">수신 동의</span>
                    <div class="font-medium text-gray-900 flex flex-wrap gap-x-4 gap-y-1 mt-0.5">
                        <span>이메일: <b class="{{ $member->email_agree ? 'text-green-600' : 'text-gray-400' }}">{{ $member->email_agree ? '동의' : '미동의' }}</b></span>
                        <span>SMS: <b class="{{ $member->sms_agree ? 'text-green-600' : 'text-gray-400' }}">{{ $member->sms_agree ? '동의' : '미동의' }}</b></span>
                        <span>광고성정보: <b class="{{ $member->ad_agree ? 'text-green-600' : 'text-gray-400' }}">{{ $member->ad_agree ? '동의' : '미동의' }}</b></span>
                    </div>
                </div>
            </div>

            <hr>

            {{-- 등급 --}}
            <div>
                <label for="grade" class="block text-sm font-medium text-gray-700 mb-1">회원 등급</label>
                <select name="grade" id="grade" {{ auth()->user()->isAdmin() ? '' : 'disabled' }}
                        class="w-full sm:w-1/2 rounded-md border-gray-300 shadow-sm text-sm">
                    @foreach($grades as $key => $label)
                        <option value="{{ $key }}" {{ $member->grade == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- 상태 --}}
            <div>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $member->is_active ? 'checked' : '' }}
                           {{ auth()->user()->isAdmin() ? '' : 'disabled' }}
                           class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                    <span class="text-sm text-gray-700">활성 계정 (체크 해제 시 로그인 정지)</span>
                </label>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-3">
            <a href="{{ url('/admin/members') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">목록으로</a>
            @if(auth()->user()->isAdmin())
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">저장</button>
            @endif
        </div>
    </form>
</div>
@endsection
