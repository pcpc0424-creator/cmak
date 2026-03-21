@extends('admin.layouts.app')

@section('title', $application->course_name . ' 접수현황')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <div class="flex items-center gap-2 text-sm text-gray-500 mb-2">
            <a href="{{ url('/admin/online-applications') }}" class="hover:text-blue-600 transition">온라인접수 관리</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
            <span>접수현황</span>
        </div>
        <h1 class="text-2xl font-bold text-gray-900">{{ $application->course_name }} 접수현황</h1>
        <p class="mt-1 text-sm text-gray-500">
            정원 {{ $application->max_participants }}명 / 접수 {{ $entries->total() }}명
            @if($application->status === 'open')
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 ml-2">접수중</span>
            @elseif($application->status === 'closed')
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 ml-2">마감</span>
            @else
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 ml-2">완료</span>
            @endif
        </p>
    </div>

    {{-- 접수 추가 폼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6" x-data="{ showForm: false }">
        <div class="flex items-center justify-between">
            <h3 class="text-sm font-medium text-gray-700">접수 추가</h3>
            <button @click="showForm = !showForm" type="button"
                    class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                접수 추가
            </button>
        </div>
        <form action="{{ url('/admin/online-applications/' . $application->id . '/entries') }}" method="POST"
              x-show="showForm" x-cloak
              x-transition:enter="transition ease-out duration-200"
              x-transition:enter-start="opacity-0 -translate-y-2"
              x-transition:enter-end="opacity-100 translate-y-0"
              class="mt-4 pt-4 border-t border-gray-200">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <div>
                    <label for="entry_name" class="block text-xs font-medium text-gray-600 mb-1">이름 <span class="text-red-500">*</span></label>
                    <input type="text" name="name" id="entry_name" required
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="이름">
                </div>
                <div>
                    <label for="entry_organization" class="block text-xs font-medium text-gray-600 mb-1">소속</label>
                    <input type="text" name="organization" id="entry_organization"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="소속">
                </div>
                <div>
                    <label for="entry_phone" class="block text-xs font-medium text-gray-600 mb-1">전화번호</label>
                    <input type="tel" name="phone" id="entry_phone"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="010-0000-0000">
                </div>
                <div>
                    <label for="entry_email" class="block text-xs font-medium text-gray-600 mb-1">이메일</label>
                    <input type="email" name="email" id="entry_email"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="email@example.com">
                </div>
                <div>
                    <label for="entry_note" class="block text-xs font-medium text-gray-600 mb-1">비고</label>
                    <input type="text" name="note" id="entry_note"
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                           placeholder="비고">
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    등록
                </button>
            </div>
        </form>
    </div>

    {{-- 접수 목록 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($entries->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-28">이름</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">소속</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-32">전화번호</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">이메일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">상태</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">비고</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">접수일</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($entries as $entry)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $entry->id }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $entry->name }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $entry->organization ?? '-' }}</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $entry->phone ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $entry->email ?? '-' }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($entry->status === 'confirmed')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">확정</span>
                                    @elseif($entry->status === 'cancelled')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">취소</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">대기</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">{{ $entry->note ?? '-' }}</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $entry->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- 페이지네이션 --}}
            <div class="px-4 py-3 border-t border-gray-200">
                {{ $entries->withQueryString()->links() }}
            </div>
        @else
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">접수자가 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">위의 접수 추가 버튼을 눌러 접수자를 등록하세요.</p>
            </div>
        @endif
    </div>
</div>
@endsection
