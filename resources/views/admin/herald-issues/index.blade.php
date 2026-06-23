@extends('admin.layouts.app')

@section('title', 'CM Herald 관리')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">CM Herald 관리</h1>
            <p class="mt-1 text-sm text-gray-500">월간 소식지 호수를 관리합니다. (표지 썸네일 + 웹진보기 링크/PDF) — 공개 페이지는 로그인 회원만 열람</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="/cmak/business/herald" target="_blank" class="inline-flex items-center px-3 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50 transition">공개 페이지</a>
            <a href="{{ url('/admin/herald-issues/create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                호 추가
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
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">표지</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">제목/발행일</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">웹진</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">노출</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-28">관리</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($issues as $issue)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">
                            @if($issue->cover_image && file_exists(public_path($issue->cover_image)))
                                <img src="/cmak/{{ $issue->cover_image }}" alt="{{ $issue->title }}" class="w-[54px] h-[72px] object-cover rounded border border-gray-200">
                            @else
                                <div class="w-[54px] h-[72px] bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-[10px] text-gray-400">표지없음</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-gray-900">{{ $issue->title }}</div>
                            <div class="text-xs text-gray-500">{{ $issue->issue_date?->format('Y-m-d') ?: '-' }}</div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($issue->webzine_url)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-700">있음</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">없음</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($issue->is_published)
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-700">노출</span>
                            @else
                                <span class="inline-flex px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-500">숨김</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ url('/admin/herald-issues/' . $issue->id . '/edit') }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">수정</a>
                                <form action="{{ url('/admin/herald-issues/' . $issue->id) }}" method="POST" onsubmit="return confirm('삭제하시겠습니까?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100 transition">삭제</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="px-4 py-10 text-center text-sm text-gray-400">등록된 호가 없습니다.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $issues->links() }}</div>
</div>
@endsection
