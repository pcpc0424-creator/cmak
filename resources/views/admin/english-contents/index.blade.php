@extends('admin.layouts.eng-app')

@section('title', '영문사이트 관리')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">영문사이트 페이지 관리</h1>
        <p class="mt-1 text-sm text-gray-500">
            왼쪽 메뉴에서 편집할 영문 페이지를 선택하세요. 아래 카드에서 바로 들어갈 수도 있습니다.
        </p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md text-green-800 text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- 섹션별 카드 --}}
    @foreach($sectionLabels as $sectionKey => $sectionLabel)
        @php $sectionPages = ($contents[$sectionKey] ?? collect()); @endphp
        @continue($sectionPages->isEmpty())

        <div class="mb-8">
            <div class="flex items-center gap-2 mb-3">
                <h2 class="text-sm font-bold text-slate-700 uppercase tracking-wide">{{ $sectionLabel }}</h2>
                <span class="text-xs text-gray-400">{{ $sectionPages->count() }}</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                @foreach($sectionPages as $page)
                    <a href="{{ url('/admin/english-contents/' . $page->id . '/edit') }}"
                       class="group block bg-white rounded-lg border border-gray-200 hover:border-indigo-400 hover:shadow-sm transition p-4">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <div class="font-semibold text-gray-900 group-hover:text-indigo-600 truncate">{{ $page->title }}</div>
                                <div class="text-xs text-gray-400 font-mono mt-0.5 truncate">/eng/{{ $page->slug }}</div>
                            </div>
                            @if($page->is_published)
                                <span class="flex-shrink-0 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">발행</span>
                            @else
                                <span class="flex-shrink-0 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">비발행</span>
                            @endif
                        </div>
                        @if($page->description)
                            <p class="mt-2 text-xs text-gray-500 line-clamp-2">{{ \Illuminate\Support\Str::limit($page->description, 90) }}</p>
                        @endif
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
@endsection
