@extends('admin.layouts.app')

@section('title', '히어로 슬라이드 관리')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">히어로 슬라이드 관리</h1>
            <p class="mt-1 text-sm text-gray-500">메인 페이지 최상단 큰 배경 슬라이드를 관리합니다. (정렬순서 오름차순으로 노출)</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="/cmak" target="_blank"
               class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">홈에서 보기</a>
            <a href="{{ url('/admin/hero-slides/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                슬라이드 추가
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">순서</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">이미지</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">문구</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">노출</th>
                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">관리</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($slides as $slide)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-700 text-center w-16">{{ $slide->sort_order }}</td>
                        <td class="px-4 py-3">
                            @if($slide->image_path && file_exists(public_path($slide->image_path)))
                                <img src="/cmak/{{ $slide->image_path }}" alt="{{ $slide->title }}"
                                     class="w-[120px] h-[60px] object-cover rounded border border-gray-200">
                            @else
                                <div class="w-[120px] h-[60px] bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-xs text-gray-400" title="{{ $slide->image_path ?? '이미지 없음' }}">없음</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-xs text-blue-600">{{ $slide->eyebrow }}</div>
                            <div class="text-sm text-gray-900">{{ $slide->title }}</div>
                            <div class="text-sm font-bold text-gray-900">{{ $slide->highlight }}</div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($slide->is_active)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">노출</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">숨김</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="inline-flex items-center gap-2">
                                <a href="{{ url('/admin/hero-slides/' . $slide->id . '/edit') }}"
                                   class="text-sm text-blue-600 hover:text-blue-800">수정</a>
                                <form action="{{ url('/admin/hero-slides/' . $slide->id) }}" method="POST"
                                      onsubmit="return confirm('이 슬라이드를 삭제하시겠습니까?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm text-red-600 hover:text-red-800">삭제</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-10 text-center text-sm text-gray-400">
                            등록된 슬라이드가 없습니다.
                            <a href="{{ url('/admin/hero-slides/create') }}" class="text-blue-600 hover:underline">첫 슬라이드를 추가하세요.</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
