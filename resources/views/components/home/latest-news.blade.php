{{--
    새소식 + 협회소식 컴포넌트
    좌측 컬럼에 표시되는 최신 뉴스 섹션
--}}
@props(['latestNews' => [], 'associationNews' => []])

<div class="space-y-6">
    {{-- 새소식 --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
        <div class="p-5">
            {{-- 헤더 --}}
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center shadow-lg shadow-primary-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">새소식</h2>
            </div>

            {{-- 뉴스 목록 --}}
            <div class="space-y-3">
                @foreach($latestNews as $news)
                <a href="{{ $news['link'] }}" class="block group">
                    <div class="flex items-start gap-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-primary-100 text-primary-700 shrink-0">
                            {{ \Carbon\Carbon::parse($news['date'])->format('m.d') }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors line-clamp-2 leading-relaxed">
                                @if($news['isNew'])
                                <span class="inline-flex items-center justify-center w-4 h-4 bg-red-500 text-white text-[9px] font-bold rounded mr-1">N</span>
                                @endif
                                {{ $news['title'] }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 협회소식 --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-shadow">
        <div class="p-5">
            {{-- 헤더 --}}
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">협회소식</h2>
            </div>

            {{-- 협회소식 목록 --}}
            <div class="space-y-3">
                @foreach($associationNews as $news)
                <a href="{{ $news['link'] }}" class="block group">
                    @if($news['isHighlight'] ?? false)
                    <div class="bg-gradient-to-r from-primary-50 to-indigo-50 rounded-xl p-4 border border-primary-100 hover:border-primary-200 transition-colors">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-primary-600 text-white">
                                {{ \Carbon\Carbon::parse($news['date'])->format('y.m.d') }}
                            </span>
                        </div>
                        <p class="text-sm font-semibold text-gray-900 group-hover:text-primary-700 transition-colors mb-1">
                            {{ $news['title'] }}
                        </p>
                        @if($news['subtitle'] ?? null)
                        <p class="text-xs text-primary-600 font-medium">{{ $news['subtitle'] }}</p>
                        @endif
                    </div>
                    @else
                    <div class="flex items-start gap-2 py-2">
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 shrink-0">
                            {{ \Carbon\Carbon::parse($news['date'])->format('m.d') }}
                        </span>
                        <p class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors line-clamp-2">
                            {{ $news['title'] }}
                        </p>
                    </div>
                    @endif
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
