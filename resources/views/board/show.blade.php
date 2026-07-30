@extends('layouts.sub')

@section('title', $post->title . ' - 한국CM협회')
@section('category', $boardConfig['menu'] ?? '')
@section('page-title', $boardConfig['name'] ?? '')

@section('side-menu')
    @php
        $menuToSideMenu = [
            '알림마당' => 'notice._side-menu',
            'CM 소개' => 'cmdata._side-menu',
            '협회업무' => 'business._side-menu',
            '참여마당' => 'community._side-menu',
        ];
        $sideMenuView = $menuToSideMenu[$boardConfig['menu'] ?? ''] ?? null;
    @endphp
    @if($sideMenuView)
        @include($sideMenuView)
    @endif
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title" style="font-size:18px; margin-bottom:16px;">{{ $post->title }}</h2>

    <div style="display:flex; gap:16px; padding:12px 0; border-top:1px solid #e8ecf1; border-bottom:1px solid #e8ecf1; margin-bottom:24px; font-size:13px; color:#888;">
        @if($post->author)
            <span>{{ $boardConfig['author_label'] ?? '작성자' }}: {{ $post->author }}</span>
        @endif
        @if(!empty($post->metadata['affiliation']))
            <span>소속: {{ $post->metadata['affiliation'] }}</span>
        @endif
        <span>등록일: {{ $post->published_at ? $post->published_at->format('Y-m-d') : ($post->created_at ? $post->created_at->format('Y-m-d') : '-') }}</span>
        <span>조회: {{ number_format($post->view_count) }}</span>
    </div>

    @php
        $isBookReview = ($boardType === 'book_review');
        $isImageAttachment = fn($a) => str_starts_with($a->mime_type ?? '', 'image/')
            || preg_match('/\.(jpe?g|png|gif|webp|bmp)$/i', $a->file_name ?? '');
        $imageAttachments = $post->attachments->filter($isImageAttachment);
        $fileAttachments = $post->attachments->reject($isImageAttachment);
        // CM해외공급사업·CM수행사례·보도자료·기타자료·유관기관소식: 이미지를 본문 위로 올려 이미지 밑에 게시글이 보이도록 함
        $imagesOnTop = in_array($boardType, ['cm_overseas', 'cm_case', 'news_press', 'etc_data', 'news_org'], true);
    @endphp

    {{-- 첨부 이미지를 본문 위에 표시 (CM해외공급사업) --}}
    @if(!$isBookReview && $imagesOnTop && $imageAttachments->count() > 0)
        <div style="padding:8px 0 16px;">
            @foreach($imageAttachments as $img)
                <img src="/cmak/{{ $img->file_path }}" alt="{{ $img->file_name }}"
                     style="max-width:100%; height:auto; display:block; margin:0 auto 12px;">
            @endforeach
        </div>
    @endif

    @if($isBookReview)
        {{-- Book Review: 책표지 + 책정보(책제목/저자/출판사) --}}
        <div style="display:flex; gap:24px; flex-wrap:wrap; margin-bottom:24px; padding:20px; border:1px solid #e8ecf1; border-radius:8px; background:#f8f9fb;">
            @if($imageAttachments->count() > 0)
                <div style="flex-shrink:0; margin:0 auto;">
                    <img src="/cmak/{{ $imageAttachments->first()->file_path }}" alt="{{ $post->metadata['book_title'] ?? $post->title }}"
                         style="width:160px; height:auto; border:1px solid #dde3ed; border-radius:4px;">
                </div>
            @endif
            <div style="flex:1; min-width:220px; display:flex; flex-direction:column; justify-content:center; gap:12px;">
                @foreach(['book_title' => '책제목', 'book_author' => '저자', 'publisher' => '출판사'] as $key => $label)
                    <div style="display:flex; gap:12px; font-size:14px; border-bottom:1px solid #e8ecf1; padding-bottom:10px;">
                        <span style="width:60px; font-weight:bold; color:#064277; flex-shrink:0;">{{ $label }}</span>
                        <span style="color:#333;">{{ $post->metadata[$key] ?? '-' }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif(!empty($boardConfig['show_metadata']) && !empty($boardConfig['fields']) && $post->metadata)
        <div style="margin-bottom:24px; border:1px solid #e8ecf1; border-radius:6px; overflow:hidden;">
            <table class="sub-table" style="margin:0;">
                <tbody>
                    @foreach($boardConfig['fields'] as $key => $field)
                        @if(!empty($post->metadata[$key]))
                            <tr>
                                <td style="background:#f8f9fb; font-weight:bold; width:120px; text-align:center; font-size:13px;">{{ $field['label'] }}</td>
                                <td style="font-size:13px;">{{ $post->metadata[$key] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div style="min-height:200px; padding:16px 0; line-height:1.8; font-size:14px; color:#333;">
        @php
            $content = $post->content;
            // <BODY> 태그 안쪽 내용만 추출
            if (preg_match('/<body[^>]*>(.*)<\/body>/is', $content, $m)) {
                $content = $m[1];
            }
            // <HTML>, <HEAD> 등 문서 레벨 태그 제거 (body 미닫힘 등 추출 실패 케이스 대비 body/link도 제거)
            $content = preg_replace('/<\/?(html|head|meta|body|link|!doctype)[^>]*>/i', '', $content);
            // 이미지 경로 보정 — 원본 사이트 상대경로를 절대경로로 변환
            $content = preg_replace('/src=["\']\/upload\//i', 'src="/cmak/legacy/upload/', $content);
            $content = preg_replace('/src=["\']\.\.\/\.\.\/upload\//i', 'src="/cmak/legacy/upload/', $content);
            $content = preg_replace('/src=["\']upload\//i', 'src="/cmak/legacy/upload/', $content);
            // 이미지 반응형 처리
            $content = preg_replace('/<img\b/i', '<img style="max-width:100%; height:auto;"', $content);
            $content = trim($content);
            // 이중 인코딩된 HTML 엔티티 복원
            $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
            // HTML 태그가 전혀 없는 순수 텍스트면 줄바꿈을 <br>로 변환
            // (블록 태그뿐 아니라 STRONG/FONT 등 인라인 태그만 있는 본문도 HTML로 인식)
            if (!preg_match('/<\/?[a-z][a-z0-9]*[\s\/>]/i', $content)) {
                $content = nl2br(e($content));
            }
        @endphp
        {!! $content !!}
    </div>

    {{-- 첨부 이미지 본문 인라인 표시 (Book Review는 표지를 상단 카드에, CM해외공급사업은 본문 위에 이미 표시) --}}
    @if(!$isBookReview && !$imagesOnTop && $imageAttachments->count() > 0)
        <div style="padding:8px 0 16px;">
            @foreach($imageAttachments as $img)
                <img src="/cmak/{{ $img->file_path }}" alt="{{ $img->file_name }}"
                     style="max-width:100%; height:auto; display:block; margin:0 auto 12px;">
            @endforeach
        </div>
    @endif

    @if($fileAttachments->count() > 0)
        <div style="margin-top:24px; padding:16px 20px; background:#f8f9fb; border:1px solid #e8ecf1; border-radius:6px;">
            <div style="font-size:13px; font-weight:600; color:#555; margin-bottom:10px;">
                첨부파일 ({{ $fileAttachments->count() }}개)
            </div>
            @foreach($fileAttachments as $attachment)
                <div style="display:flex; align-items:center; gap:8px; padding:6px 0; {{ !$loop->last ? 'border-bottom:1px solid #e8ecf1;' : '' }}">
                    <svg style="width:16px; height:16px; color:#888; flex-shrink:0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                    </svg>
                    <a href="/cmak/{{ $attachment->file_path }}" target="_blank" download
                       style="font-size:13px; color:#0061c2; text-decoration:none;">
                        {{ $attachment->file_name }}
                    </a>
                    @if($attachment->file_size)
                        <span style="font-size:11px; color:#aaa;">({{ number_format($attachment->file_size / 1024, 1) }} KB)</span>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @php
        $memberBoards = ['job_offer', 'job_seek'];
        $canManage = auth()->check()
            && in_array($boardType, $memberBoards, true)
            && ($post->created_by === auth()->id() || auth()->user()->isAdmin());
    @endphp

    <div style="margin-top:32px; padding-top:16px; border-top:1px solid #e8ecf1; display:flex; justify-content:center; gap:8px; flex-wrap:wrap;">
        <a href="javascript:history.back()" style="display:inline-block; padding:8px 24px; background:#555; color:#fff; border-radius:4px; font-size:13px; text-decoration:none;">목록으로</a>
        @if($canManage)
            <a href="/cmak/board/{{ $boardType }}/{{ $post->id }}/edit" style="display:inline-block; padding:8px 24px; background:#265de8; color:#fff; border-radius:4px; font-size:13px; text-decoration:none;">수정</a>
            <form action="/cmak/board/{{ $boardType }}/{{ $post->id }}" method="POST" style="margin:0;" onsubmit="return confirm('이 글을 삭제하시겠습니까?');">
                @csrf @method('DELETE')
                <button type="submit" style="padding:8px 24px; background:#d04444; color:#fff; border:0; border-radius:4px; font-size:13px; cursor:pointer;">삭제</button>
            </form>
        @endif
    </div>
</div>
@endsection
