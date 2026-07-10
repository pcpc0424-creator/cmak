{{-- $items: EnglishItem collection, $empty: empty message --}}
@if($items->count())
    <p class="eng-board-count">Total <strong>{{ $items->count() }}</strong></p>
    <div class="eng-board">
        @foreach($items as $item)
            @php
                $badgeClass = in_array(strtolower($item->tag ?? ''), ['pdf']) ? 'pdf'
                    : (in_array(strtolower($item->tag ?? ''), ['doc','docx']) ? 'doc' : '');
                $tag = $item->link ? 'a' : 'div';
            @endphp
            <{{ $tag }} class="eng-board-row" @if($item->link) href="{{ $item->link }}" target="_blank" rel="noopener" @endif>
                <span class="eng-board-no">{{ $items->count() - $loop->index }}</span>
                @if($item->image_path)
                    <img class="eng-board-thumb" src="{{ $item->image_path }}" alt="" loading="lazy">
                @endif
                <span class="eng-board-main">
                    <span class="eng-board-title">{{ $item->title }}</span>
                </span>
                @if($item->tag)<span class="eng-board-badge {{ $badgeClass }}">{{ $item->tag }}</span>@endif
                <span class="eng-board-date">{{ $item->date_text }}</span>
            </{{ $tag }}>
        @endforeach
    </div>
@else
    <p style="padding:30px 0; color:#888;">{{ $empty ?? 'No items yet.' }}</p>
@endif
