@extends('admin.layouts.app')

@section('title', '영문사이트 관리')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">영문사이트 페이지 관리</h1>
        <p class="mt-1 text-sm text-gray-500">
            영문 사이트 (/eng) 의 21개 페이지를 관리합니다.
            각 페이지의 <strong>제목·설명</strong> 과 <strong>리스트 항목 (뉴스·이벤트·갤러리·슬라이드 등)</strong> 을 수정/삭제할 수 있습니다.
        </p>
    </div>

    {{-- 섹션 필터 탭 --}}
    <div class="bg-white rounded-lg shadow mb-6 px-2 py-1 flex flex-wrap gap-1">
        <a href="{{ url('/admin/english-contents') }}"
           class="px-4 py-2 text-sm font-medium rounded {{ !$section ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
            전체
        </a>
        @foreach($sectionLabels as $key => $label)
            <a href="{{ url('/admin/english-contents?section=' . $key) }}"
               class="px-4 py-2 text-sm font-medium rounded {{ $section === $key ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-md text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @forelse($contents as $sectionKey => $sectionPages)
        <div class="bg-white rounded-lg shadow mb-6 overflow-hidden">
            <div class="px-6 py-3 bg-gradient-to-r from-slate-700 to-slate-600 text-white">
                <h2 class="text-base font-bold">{{ $sectionLabels[$sectionKey] ?? $sectionKey }}</h2>
                <p class="text-xs text-slate-200">{{ $sectionPages->count() }}개 페이지</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-16">순서</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">페이지명 / Slug</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">설명</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-20">발행</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-28">수정일</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase w-44">관리</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sectionPages as $page)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $page->sort_order }}</td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ url('/admin/english-contents/' . $page->id . '/edit') }}"
                                       class="font-semibold text-gray-900 hover:text-blue-600">{{ $page->title }}</a>
                                    <div class="text-xs text-gray-400 font-mono mt-0.5">/eng/{{ $page->slug }}</div>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 max-w-md">{{ \Illuminate\Support\Str::limit($page->description, 80) }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($page->is_published)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">발행</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">비발행</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center text-xs text-gray-500">{{ $page->updated_at->format('Y-m-d') }}</td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-1.5">
                                        <a href="{{ url('/cmak/eng/' . ($page->slug === 'home' ? '' : $page->slug)) }}" target="_blank"
                                           class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
                                            보기
                                        </a>
                                        <a href="{{ url('/admin/english-contents/' . $page->id . '/edit') }}"
                                           class="inline-flex items-center px-2 py-1 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100">
                                            수정
                                        </a>
                                        <form action="{{ url('/admin/english-contents/' . $page->id) }}" method="POST"
                                              onsubmit="return confirm('이 페이지를 삭제하시겠습니까?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="inline-flex items-center px-2 py-1 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100">
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
        </div>
    @empty
        <div class="bg-white rounded-lg shadow px-4 py-16 text-center">
            <h3 class="mt-2 text-sm font-medium text-gray-900">등록된 페이지가 없습니다</h3>
            <p class="mt-1 text-sm text-gray-500">새로운 영문 페이지를 등록해보세요.</p>
        </div>
    @endforelse
</div>
@endsection
