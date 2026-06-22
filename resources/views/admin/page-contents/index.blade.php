@extends('admin.layouts.app')

@section('title', '협회업무 페이지 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">협회업무 페이지 관리</h1>
        <p class="mt-1 text-sm text-gray-500">
            협회업무 메뉴의 페이지 내용을 직접 수정합니다.
            <strong>수정</strong> 을 누르면 글자·이미지·표를 워드처럼 편집할 수 있습니다.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-16">순서</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">페이지명</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">주소</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-20">게시</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-28">수정일</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-48">관리</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pages as $page)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $page->sort_order }}</td>
                            <td class="px-4 py-3 text-sm">
                                <a href="{{ url('/admin/page-contents/' . $page->id . '/edit') }}"
                                   class="font-semibold text-gray-900 hover:text-blue-600">{{ $page->page_title }}</a>
                            </td>
                            <td class="px-4 py-3 text-xs text-gray-400 font-mono">/business/{{ $page->slug }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($page->is_published)
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded bg-green-100 text-green-700">게시중</span>
                                @else
                                    <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded bg-gray-100 text-gray-500">숨김</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center text-xs text-gray-400">{{ $page->updated_at?->format('Y-m-d') }}</td>
                            <td class="px-4 py-3 text-center text-sm">
                                <a href="{{ url('/admin/page-contents/' . $page->id . '/edit') }}"
                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded hover:bg-blue-700">수정</a>
                                <a href="{{ url('/cmak/business/' . $page->slug) }}" target="_blank"
                                   class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200 ml-1">보기 →</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-400">등록된 페이지가 없습니다.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
