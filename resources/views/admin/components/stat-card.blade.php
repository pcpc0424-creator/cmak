@props([
    'title' => '',
    'value' => 0,
    'icon' => '',
    'color' => 'blue',
])

@php
    $colorMap = [
        'blue'   => ['border' => 'border-l-blue-500',   'bg' => 'bg-blue-100',   'text' => 'text-blue-600'],
        'green'  => ['border' => 'border-l-green-500',  'bg' => 'bg-green-100',  'text' => 'text-green-600'],
        'red'    => ['border' => 'border-l-red-500',    'bg' => 'bg-red-100',    'text' => 'text-red-600'],
        'yellow' => ['border' => 'border-l-yellow-500', 'bg' => 'bg-yellow-100', 'text' => 'text-yellow-600'],
        'purple' => ['border' => 'border-l-purple-500', 'bg' => 'bg-purple-100', 'text' => 'text-purple-600'],
        'indigo' => ['border' => 'border-l-indigo-500', 'bg' => 'bg-indigo-100', 'text' => 'text-indigo-600'],
    ];
    $c = $colorMap[$color] ?? $colorMap['blue'];
@endphp

<div class="flex items-center gap-4 rounded-lg border border-gray-200 border-l-4 {{ $c['border'] }} bg-white p-5 shadow-sm">
    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full {{ $c['bg'] }}">
        <svg class="h-6 w-6 {{ $c['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
        </svg>
    </div>
    <div>
        <p class="text-2xl font-bold text-gray-900">{{ $value }}</p>
        <p class="text-sm text-gray-500">{{ $title }}</p>
    </div>
</div>
