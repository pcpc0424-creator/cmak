@extends('admin.layouts.app')

@section('title', '상단 POPUP 관리')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">상단 POPUP 관리</h1>
            <p class="mt-1 text-sm text-gray-500">헤더 상단 'POPUP' 펼침 영역의 버튼을 관리합니다. (이미지 등록 시 이미지로, 없으면 텍스트로 표시)</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="/cmak" target="_blank" class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">홈에서 보기</a>
            <a href="{{ url('/admin/top-popup-items/create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                버튼 추가
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
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase w-16">순서</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">이미지</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">텍스트 / 링크</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">노출</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-28">관리</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($items as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-700 text-center">{{ $item->sort_order }}</td>
                        <td class="px-4 py-3">
                            @if($item->image_path && file_exists(public_path($item->image_path)))
                                <img src="/cmak/{{ $item->image_path }}" alt="{{ $item->label }}" class="h-12 max-w-[180px] object-cover rounded border border-gray-200">
                            @else
                                <span class="text-xs text-gray-400">이미지 없음 (텍스트 표시)</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-gray-900">{{ $item->label }}</div>
                            <div class="text-xs text-gray-500">{{ $item->link_url ?: '— 링크 없음' }}</div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($item->is_active)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">노출</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">숨김</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ url('/admin/top-popup-items/' . $item->id . '/edit') }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">수정</a>
                                <form action="{{ url('/admin/top-popup-items/' . $item->id) }}" method="POST" onsubmit="return confirm('삭제하시겠습니까?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100 transition">삭제</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-sm text-gray-400">등록된 버튼이 없습니다.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
