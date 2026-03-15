{{--
    새소식 + 협회소식 카드
    2026 Modern Design
--}}

{{-- 새소식 카드 --}}
<div class="modern-card p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <span class="w-8 h-8 bg-gradient-to-br from-red-500 to-orange-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </span>
            새소식
        </h3>
        <a href="/news/latest" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 group">
            더보기
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="space-y-4">
        @foreach($latestNews as $news)
            <a href="{{ $news['link'] }}" class="block group">
                <div class="flex items-start gap-3">
                    @if($news['isNew'] ?? false)
                        <span class="badge badge-new shrink-0 mt-0.5">NEW</span>
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-gray-800 font-medium line-clamp-2 group-hover:text-blue-600 transition-colors">
                            {{ $news['title'] }}
                        </p>
                        <p class="text-sm text-gray-500 mt-1">{{ $news['date'] }}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

{{-- 협회소식 카드 --}}
<div class="modern-card p-6">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
            <span class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-500 rounded-lg flex items-center justify-center">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </span>
            협회소식
        </h3>
        <a href="/news/association" class="text-sm text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1 group">
            더보기
            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </a>
    </div>

    <div class="space-y-4">
        @foreach($associationNews as $news)
            <a href="{{ $news['link'] }}" class="block group">
                @if($news['isHighlight'] ?? false)
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-xl border border-blue-100 group-hover:border-blue-200 transition-colors">
                        <p class="text-blue-800 font-semibold line-clamp-2">
                            {{ $news['title'] }}
                        </p>
                        @if(isset($news['subtitle']))
                            <p class="text-sm text-blue-600 mt-1 font-medium">
                                {{ $news['subtitle'] }}
                            </p>
                        @endif
                        <p class="text-xs text-blue-500 mt-2">{{ $news['date'] }}</p>
                    </div>
                @else
                    <div class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 bg-gray-400 rounded-full mt-2 shrink-0"></span>
                        <div class="flex-1 min-w-0">
                            <p class="text-gray-800 font-medium line-clamp-2 group-hover:text-blue-600 transition-colors">
                                {{ $news['title'] }}
                            </p>
                            <p class="text-sm text-gray-500 mt-1">{{ $news['date'] }}</p>
                        </div>
                    </div>
                @endif
            </a>
        @endforeach
    </div>
</div>
