@extends('admin.layouts.app')

@section('title', '회원사 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">회원사 관리</h1>
        <p class="mt-1 text-sm text-gray-500">
            현재 조건 {{ $memberCompanies->total() }}개 ·
            <span class="text-blue-600">노출(회비납부) {{ $counts['active'] }}</span> /
            비노출 {{ $counts['inactive'] }} / 전체 {{ $counts['all'] }}
        </p>
    </div>

    {{-- 검색 & 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ url('/admin/member-companies') }}" method="GET" class="flex items-center gap-2 flex-1 flex-wrap">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="회사명 검색..."
                       class="flex-1 min-w-0 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                <select name="company_type"
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">구분 전체</option>
                    <option value="용역" {{ request('company_type') == '용역' ? 'selected' : '' }}>용역</option>
                    <option value="시공" {{ request('company_type') == '시공' ? 'selected' : '' }}>시공</option>
                </select>
                <select name="status"
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="active" {{ $status == 'active' ? 'selected' : '' }}>노출(회비납부)</option>
                    <option value="inactive" {{ $status == 'inactive' ? 'selected' : '' }}>비노출</option>
                    <option value="all" {{ $status == 'all' ? 'selected' : '' }}>전체</option>
                </select>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    검색
                </button>
            </form>
            <div class="flex items-center gap-2 whitespace-nowrap">
                <a href="{{ url('/admin/member-companies/export') }}?{{ http_build_query(request()->only(['search','company_type','region','status'])) }}"
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700 transition">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                    엑셀 다운로드
                </a>
                <a href="{{ url('/admin/member-companies/create') }}"
                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    회원사 등록
                </a>
            </div>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($memberCompanies->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">회사명</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">지역</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">대표자</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">전화번호</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">인증여부</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">활성</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($memberCompanies as $index => $company)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $memberCompanies->total() - ($memberCompanies->firstItem() - 1) - $index }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ url('/admin/member-companies/' . $company->id . '/edit') }}"
                                       class="text-gray-900 hover:text-blue-600 transition font-medium">
                                        {{ $company->company_name }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $company->region ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $company->representative ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $company->phone ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ url('/admin/member-companies/' . $company->id . '/toggle-verify') }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition cursor-pointer
                                            {{ $company->is_verified ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                            {{ $company->is_verified ? '인증' : '미인증' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ url('/admin/member-companies/' . $company->id . '/toggle-active') }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition cursor-pointer
                                            {{ $company->is_active ? 'bg-blue-100 text-blue-800 hover:bg-blue-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                            {{ $company->is_active ? '활성' : '비활성' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/member-companies/' . $company->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/member-companies/' . $company->id) }}"
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
                {{ $memberCompanies->withQueryString()->links() }}
            </div>
        @else
            {{-- 빈 상태 --}}
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 회원사가 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 회원사를 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/member-companies/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        회원사 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
