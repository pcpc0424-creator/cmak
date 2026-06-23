@extends('admin.layouts.app')

@section('title', '회원 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6 flex items-start justify-between gap-3 flex-wrap">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">회원 관리 (개인회원)</h1>
            <p class="mt-1 text-sm text-gray-500">총 {{ $members->total() }}명 · 가입승인/등급 변경은 관리자 전용</p>
        </div>
        <a href="{{ url('/admin/members/export') }}?{{ http_build_query(request()->only(['q','grade','status'])) }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition">
            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
            </svg>
            회원현황 엑셀 다운로드
        </a>
    </div>

    {{-- 가입상태 탭 --}}
    @php
        $curStatus = request('status', '');
        $tabBase = 'inline-flex items-center px-3.5 py-1.5 rounded-full text-sm font-medium transition';
    @endphp
    <div class="flex flex-wrap gap-2 mb-4">
        <a href="{{ url('/admin/members') }}?{{ http_build_query(array_merge(request()->only(['q','grade']), ['status'=>''])) }}"
           class="{{ $tabBase }} {{ $curStatus==='' ? 'bg-gray-800 text-white' : 'bg-white text-gray-600 border border-gray-300 hover:bg-gray-50' }}">전체</a>
        <a href="{{ url('/admin/members') }}?{{ http_build_query(array_merge(request()->only(['q','grade']), ['status'=>'pending'])) }}"
           class="{{ $tabBase }} {{ $curStatus==='pending' ? 'bg-amber-500 text-white' : 'bg-white text-amber-700 border border-amber-300 hover:bg-amber-50' }}">승인대기 <span class="ml-1 font-bold">{{ $statusCounts['pending'] }}</span></a>
        <a href="{{ url('/admin/members') }}?{{ http_build_query(array_merge(request()->only(['q','grade']), ['status'=>'approved'])) }}"
           class="{{ $tabBase }} {{ $curStatus==='approved' ? 'bg-green-600 text-white' : 'bg-white text-green-700 border border-green-300 hover:bg-green-50' }}">승인 <span class="ml-1 font-bold">{{ $statusCounts['approved'] }}</span></a>
        <a href="{{ url('/admin/members') }}?{{ http_build_query(array_merge(request()->only(['q','grade']), ['status'=>'rejected'])) }}"
           class="{{ $tabBase }} {{ $curStatus==='rejected' ? 'bg-rose-600 text-white' : 'bg-white text-rose-700 border border-rose-300 hover:bg-rose-50' }}">반려 <span class="ml-1 font-bold">{{ $statusCounts['rejected'] }}</span></a>
    </div>

    @if (session('success'))
        <div class="mb-4 px-4 py-3 bg-green-50 border border-green-200 text-green-700 text-sm rounded-md">{{ session('success') }}</div>
    @endif

    {{-- 검색 & 필터 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form action="{{ url('/admin/members') }}" method="GET" class="flex flex-col sm:flex-row items-center gap-2">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="이름, 아이디, 이메일 검색..."
                   class="flex-1 min-w-0 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
            <select name="grade"
                    class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                    onchange="this.form.submit()">
                <option value="">전체 등급</option>
                @foreach($grades as $key => $label)
                    <option value="{{ $key }}" {{ request('grade') == $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                검색
            </button>
        </form>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($members->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">이름</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-32">아이디</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">이메일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">등급</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">가입상태</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">활성</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">가입일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($members as $member)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $member->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $member->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $member->username }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $member->email }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($member->grade === 'regular')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">{{ $member->gradeLabel() }}</span>
                                    @elseif($member->grade === 'internet')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800">{{ $member->gradeLabel() }}</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">{{ $member->gradeLabel() }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($member->approval_status === 'approved')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">승인</span>
                                    @elseif($member->approval_status === 'rejected')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-100 text-rose-800">반려</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">승인대기</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($member->is_active)
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-400"></span>
                                    @else
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $member->created_at ? $member->created_at->format('Y-m-d H:i') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-1.5 flex-wrap">
                                        @if($member->approval_status !== 'approved')
                                            <form action="{{ url('/admin/members/' . $member->id . '/approve') }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-white bg-green-600 rounded hover:bg-green-700 transition">승인</button>
                                            </form>
                                        @endif
                                        @if($member->approval_status === 'pending')
                                            <form action="{{ url('/admin/members/' . $member->id . '/reject') }}" method="POST" class="inline" onsubmit="return confirm('이 회원의 가입을 반려하시겠습니까?');">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-rose-700 bg-rose-50 rounded hover:bg-rose-100 transition">반려</button>
                                            </form>
                                        @endif
                                        <a href="{{ url('/admin/members/' . $member->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            관리
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 페이지네이션 --}}
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $members->withQueryString()->links() }}
            </div>
        @else
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">가입한 회원이 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">회원가입이 이루어지면 여기에 표시됩니다.</p>
            </div>
        @endif
    </div>
</div>
@endsection
