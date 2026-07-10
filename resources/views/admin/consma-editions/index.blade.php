@extends('admin.layouts.app')

@section('title', 'ConsMa 포스터 관리')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">ConsMa 포스터 관리</h1>
            <p class="mt-1 text-sm text-gray-500">연도별 ConsMa 포스터 썸네일과 텍스트를 관리합니다.</p>
        </div>
        <a href="{{ url('/admin/consma-editions/create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">+ 포스터 등록</a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">순서</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">썸네일</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">연도</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">메인 텍스트</th>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">보조 텍스트</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500">노출</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500">관리</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($editions as $e)
                    <tr>
                        <td class="px-4 py-3 text-gray-500">{{ $e->sort_order }}</td>
                        <td class="px-4 py-3">
                            @if($e->thumb_path)
                                <img src="/cmak/{{ ltrim($e->thumb_path, '/') }}" alt="{{ $e->year }}" style="width:52px; height:70px; object-fit:cover; border-radius:4px;">
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $e->year }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $e->main_text }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $e->sub_text }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($e->is_active)
                                <span class="inline-block px-2 py-0.5 rounded-full bg-green-100 text-green-700 text-xs">노출</span>
                            @else
                                <span class="inline-block px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 text-xs">숨김</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <a href="{{ url('/admin/consma-editions/' . $e->id . '/edit') }}"
                               class="inline-flex items-center px-3 py-1 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 text-xs">수정</a>
                            <form action="{{ url('/admin/consma-editions/' . $e->id) }}" method="POST" class="inline"
                                  onsubmit="return confirm('삭제하시겠습니까?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-white border border-red-300 text-red-600 rounded hover:bg-red-50 text-xs">삭제</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="px-4 py-10 text-center text-gray-400">등록된 포스터가 없습니다.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
