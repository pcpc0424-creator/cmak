@extends('admin.layouts.app')

@section('title', '온라인접수 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">온라인접수 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $applications->total() }}건의 과정</p>
    </div>

    {{-- 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex items-center justify-end">
            <a href="{{ url('/admin/online-applications/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                과정 등록
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($applications->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">과정명</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">접수일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">교육기간</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">교육시간</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">수강료</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">상태</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">정원</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">접수현황</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($applications as $application)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $applications->total() - ($applications->firstItem() - 1) - $loop->index }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $application->course_name }}</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $application->registration_date }}</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $application->education_start }} ~ {{ $application->education_end }}
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $application->education_hours }}시간</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ number_format($application->fee ?? 0) }}원</td>
                                <td class="px-4 py-3 text-center">
                                    @if($application->status === 'open')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">접수중</span>
                                    @elseif($application->status === 'closed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">마감</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">완료</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $application->max_participants }}명</td>
                                <td class="px-4 py-3 text-center">
                                    <a href="{{ url('/admin/online-applications/' . $application->id . '/entries') }}"
                                       class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-indigo-700 bg-indigo-50 rounded hover:bg-indigo-100 transition">
                                        {{ $application->entries_count ?? 0 }}명
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/online-applications/' . $application->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/online-applications/' . $application->id) }}"
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
                {{ $applications->withQueryString()->links() }}
            </div>
        @else
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 과정이 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 과정을 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/online-applications/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        과정 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
