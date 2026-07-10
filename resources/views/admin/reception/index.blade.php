@extends('admin.layouts.app')

@section('title', '온라인 접수 관리')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">온라인 접수 관리</h1>
            <p class="mt-1 text-sm text-gray-500">행사·설문을 만들고 신청 문항을 구성하며 접수 데이터를 확인합니다.</p>
        </div>
        <a href="{{ url('/admin/reception/create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">+ 행사 생성</a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left font-medium text-gray-500">행사명</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500 w-24">상태</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500 w-40">접수기간</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500 w-20">신청</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500 w-16">노출</th>
                    <th class="px-4 py-3 text-center font-medium text-gray-500 w-56">관리</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($events as $e)
                    <tr>
                        <td class="px-4 py-3 font-medium text-gray-800">{{ $e->title }}</td>
                        <td class="px-4 py-3 text-center">{{ $e->statusLabel() }}</td>
                        <td class="px-4 py-3 text-center text-xs text-gray-500">
                            {{ optional($e->reg_start)->format('m-d H:i') ?: '상시' }} ~ {{ optional($e->reg_end)->format('m-d H:i') ?: '미정' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ url('/admin/reception/' . $e->id . '/submissions') }}" class="text-blue-600 font-semibold">{{ $e->submissions_count }}</a>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($e->is_active)<span class="text-green-600 text-xs">노출</span>@else<span class="text-gray-400 text-xs">숨김</span>@endif
                        </td>
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <a href="{{ url('/admin/reception/' . $e->id . '/edit') }}" class="px-2.5 py-1 bg-white border border-gray-300 text-gray-700 rounded hover:bg-gray-50 text-xs">수정</a>
                            <a href="{{ url('/admin/reception/' . $e->id . '/submissions') }}" class="px-2.5 py-1 bg-white border border-blue-300 text-blue-600 rounded hover:bg-blue-50 text-xs">신청데이터</a>
                            <form action="{{ url('/admin/reception/' . $e->id) }}" method="POST" class="inline" onsubmit="return confirm('삭제하시겠습니까? 신청데이터도 함께 삭제됩니다.');">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-2.5 py-1 bg-white border border-red-300 text-red-600 rounded hover:bg-red-50 text-xs">삭제</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="px-4 py-10 text-center text-gray-400">등록된 행사가 없습니다.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $events->links() }}</div>
</div>
@endsection
