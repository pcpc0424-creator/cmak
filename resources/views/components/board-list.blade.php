{{-- 게시판 공통 목록 컴포넌트 --}}
@php
    $basePath = '/cmak';
    $columns = $columns ?? [];
    $searchFields = $searchFields ?? [];
@endphp

<div style="display:flex; gap:8px; margin-bottom:24px; flex-wrap:wrap;">
    <form action="" method="GET" style="display:flex; gap:8px; flex:1; min-width:200px;">
        @if(!empty($searchFields))
            <select name="search_field" style="padding:8px 10px; border:1px solid #dde3ed; border-radius:4px; font-size:13px; min-width:90px;">
                @foreach($searchFields as $key => $label)
                    <option value="{{ $key }}" {{ request('search_field') === $key ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="검색어를 입력하세요"
               style="flex:1; min-width:200px; padding:8px 12px; border:1px solid #dde3ed; border-radius:4px; font-size:13px;">
        <button type="submit" style="padding:8px 20px; background:#0061c2; color:#fff; border:none; border-radius:4px; font-size:13px; font-weight:600; cursor:pointer;">검색</button>
    </form>
</div>

@if(isset($posts) && $posts->count() > 0)
    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                @if(!empty($columns))
                    @foreach($columns as $col)
                        <th style="{{ $col['style'] ?? '' }}">{{ $col['label'] }}</th>
                    @endforeach
                @else
                    <th>제목</th>
                    @if(!($hideAuthor ?? false))
                        <th style="width:80px;">작성자</th>
                    @endif
                    <th style="width:60px;">조회</th>
                    <th style="width:110px; white-space:nowrap;">등록일</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index => $post)
                <tr>
                    <td style="text-align:center;">{{ $posts->total() - ($posts->firstItem() - 1) - $index }}</td>
                    @if(!empty($columns))
                        @foreach($columns as $col)
                            @php
                                $field = $col['field'] ?? '';
                                if ($field === 'title') {
                                    $val = $post->title;
                                } elseif ($field === 'author') {
                                    $val = $post->author ?? '-';
                                } elseif ($field === 'view_count') {
                                    $val = number_format($post->view_count ?? 0);
                                } elseif ($field === 'published_at') {
                                    $val = $post->published_at ? $post->published_at->format('Y-m-d') : ($post->created_at ? $post->created_at->format('Y-m-d') : '-');
                                } elseif ($field === 'attachment') {
                                    $val = null;
                                } elseif (str_starts_with($field, 'metadata.')) {
                                    $key = str_replace('metadata.', '', $field);
                                    $raw = $post->metadata[$key] ?? '-';
                                    $lawLabels = ['law' => '법·시행령·시행규칙', 'rule' => '훈령·지침·고시', 'preview' => '입법예고'];
                                    $val = ($key === 'law_category' && isset($lawLabels[$raw])) ? $lawLabels[$raw] : $raw;
                                } elseif ($field === 'excerpt') {
                                    $val = $post->excerpt ?: mb_substr(strip_tags($post->content ?? ''), 0, 80, 'UTF-8');
                                    if (!$val) $val = '-';
                                } else {
                                    $val = $post->{$field} ?? '-';
                                }
                            @endphp
                            <td style="{{ $col['tdStyle'] ?? '' }}">
                                @if($field === 'title')
                                    <a href="{{ $basePath }}/board/{{ $boardType }}/{{ $post->id }}" style="color:#333; text-decoration:none;">{{ $val }}</a>
                                @elseif($field === 'attachment')
                                    @if($post->attachments && $post->attachments->count() > 0)
                                        <span style="color:#0061c2;">📎</span>
                                    @else
                                        -
                                    @endif
                                @else
                                    {{ $val }}
                                @endif
                            </td>
                        @endforeach
                    @else
                        <td>
                            <a href="{{ $basePath }}/board/{{ $boardType }}/{{ $post->id }}" style="color:#333; text-decoration:none;">
                                @if(!empty($replyPrefix) && str_starts_with($post->title, '답변입니다'))
                                    <span style="color:#0061c2; font-weight:600;">→ Re</span>
                                @endif
                                {{ $post->title }}
                            </a>
                        </td>
                        @if(!($hideAuthor ?? false))
                            <td style="text-align:center; color:#888; font-size:12px;">{{ $post->author ?? '-' }}</td>
                        @endif
                        <td style="text-align:center; color:#888;">{{ number_format($post->view_count ?? 0) }}</td>
                        <td style="text-align:center; color:#888; font-size:12px; white-space:nowrap;">
                            {{ $post->published_at ? $post->published_at->format('Y-m-d') : ($post->created_at ? $post->created_at->format('Y-m-d') : '-') }}
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 페이지네이션 --}}
    @if($posts->hasPages())
        <div style="margin-top:24px; display:flex; justify-content:center; gap:4px; flex-wrap:wrap;">
            @if($posts->onFirstPage())
                <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">◀</span>
            @else
                <a href="{{ $posts->previousPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">◀</a>
            @endif

            @php
                $currentPage = $posts->currentPage();
                $lastPage = $posts->lastPage();
                $start = max(1, $currentPage - 4);
                $end = min($lastPage, $start + 9);
                if ($end - $start < 9) $start = max(1, $end - 9);
            @endphp
            @for($i = $start; $i <= $end; $i++)
                @if($i == $currentPage)
                    <span style="padding:6px 12px; background:#0061c2; color:#fff; border-radius:4px; font-size:13px; font-weight:600;">{{ $i }}</span>
                @else
                    <a href="{{ $posts->url($i) }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">{{ $i }}</a>
                @endif
            @endfor

            @if($posts->hasMorePages())
                <a href="{{ $posts->nextPageUrl() }}" style="padding:6px 12px; border:1px solid #dde3ed; border-radius:4px; color:#555; font-size:13px; text-decoration:none;">▶</a>
            @else
                <span style="padding:6px 12px; border:1px solid #e8ecf1; border-radius:4px; color:#ccc; font-size:13px;">▶</span>
            @endif
        </div>
    @endif
@else
    <table class="sub-table">
        <thead>
            <tr>
                <th style="width:50px;">No.</th>
                <th>제목</th>
                <th style="width:110px; white-space:nowrap;">등록일</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="3" style="text-align:center; padding:40px; color:#999;">
                    @if(request('search'))
                        '{{ request('search') }}'에 대한 검색 결과가 없습니다.
                    @else
                        등록된 게시물이 없습니다.
                    @endif
                </td>
            </tr>
        </tbody>
    </table>
@endif
