@props([
    'action' => '',
    'placeholder' => '검색어 입력',
    'value' => request('search', ''),
    'filters' => [],
])

<form action="{{ $action }}" method="GET" class="flex flex-wrap items-center gap-2">
    @foreach($filters as $filter)
        <select
            name="{{ $filter['name'] }}"
            class="rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
        >
            @foreach($filter['options'] as $optValue => $optLabel)
                <option value="{{ $optValue }}" @selected(request($filter['name']) == $optValue)>
                    {{ $optLabel }}
                </option>
            @endforeach
        </select>
    @endforeach

    <div class="flex flex-1 items-center gap-2">
        <input
            type="text"
            name="search"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="min-w-[200px] flex-1 rounded-lg border border-gray-300 px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500"
        />
        <button
            type="submit"
            class="inline-flex items-center gap-1 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-1"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            검색
        </button>
    </div>
</form>
