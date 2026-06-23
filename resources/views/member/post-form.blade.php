@extends('layouts.sub')

@php $isEdit = ($mode === 'edit'); @endphp

@section('title', ($isEdit ? '글 수정' : '글쓰기') . ' - ' . ($boardConfig['name'] ?? '') . ' - 한국CM협회')
@section('category', '참여마당')
@section('category-link', '/cmak/community/faq')
@section('page-title', $boardConfig['name'] ?? '')

@section('side-menu')
    @include('community._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">{{ $boardConfig['name'] ?? '' }} {{ $isEdit ? '수정' : '글쓰기' }}</h2>

    @if ($errors->any())
        <div style="margin:16px 0; padding:12px 14px; background:#fef2f2; border:1px solid #fecaca; border-radius:8px; color:#b91c1c; font-size:13px;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $err)<li>{{ $err }}</li>@endforeach
            </ul>
        </div>
    @endif

    @php
        $lblStyle = 'display:block; font-size:13px; color:#555; margin-bottom:6px; font-weight:600;';
        $inStyle = 'width:100%; height:42px; padding:0 12px; border:1px solid #d4dae5; border-radius:8px; font-size:14px; box-sizing:border-box;';
        $action = $isEdit
            ? '/cmak/board/' . $boardType . '/' . $post->id
            : '/cmak/community/' . $slug . '/write';
    @endphp

    <form action="{{ $action }}" method="POST" enctype="multipart/form-data" style="max-width:760px; margin:20px auto 0;">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div style="display:grid; grid-template-columns:1fr; gap:18px;">
            {{-- 제목 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 제목</label>
                <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required style="{{ $inStyle }}">
            </div>

            {{-- 게시판별 메타 항목 --}}
            @if(!empty($boardConfig['fields']))
                <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:14px;">
                    @foreach($boardConfig['fields'] as $key => $field)
                        <div>
                            <label style="{{ $lblStyle }}">{{ $field['label'] }}</label>
                            <input type="text" name="meta[{{ $key }}]"
                                   value="{{ old('meta.' . $key, $post->metadata[$key] ?? '') }}"
                                   placeholder="{{ $field['placeholder'] ?? '' }}"
                                   style="{{ $inStyle }}">
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- 내용 --}}
            <div>
                <label style="{{ $lblStyle }}"><span style="color:#d00;">*</span> 내용</label>
                <textarea name="content" required rows="12"
                          style="width:100%; padding:12px; border:1px solid #d4dae5; border-radius:8px; font-size:14px; line-height:1.7; box-sizing:border-box; resize:vertical;">{{ old('content', $post->content ?? '') }}</textarea>
            </div>

            {{-- 기존 첨부파일 (수정 모드) --}}
            @if($isEdit && $post->attachments->count() > 0)
                <div>
                    <label style="{{ $lblStyle }}">기존 첨부파일</label>
                    <div style="border:1px solid #e8ecf1; border-radius:8px; overflow:hidden;">
                        @foreach($post->attachments as $att)
                            <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; padding:8px 12px; {{ !$loop->last ? 'border-bottom:1px solid #eef1f6;' : '' }}">
                                <a href="/cmak/{{ $att->file_path }}" target="_blank" style="font-size:13px; color:#0061c2; text-decoration:none;">📎 {{ $att->file_name }}</a>
                                <button type="submit" form="del-att-{{ $att->id }}"
                                        onclick="return confirm('이 첨부파일을 삭제하시겠습니까?');"
                                        style="background:none; border:0; color:#d00; font-size:12px; cursor:pointer;">삭제</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- 첨부파일 추가 --}}
            <div>
                <label style="{{ $lblStyle }}">첨부파일 {{ $isEdit ? '추가' : '' }} (파일당 최대 20MB)</label>
                <input type="file" name="attachments[]" multiple style="font-size:13px;">
            </div>
        </div>

        <div style="margin-top:26px; display:flex; gap:10px; justify-content:center;">
            <a href="/cmak/community/{{ $slug }}" style="padding:12px 28px; background:#fff; border:1px solid #d4dae5; border-radius:8px; color:#555; font-weight:600; text-decoration:none;">취소</a>
            <button type="submit" style="padding:12px 40px; background:#265de8; color:#fff; border:0; border-radius:8px; font-size:15px; font-weight:600; cursor:pointer;">{{ $isEdit ? '수정완료' : '등록' }}</button>
        </div>
    </form>

    {{-- 첨부 삭제용 폼 (form 속성으로 위 버튼과 연결) --}}
    @if($isEdit && $post->attachments->count() > 0)
        @foreach($post->attachments as $att)
            <form id="del-att-{{ $att->id }}" action="/cmak/board/{{ $boardType }}/{{ $post->id }}/attachments/{{ $att->id }}" method="POST">
                @csrf @method('DELETE')
            </form>
        @endforeach
    @endif
</div>
@endsection
