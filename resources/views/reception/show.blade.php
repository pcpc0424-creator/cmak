@extends('layouts.sub')

@section('title', $event->title . ' - 온라인 접수')
@section('category', '온라인 접수')
@section('category-link', '/cmak/reception')
@section('page-title', '온라인 접수')

@section('content')
<div class="sub-content-card">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px; flex-wrap:wrap;">
        <h2 class="sub-content-title" style="margin:0;">{{ $event->title }}</h2>
        <a href="/cmak/reception" style="font-size:13px; color:#0061c2; text-decoration:none;">← 목록으로</a>
    </div>

    @if(session('success'))
        <div class="rcp-alert rcp-alert-ok">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="rcp-alert rcp-alert-err">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="rcp-alert rcp-alert-err">
            입력값을 확인해주세요.<br>
            @foreach($errors->all() as $err)<span>· {{ $err }}</span><br>@endforeach
        </div>
    @endif

    {{-- 행사 정보 --}}
    <table class="rcp-info">
        @if($event->description)<tr><th>행사 설명</th><td>{!! nl2br(e($event->description)) !!}</td></tr>@endif
        @if($event->event_start || $event->event_end)
            <tr><th>행사 일정</th><td>{{ optional($event->event_start)->format('Y-m-d H:i') ?: '-' }} ~ {{ optional($event->event_end)->format('Y-m-d H:i') ?: '-' }}</td></tr>
        @endif
        @if($event->reg_start || $event->reg_end)
            <tr><th>접수 기간</th><td>{{ optional($event->reg_start)->format('Y-m-d H:i') ?: '상시' }} ~ {{ optional($event->reg_end)->format('Y-m-d H:i') ?: '미정' }}</td></tr>
        @endif
        @if($event->fee_info)<tr><th>참가비</th><td>{{ $event->fee_info }}</td></tr>@endif
        @if($event->capacity)<tr><th>정원</th><td>{{ number_format($event->capacity) }}명</td></tr>@endif
        <tr><th>상태</th><td>{{ $event->statusLabel() }}</td></tr>
    </table>

    @if(!$event->isAcceptingNow())
        <div class="rcp-alert rcp-alert-err" style="margin-top:24px;">현재 접수 가능한 기간이 아닙니다.</div>
    @elseif($event->questions->isEmpty())
        <div class="rcp-alert rcp-alert-err" style="margin-top:24px;">아직 신청 문항이 준비되지 않았습니다.</div>
    @else
        <h3 style="margin-top:32px; font-size:17px; color:#1a2b45; font-weight:700;">신청서 작성</h3>
        <form method="POST" action="/cmak/reception/{{ $event->slug }}" class="rcp-form">
            @csrf
            @foreach($event->questions as $q)
                @php $name = 'q_' . $q->id; $old = old($name); @endphp
                <div class="rcp-field">
                    @if($q->type !== 'agreement')
                        <label class="rcp-label">{{ $q->label }}@if($q->is_required)<span class="rcp-req">*</span>@endif</label>
                    @endif

                    @switch($q->type)
                        @case('textarea')
                            <textarea name="{{ $name }}" rows="4" class="rcp-input" @if($q->is_required) required @endif>{{ $old }}</textarea>
                            @break

                        @case('select')
                            <select name="{{ $name }}" class="rcp-input" @if($q->is_required) required @endif>
                                <option value="">선택하세요</option>
                                @foreach(($q->options ?? []) as $opt)
                                    <option value="{{ $opt }}" {{ $old === $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                @endforeach
                            </select>
                            @break

                        @case('radio')
                            <div class="rcp-choices">
                                @foreach(($q->options ?? []) as $opt)
                                    <label class="rcp-choice"><input type="radio" name="{{ $name }}" value="{{ $opt }}" {{ $old === $opt ? 'checked' : '' }} @if($q->is_required) required @endif> {{ $opt }}</label>
                                @endforeach
                            </div>
                            @break

                        @case('checkbox')
                            @php $olds = (array) old($name, []); @endphp
                            <div class="rcp-choices">
                                @foreach(($q->options ?? []) as $opt)
                                    <label class="rcp-choice"><input type="checkbox" name="{{ $name }}[]" value="{{ $opt }}" {{ in_array($opt, $olds) ? 'checked' : '' }}> {{ $opt }}</label>
                                @endforeach
                            </div>
                            @break

                        @case('date')
                            <input type="date" name="{{ $name }}" value="{{ $old }}" class="rcp-input" @if($q->is_required) required @endif>
                            @break

                        @case('agreement')
                            <label class="rcp-agree"><input type="checkbox" name="{{ $name }}" value="1" {{ $old ? 'checked' : '' }} @if($q->is_required) required @endif> {{ $q->label }}@if($q->is_required)<span class="rcp-req">*</span>@endif</label>
                            @break

                        @default
                            <input type="text" name="{{ $name }}" value="{{ $old }}" class="rcp-input" @if($q->is_required) required @endif>
                    @endswitch
                </div>
            @endforeach

            <div style="margin-top:24px; text-align:center;">
                <button type="submit" class="rcp-submit">신청하기</button>
            </div>
        </form>
    @endif
</div>

<style>
    .rcp-alert { margin-top:16px; padding:12px 16px; border-radius:6px; font-size:14px; }
    .rcp-alert-ok { background:#e8f6ee; color:#1f7a44; border:1px solid #bfe6cd; }
    .rcp-alert-err { background:#fdecec; color:#b23; border:1px solid #f5c6c6; }
    .rcp-info { width:100%; border-collapse:collapse; margin-top:20px; }
    .rcp-info th, .rcp-info td { border:1px solid #e8ecf1; padding:10px 14px; font-size:14px; text-align:left; vertical-align:top; }
    .rcp-info th { background:#f6f8fb; width:130px; color:#4a5568; font-weight:600; white-space:nowrap; }
    .rcp-form { margin-top:16px; }
    .rcp-field { margin-bottom:18px; }
    .rcp-label { display:block; font-size:14px; font-weight:600; color:#333; margin-bottom:6px; }
    .rcp-req { color:#d00; margin-left:3px; }
    .rcp-input { width:100%; padding:9px 12px; border:1px solid #dde3ed; border-radius:5px; font-size:14px; }
    .rcp-choices { display:flex; flex-wrap:wrap; gap:14px; }
    .rcp-choice, .rcp-agree { display:inline-flex; align-items:center; gap:6px; font-size:14px; color:#444; cursor:pointer; }
    .rcp-submit { padding:12px 40px; background:#0061c2; color:#fff; border:0; border-radius:6px; font-size:15px; font-weight:600; cursor:pointer; }
    .rcp-submit:hover { background:#004e9c; }
</style>
@endsection
