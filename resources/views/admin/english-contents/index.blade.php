@extends('admin.layouts.app')

@section('title', '영문사이트 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{-- 헤더 --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">영문사이트 관리</h1>
        <p class="mt-1 text-sm text-gray-500">총 {{ $contents->total() }}건의 콘텐츠</p>
    </div>

    {{-- 필터 & 버튼 --}}
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form action="{{ url('/admin/english-contents') }}" method="GET" class="flex items-center gap-2 flex-1">
                <select name="section" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                    <option value="">전체 섹션</option>
                    <option value="about" {{ request('section') === 'about' ? 'selected' : '' }}>About</option>
                    <option value="members" {{ request('section') === 'members' ? 'selected' : '' }}>Members</option>
                    <option value="services" {{ request('section') === 'services' ? 'selected' : '' }}>Services</option>
                    <option value="contact" {{ request('section') === 'contact' ? 'selected' : '' }}>Contact</option>
                    <option value="news" {{ request('section') === 'news' ? 'selected' : '' }}>News</option>
                </select>
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 transition">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                    </svg>
                    필터
                </button>
            </form>
            <a href="{{ url('/admin/english-contents/create') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                콘텐츠 등록
            </a>
        </div>
    </div>

    {{-- 테이블 --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($contents->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-16">No</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">제목</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-24">섹션</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">발행여부</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-20">조회수</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">수정일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider w-28">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($contents as $content)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $content->id }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ url('/admin/english-contents/' . $content->id . '/edit') }}"
                                       class="text-gray-900 hover:text-blue-600 transition font-medium">
                                        {{ $content->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @php
                                        $sectionLabels = ['about' => 'About', 'members' => 'Members', 'services' => 'Services', 'contact' => 'Contact', 'news' => 'News'];
                                        $sectionColors = ['about' => 'bg-purple-100 text-purple-800', 'members' => 'bg-blue-100 text-blue-800', 'services' => 'bg-green-100 text-green-800', 'contact' => 'bg-yellow-100 text-yellow-800', 'news' => 'bg-indigo-100 text-indigo-800'];
                                    @endphp
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $sectionColors[$content->section] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $sectionLabels[$content->section] ?? $content->section }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($content->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">발행</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">비발행</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ number_format($content->view_count ?? 0) }}</td>
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $content->updated_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url('/admin/english-contents/' . $content->id . '/edit') }}"
                                           class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100 transition">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/english-contents/' . $content->id) }}"
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
                {{ $contents->withQueryString()->links() }}
            </div>
        @else
            <div class="px-4 py-16 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 콘텐츠가 없습니다</h3>
                <p class="mt-1 text-sm text-gray-500">새로운 영문 콘텐츠를 등록해보세요.</p>
                <div class="mt-6">
                    <a href="{{ url('/admin/english-contents/create') }}"
                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        콘텐츠 등록
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
