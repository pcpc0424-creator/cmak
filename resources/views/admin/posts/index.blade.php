@extends('admin.layouts.app')

@section('title', ($boardConfig['name'] ?? '게시판') . ' 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $boardConfig['name'] ?? '게시판' }} 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $posts->total() }}건의 게시물</p>
    </div>

    {{-- 검색 & 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ url('/admin/posts/' . $boardType) }}" method="GET" class="flex items-center gap-2 flex-1">
                <input type="hidden" name="board_type" value="{{ $boardType }}">
                <input type="text" name="search" value="{{ request('search') }}"
                       placeholder="제목, 내용, 작성자 검색..."
                       class="flex-1 min-w-0 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    검색
                </button>
            </form>
            <a href="{{ url('/admin/posts/' . $boardType . '/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                새 글 작성
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($posts->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">제목</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">작성자</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">조회수</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">발행여부</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">작성일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($posts as $index => $post)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $posts->total() - ($posts->firstItem() - 1) - $index }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ url('/admin/posts/' . $boardType . '/' . $post->id . '/edit') }}"
                                       class="text-gray-900 hover:text-blue-600 transition font-medium">
                                        @if($post->is_featured)
                                            <svg class="w-4 h-4 text-yellow-400 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                        {{ $post->title }}
                                        @if($post->attachments_count > 0)
                                            <svg class="w-4 h-4 text-gray-400 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                            </svg>
                                        @endif
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $post->author }}
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ number_format($post->view_count ?? 0) }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($post->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            발행
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            비발행
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $post->created_at->format('Y-m-d') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/posts/' . $boardType . '/' . $post->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/posts/' . $boardType . '/' . $post->id) }}"
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
                {{ $posts->withQueryString()->links() }}
            </div>
        @else
            {{-- 빈 상태 --}}
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">게시물이 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 글을 작성해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/posts/' . $boardType . '/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        새 글 작성
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
