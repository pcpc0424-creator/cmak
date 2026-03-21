@extends('admin.layouts.app')

@section('title', '계정 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">계정 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $accounts->total() }}개의 계정</p>
    </div>

    {{-- 검색 & 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ url('/admin/accounts') }}" method="GET" class="flex items-center gap-2 flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="이름, 이메일 검색..."
                       class="flex-1 min-w-0 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    검색
                </button>
            </form>
            <a href="{{ url('/admin/accounts/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                계정 등록
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($accounts->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">이름</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">이메일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">역할</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">부서</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">활성</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">마지막로그인</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($accounts as $account)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $account->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $account->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $account->email }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($account->role === 'admin')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">관리자</span>
                                    @elseif($account->role === 'editor')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">편집자</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">뷰어</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $account->department ?? '-' }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($account->is_active)
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-400"></span>
                                    @else
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $account->last_login_at ? $account->last_login_at->format('Y-m-d H:i') : '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/accounts/' . $account->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/accounts/' . $account->id) }}"
                                              method="POST"
                                              onsubmit="return confirm('정말 삭제하시겠습니까? 이 작업은 되돌릴 수 없습니다.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100 transition">
                                                삭제
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 페이지네이션 --}}
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $accounts->withQueryString()->links() }}
            </div>
        @else
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 계정이 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 계정을 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/accounts/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        계정 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
