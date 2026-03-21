@extends('admin.layouts.app')

@section('title', '관련사이트 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">관련사이트 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $sites->total() }}건의 사이트</p>
    </div>

    {{-- 필터 & 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ url('/admin/related-sites') }}" method="GET" class="flex items-center gap-2 flex-1">
                <select name="site_type" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">전체 유형</option>
                    <option value="domestic" {{ request('site_type') === 'domestic' ? 'selected' : '' }}>국내</option>
                    <option value="overseas" {{ request('site_type') === 'overseas' ? 'selected' : '' }}>해외</option>
                    <option value="media" {{ request('site_type') === 'media' ? 'selected' : '' }}>언론</option>
                    <option value="bidding" {{ request('site_type') === 'bidding' ? 'selected' : '' }}>입찰정보</option>
                </select>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    필터
                </button>
            </form>
            <a href="{{ url('/admin/related-sites/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                사이트 등록
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($sites->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">사이트명</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">유형</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">활성</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">정렬</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sites as $index => $site)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $sites->total() - ($sites->firstItem() - 1) - $index }}</td>
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $site->site_name }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ $site->site_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 hover:underline">{{ $site->site_url }}</a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $typeLabels = ['domestic' => '국내', 'overseas' => '해외', 'media' => '언론', 'bidding' => '입찰정보'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $typeLabels[$site->site_type] ?? $site->site_type }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($site->is_active)
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-400"></span>
                                    @else
                                        <span class="inline-block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $site->sort_order }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/related-sites/' . $site->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/related-sites/' . $site->id) }}"
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
                {{ $sites->withQueryString()->links() }}
            </div>
        @else
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 사이트가 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 관련사이트를 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/related-sites/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        사이트 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
