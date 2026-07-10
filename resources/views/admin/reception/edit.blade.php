@extends('admin.layouts.app')

@section('title', '행사 수정')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">행사 수정 — {{ $event->title }}</h1>
        <div class="flex gap-2">
            <a href="{{ url('/admin/reception/' . $event->id . '/submissions') }}" class="px-3 py-1.5 bg-white border border-blue-300 text-blue-600 rounded text-sm hover:bg-blue-50">신청데이터 ({{ $event->submissions()->count() }})</a>
            <a href="/cmak/reception/{{ $event->slug }}" target="_blank" class="px-3 py-1.5 bg-white border border-gray-300 text-gray-600 rounded text-sm hover:bg-gray-50">사용자 화면 보기</a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-md bg-green-50 border border-green-200 px-4 py-3 text-sm text-green-700">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/admin/reception/' . $event->id) }}" method="POST">
        @csrf @method('PUT')
        @include('admin.reception._form')
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ url('/admin/reception') }}" class="px-4 py-2 bg-white border border-gray-300 text-sm text-gray-700 rounded-md hover:bg-gray-50">목록으로</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">저장</button>
        </div>
    </form>
</div>
@endsection
