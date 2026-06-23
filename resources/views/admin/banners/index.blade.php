@extends('admin.layouts.app')

@section('title', '배너 관리')

@php
    $typeInfo = [
        'main'    => ['label' => '메인 배너',    'desc' => '메인 페이지 상단 큰 배너 영역',           'badge' => 'bg-blue-100 text-blue-800'],
        'sub'     => ['label' => '서브 배너',    'desc' => '서브(하위) 페이지 상단 배너',            'badge' => 'bg-purple-100 text-purple-800'],
        'sidebar' => ['label' => '사이드바 배너', 'desc' => '본문 우측 세로 광고 영역',               'badge' => 'bg-gray-100 text-gray-800'],
        'cm_ad'   => ['label' => 'CM AD',       'desc' => '메인 히어로 섹션 바로 아래 가로 광고 띠', 'badge' => 'bg-orange-100 text-orange-800'],
        'partner' => ['label' => '관련기관 배너', 'desc' => '메인 하단 관련기관 롤링 배너',           'badge' => 'bg-teal-100 text-teal-800'],
    ];
    $current = request('screen_type');
    $grouped = $banners->getCollection()->groupBy('screen_type');
@endphp

@section('content')
<div class="w-full" x-data="{ showCreate: {{ $errors->any() ? 'true' : 'false' }} }">
    {{-- 헤더 --}}
    <div class="flex items-center justify-between mb-5">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">배너 관리</h1>
            <p class="mt-1 text-sm text-gray-500">사이트 각 영역의 배너 이미지를 관리합니다. 유형(위치)별로 구분되어 있습니다.</p>
        </div>
        <button type="button" @click="showCreate = true"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition whitespace-nowrap">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            배너 등록
        </button>
    </div>

    {{-- 유형 범례(어디에 표시되는지) + 필터 --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 mb-6">
        <a href="{{ url('/admin/banners') }}"
           class="block rounded-lg border px-4 py-3 transition {{ !$current ? 'border-blue-400 bg-blue-50 ring-1 ring-blue-200' : 'border-gray-200 bg-white hover:border-gray-300' }}">
            <div class="text-sm font-semibold text-gray-900">전체 보기</div>
            <div class="text-xs text-gray-500 mt-0.5">모든 배너</div>
        </a>
        @foreach($typeInfo as $key => $info)
            <a href="{{ url('/admin/banners?screen_type=' . $key) }}"
               class="block rounded-lg border px-4 py-3 transition {{ $current === $key ? 'border-blue-400 bg-blue-50 ring-1 ring-blue-200' : 'border-gray-200 bg-white hover:border-gray-300' }}">
                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $info['badge'] }}">{{ $info['label'] }}</span>
                <div class="text-xs text-gray-500 mt-1.5 leading-snug">{{ $info['desc'] }}</div>
            </a>
        @endforeach
    </div>

    @if($banners->count() > 0)
        @foreach($grouped as $type => $group)
            @php $info = $typeInfo[$type] ?? ['label' => $type, 'desc' => '', 'badge' => 'bg-gray-100 text-gray-800']; @endphp

            {{-- 섹션 헤더 --}}
            <div class="mt-6 mb-2 flex flex-wrap items-center gap-2">
                <span class="inline-flex items-center px-2.5 py-1 rounded text-sm font-semibold {{ $info['badge'] }}">{{ $info['label'] }}</span>
                <span class="text-sm text-gray-500">{{ $info['desc'] }}</span>
                <span class="text-xs text-gray-400">· {{ $group->count() }}개</span>
            </div>

            {{-- 썸네일 미리보기 스트립 --}}
            <div class="flex flex-wrap gap-2 mb-3 p-3 bg-gray-50 rounded-lg border border-gray-100">
                @php $hasImg = false; @endphp
                @foreach($group as $g)
                    @if($g->image_path && file_exists(public_path($g->image_path)))
                        @php $hasImg = true; @endphp
                        <a href="{{ url('/admin/banners/' . $g->id . '/edit') }}" title="{{ $g->title }}{{ $g->is_active ? '' : ' (비활성)' }}">
                            <img src="/cmak/{{ $g->image_path }}" alt="{{ $g->title }}"
                                 class="h-14 w-auto rounded border border-gray-200 object-cover {{ $g->is_active ? '' : 'opacity-40' }}">
                        </a>
                    @endif
                @endforeach
                @unless($hasImg)<span class="text-xs text-gray-400">미리볼 이미지 없음</span>@endunless
            </div>

            {{-- 그룹 테이블 --}}
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2.5 text-center text-xs font-medium text-gray-500 uppercase w-24">미리보기</th>
                                <th class="px-4 py-2.5 text-left text-xs font-medium text-gray-500 uppercase">제목 / 링크</th>
                                <th class="px-4 py-2.5 text-center text-xs font-medium text-gray-500 uppercase w-20">활성</th>
                                <th class="px-4 py-2.5 text-center text-xs font-medium text-gray-500 uppercase w-16">정렬</th>
                                <th class="px-4 py-2.5 text-center text-xs font-medium text-gray-500 uppercase w-28">관리</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($group as $banner)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 text-center">
                                        @if($banner->image_path && file_exists(public_path($banner->image_path)))
                                            <img src="/cmak/{{ $banner->image_path }}" alt="{{ $banner->title }}" class="w-[72px] h-[44px] object-cover rounded border border-gray-200 mx-auto">
                                        @else
                                            <div class="w-[72px] h-[44px] bg-gray-100 rounded border border-gray-200 flex items-center justify-center mx-auto text-[10px] text-gray-400">없음</div>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-sm">
                                        <a href="{{ url('/admin/banners/' . $banner->id . '/edit') }}" class="text-gray-900 hover:text-blue-600 font-medium">{{ $banner->title }}</a>
                                        <div class="text-xs text-gray-400 mt-0.5 truncate max-w-md">{{ $banner->link_url ?: '링크 없음' }}</div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        @if($banner->is_active)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">활성</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">비활성</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center text-sm text-gray-500">{{ $banner->sort_order ?? 0 }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ url('/admin/banners/' . $banner->id . '/edit') }}" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded hover:bg-blue-100">수정</a>
                                            <form action="{{ url('/admin/banners/' . $banner->id) }}" method="POST" onsubmit="return confirm('정말 삭제하시겠습니까?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded hover:bg-red-100">삭제</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @else
        <div class="bg-white rounded-lg shadow px-4 py-16 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ $current ? '이 유형의 배너가 없습니다' : '등록된 배너가 없습니다' }}</h3>
            <div class="mt-6">
                <button type="button" @click="showCreate = true" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">배너 등록</button>
            </div>
        </div>
    @endif

    {{-- 배너 등록 모달 --}}
    <div x-show="showCreate" x-cloak
         class="fixed inset-0 z-50 flex items-start justify-center overflow-y-auto py-10"
         style="display:none;">
        {{-- 배경 --}}
        <div class="fixed inset-0 bg-black/50" @click="showCreate = false"></div>

        {{-- 모달 패널 --}}
        <div class="relative bg-white rounded-lg shadow-xl w-full max-w-2xl mx-4" @click.stop>
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-bold text-gray-900">배너 등록</h2>
                <button type="button" @click="showCreate = false" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <form action="{{ url('/admin/banners') }}" method="POST" enctype="multipart/form-data" class="flex">
                @csrf
                <div class="px-6 py-5 space-y-5 w-full">
                    {{-- 제목 --}}
                    <div>
                        <label for="m_title" class="block text-sm font-medium text-gray-700 mb-1">제목 <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="m_title" value="{{ old('title') }}" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="배너 제목">
                        @error('title')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- 화면유형 --}}
                    <div>
                        <label for="m_screen_type" class="block text-sm font-medium text-gray-700 mb-1">화면유형(위치)</label>
                        <select name="screen_type" id="m_screen_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                            <option value="main" {{ old('screen_type') == 'main' ? 'selected' : '' }}>메인 (상단 큰 배너)</option>
                            <option value="sub" {{ old('screen_type') == 'sub' ? 'selected' : '' }}>서브 (하위 페이지 상단)</option>
                            <option value="sidebar" {{ old('screen_type') == 'sidebar' ? 'selected' : '' }}>사이드바 (우측 세로)</option>
                            <option value="cm_ad" {{ old('screen_type', $current) == 'cm_ad' ? 'selected' : '' }}>CM AD (히어로 하단 광고)</option>
                            <option value="partner" {{ old('screen_type', $current) == 'partner' ? 'selected' : '' }}>관련기관 (메인 하단 롤링)</option>
                        </select>
                    </div>

                    {{-- 이미지 --}}
                    <div>
                        <label for="m_image" class="block text-sm font-medium text-gray-700 mb-1">이미지 <span class="text-red-500">*</span></label>
                        <input type="file" name="image" id="m_image" accept="image/*" required
                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        @error('image')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- 링크 URL --}}
                    <div>
                        <label for="m_link_url" class="block text-sm font-medium text-gray-700 mb-1">링크 URL</label>
                        <input type="url" name="link_url" id="m_link_url" value="{{ old('link_url') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm" placeholder="https://example.com">
                        @error('link_url')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>

                    {{-- 기간 --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="m_started_at" class="block text-sm font-medium text-gray-700 mb-1">시작일</label>
                            <input type="datetime-local" name="started_at" id="m_started_at" value="{{ old('started_at') }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                        <div>
                            <label for="m_ended_at" class="block text-sm font-medium text-gray-700 mb-1">종료일</label>
                            <input type="datetime-local" name="ended_at" id="m_ended_at" value="{{ old('ended_at') }}"
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                        </div>
                    </div>

                    {{-- 활성 & 정렬 --}}
                    <div class="flex flex-wrap items-center gap-6 pt-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
                            <span class="text-sm text-gray-700">활성</span>
                        </label>
                        <div class="flex items-center gap-2">
                            <label for="m_sort_order" class="text-sm text-gray-700">정렬순서</label>
                            <input type="number" name="sort_order" id="m_sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                   class="w-20 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm text-center">
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100 mt-2">
                        <button type="button" @click="showCreate = false"
                                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-sm font-medium text-gray-700 rounded-md hover:bg-gray-50">취소</button>
                        <button type="submit"
                                class="inline-flex items-center px-6 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700">저장</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
