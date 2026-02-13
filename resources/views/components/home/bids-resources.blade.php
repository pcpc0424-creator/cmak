{{--
    입·낙찰정보 + CM자료방 섹션
--}}
@props(['bids' => [], 'resources' => []])

<div class="grid lg:grid-cols-2 gap-6">
    {{-- 입·낙찰정보 --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- 헤더 --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center shadow-lg shadow-rose-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">입·낙찰정보</h2>
            </div>
            <a href="/notice/tender" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- 목록 --}}
        <div class="p-5">
            <ul class="space-y-3">
                @foreach($bids as $bid)
                <li>
                    <a href="{{ $bid['link'] }}" class="flex items-start gap-3 py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                        <span class="shrink-0 inline-flex items-center justify-center w-12 h-6 rounded text-[10px] font-bold
                            {{ $bid['type'] === '입찰' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700' }}">
                            {{ $bid['type'] }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors line-clamp-1">{{ $bid['title'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $bid['date'] }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    {{-- CM자료방 --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        {{-- 헤더 --}}
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-cyan-500 to-cyan-600 flex items-center justify-center shadow-lg shadow-cyan-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
                <h2 class="text-lg font-bold text-gray-900">CM자료방</h2>
            </div>
            <a href="/cmdata" class="text-sm text-primary-600 hover:text-primary-700 font-medium flex items-center gap-1">
                더보기
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>

        {{-- 목록 --}}
        <div class="p-5">
            <ul class="space-y-3">
                @foreach($resources as $resource)
                <li>
                    <a href="{{ $resource['link'] }}" class="flex items-start gap-3 py-2 hover:bg-gray-50 rounded-lg px-2 -mx-2 transition-colors group">
                        <span class="shrink-0 inline-flex items-center justify-center px-2 h-6 rounded text-[10px] font-bold bg-cyan-100 text-cyan-700">
                            {{ $resource['category'] }}
                        </span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-700 group-hover:text-primary-600 transition-colors line-clamp-1">{{ $resource['title'] }}</p>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
