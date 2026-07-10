@extends('admin.layouts.app')

@section('title', '신청 데이터 - ' . $event->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">신청 데이터</h1>
            <p class="mt-1 text-sm text-gray-500">{{ $event->title }} · 총 {{ $submissions->total() }}건</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ url('/admin/reception/' . $event->id . '/export') }}" class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-md hover:bg-green-700">엑셀 다운로드</a>
            <a href="{{ url('/admin/reception/' . $event->id . '/edit') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm text-gray-700 rounded-md hover:bg-gray-50">행사 수정</a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-3 py-3 text-left font-medium text-gray-500 whitespace-nowrap">No</th>
                    <th class="px-3 py-3 text-left font-medium text-gray-500 whitespace-nowrap">제출일시</th>
                    @foreach($event->questions as $q)
                        <th class="px-3 py-3 text-left font-medium text-gray-500 whitespace-nowrap">{{ $q->label }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($submissions as $i => $sub)
                    <tr>
                        <td class="px-3 py-2 text-gray-500">{{ $submissions->total() - ($submissions->firstItem() - 1) - $i }}</td>
                        <td class="px-3 py-2 text-gray-600 whitespace-nowrap">{{ optional($sub->submitted_at)->format('Y-m-d H:i') }}</td>
                        @foreach($event->questions as $q)
                            @php $v = $sub->answers[$q->id] ?? ''; $v = is_array($v) ? implode(', ', $v) : $v; @endphp
                            <td class="px-3 py-2 text-gray-700">{{ $v }}</td>
                        @endforeach
                    </tr>
                @empty
                    <tr><td colspan="{{ $event->questions->count() + 2 }}" class="px-3 py-10 text-center text-gray-400">접수된 신청이 없습니다.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $submissions->links() }}</div>
</div>
@endsection
