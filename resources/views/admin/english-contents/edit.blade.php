@extends('admin.layouts.app')

@section('title', '영문 페이지 수정')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6 flex items-start justify-between">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">영문 페이지 수정</h1>
            <p class="mt-1 text-sm text-gray-500">/cmak/eng/{{ $content->slug }}</p>
        </div>
        <a href="{{ url('/cmak/eng/' . ($content->slug === 'home' ? '' : $content->slug)) }}" target="_blank"
           class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gray-700 bg-gray-100 rounded hover:bg-gray-200">
            새 창에서 보기 →
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded text-green-800 text-sm">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/admin/english-contents/' . $content->id) }}" method="POST">
        @method('PUT')
        @include('admin.english-contents._form')
    </form>

    @if($items->count() > 0)
        @include('admin.english-contents._items', ['items' => $items])
    @endif
</div>
@endsection
