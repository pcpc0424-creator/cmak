{{--
    전문가 칼럼 & 기획특집 카드
    2026 Modern Design
--}}
@php
    $basePath = '/cmak';
@endphp

<div class="modern-card overflow-hidden">
    {{-- 헤더 --}}
    <div class="p-6 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-xl font-bold text-gray-900 flex items-center gap-3">
            <span class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </span>
            전문가 칼럼
        </h3>
        <a href="/cmdata/expert" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 group">
            더보기
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            {{-- 메인 칼럼 (Featured) --}}
            @if(count($columns) > 0 && ($columns[0]['isFeatured'] ?? false))
                <div class="lg:col-span-2">
                    <a href="{{ $columns[0]['link'] }}" class="block group">
                        <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 to-purple-700 p-8 min-h-[200px]">
                            {{-- 배경 패턴 --}}
                            <div class="absolute inset-0 opacity-10">
                                <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                            <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
                                        </pattern>
                                    </defs>
                                    <rect width="100%" height="100%" fill="url(#grid)" />
                                </svg>
                            </div>

                            <div class="relative z-10">
                                <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur-sm text-white text-sm font-medium rounded-full mb-4">
                                    Featured Column
                                </span>
                                <h4 class="text-2xl font-bold text-white mb-3 group-hover:text-blue-100 transition-colors">
                                    {{ $columns[0]['title'] }}
                                </h4>
                                @if($columns[0]['summary'])
                                    <p class="text-white/80 line-clamp-2 mb-4">
                                        {{ $columns[0]['summary'] }}
                                    </p>
                                @endif
                                <div class="flex items-center gap-4">
                                    <span class="text-white/70 text-sm">{{ $columns[0]['author'] }}</span>
                                    <span class="text-white/50">|</span>
                                    <span class="text-white/70 text-sm">{{ $columns[0]['date'] }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            {{-- 나머지 칼럼 목록 --}}
            @foreach(array_slice($columns, 1) as $column)
                <a href="{{ $column['link'] }}" class="block group">
                    <div class="p-4 rounded-xl border border-gray-100 hover:border-indigo-200 hover:bg-indigo-50/30 transition-all duration-300">
                        <h4 class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors mb-2">
                            {{ $column['title'] }}
                        </h4>
                        <div class="flex items-center gap-3 text-sm text-gray-500">
                            <span>{{ $column['author'] }}</span>
                            <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                            <span>{{ $column['date'] }}</span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- 기획특집 --}}
        @if(count($features) > 0)
            <div class="mt-8 pt-8 border-t border-gray-100">
                <h4 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    기획특집
                </h4>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach(array_slice($features, 0, 4) as $feature)
                        <a href="{{ $feature['link'] }}" class="block group">
                            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                @if(isset($feature['isFeatured']) && $feature['isFeatured'])
                                    <span class="badge badge-hot shrink-0 mt-0.5">HOT</span>
                                @else
                                    <span class="w-1.5 h-1.5 bg-orange-500 rounded-full mt-2 shrink-0"></span>
                                @endif
                                <div class="flex-1 min-w-0">
                                    <p class="text-gray-800 font-medium line-clamp-2 group-hover:text-orange-600 transition-colors">
                                        {{ $feature['title'] }}
                                    </p>
                                    <p class="text-sm text-gray-400 mt-1">{{ $feature['date'] }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</div>
