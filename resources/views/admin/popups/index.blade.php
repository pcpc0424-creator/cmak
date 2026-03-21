@extends('admin.layouts.app')

@section('title', '팝업 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">팝업 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $popups->total() }}개의 팝업</p>
    </div>

    {{-- 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex items-center justify-end">
            <a href="{{ url('/admin/popups/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                팝업 등록
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($popups->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">제목</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">유형</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">크기</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">활성여부</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">기간</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($popups as $index => $popup)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $popups->total() - ($popups->firstItem() - 1) - $index }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ url('/admin/popups/' . $popup->id . '/edit') }}"
                                       class="text-gray-900 hover:text-blue-600 transition font-medium">
                                        {{ $popup->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        {{ $popup->popup_type == 'layer' ? 'bg-blue-100 text-blue-800' : 'bg-orange-100 text-orange-800' }}">
                                        {{ $popup->popup_type == 'layer' ? '레이어' : '윈도우' }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $popup->width ?? '-' }}x{{ $popup->height ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form action="{{ url('/admin/popups/' . $popup->id . '/toggle-active') }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition cursor-pointer
                                            {{ $popup->is_active ? 'bg-green-100 text-green-800 hover:bg-green-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                            {{ $popup->is_active ? '활성' : '비활성' }}
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center text-xs text-gray-500">
                                    @if($popup->started_at || $popup->ended_at)
                                        {{ $popup->started_at ? \Carbon\Carbon::parse($popup->started_at)->format('Y-m-d') : '~' }}
                                        ~
                                        {{ $popup->ended_at ? \Carbon\Carbon::parse($popup->ended_at)->format('Y-m-d') : '' }}
                                    @else
                                        <span class="text-gray-400">상시</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/popups/' . $popup->id . '/preview') }}"
                                           target="_blank"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-green-700 bg-green-50 rounded hover:bg-green-100 transition">
                                            미리보기
                                        </a>
                                        <a href="{{ url('/admin/popups/' . $popup->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/popups/' . $popup->id) }}"
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
                {{ $popups->withQueryString()->links() }}
            </div>
        @else
            {{-- 빈 상태 --}}
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 팝업이 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 팝업을 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/popups/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        팝업 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
