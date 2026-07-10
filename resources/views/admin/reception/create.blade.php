@extends('admin.layouts.app')

@section('title', '행사 생성')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">행사 생성</h1>

    <form action="{{ url('/admin/reception') }}" method="POST">
        @csrf
        @include('admin.reception._form')
        <div class="mt-6 flex justify-end gap-3">
            <a href="{{ url('/admin/reception') }}" class="px-4 py-2 bg-white border border-gray-300 text-sm text-gray-700 rounded-md hover:bg-gray-50">목록으로</a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">저장</button>
        </div>
    </form>
</div>
@endsection
