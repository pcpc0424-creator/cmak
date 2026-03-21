@extends('admin.layouts.app')

@section('title', '배너 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">배너 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $banners->total() }}개의 배너</p>
    </div>

    {{-- 필터 & 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ url('/admin/banners') }}" method="GET" class="flex items-center gap-2">
                <select name="screen_type"
                        class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm"
                        onchange="this.form.submit()">
                    <option value="">전체 화면</option>
                    <option value="main" {{ request('screen_type') == 'main' ? 'selected' : '' }}>메인</option>
                    <option value="sub" {{ request('screen_type') == 'sub' ? 'selected' : '' }}>서브</option>
                    <option value="sidebar" {{ request('screen_type') == 'sidebar' ? 'selected' : '' }}>사이드바</option>
                </select>
            </form>
            <a href="{{ url('/admin/banners/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                배너 등록
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($banners->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">미리보기</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">제목</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">화면</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">활성여부</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">클릭수</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-40">기간</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">정렬</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($banners as $index => $banner)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $banners->total() - ($banners->firstItem() - 1) - $index }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($banner->image_path && file_exists(public_path($banner->image_path)))
                                        <img src="/cmak/{{ $banner->image_path }}" alt="{{ $banner->title }}"
                                             class="w-[60px] h-[40px] object-cover rounded border border-gray-200 mx-auto">
                                    @else
                                        <div class="w-[60px] h-[40px] bg-gray-100 rounded border border-gray-200 flex items-center justify-center mx-auto" title="{{ $banner->image_path ?? '이미지 없음' }}">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ url('/admin/banners/' . $banner->id . '/edit') }}"
                                       class="text-gray-900 hover:text-blue-600 transition font-medium">
                                        {{ $banner->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium
                                        {{ $banner->screen_type == 'main' ? 'bg-blue-100 text-blue-800' : ($banner->screen_type == 'sub' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $banner->screen_type == 'main' ? '메인' : ($banner->screen_type == 'sub' ? '서브' : '사이드바') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($banner->is_active)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">활성</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">비활성</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ number_format($banner->click_count ?? 0) }}
                                </td>
                                <td class="px-4 py-3 text-center text-xs text-gray-500">
                                    @if($banner->started_at || $banner->ended_at)
                                        {{ $banner->started_at ? \Carbon\Carbon::parse($banner->started_at)->format('Y-m-d') : '~' }}
                                        ~
                                        {{ $banner->ended_at ? \Carbon\Carbon::parse($banner->ended_at)->format('Y-m-d') : '' }}
                                    @else
                                        <span class="text-gray-400">상시</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">
                                    {{ $banner->sort_order ?? 0 }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/banners/' . $banner->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/banners/' . $banner->id) }}"
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
                {{ $banners->withQueryString()->links() }}
            </div>
        @else
            {{-- 빈 상태 --}}
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 배너가 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 배너를 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/banners/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        배너 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
