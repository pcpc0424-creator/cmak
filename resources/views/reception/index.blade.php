@extends('layouts.sub')

@section('title', '온라인 접수 - 한국CM협회')
@section('category', '온라인 접수')
@section('category-link', '/cmak/reception')
@section('page-title', '온라인 접수')

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">온라인 접수</h2>
    <p class="sub-content-desc">한국CM협회의 행사·교육 신청을 온라인으로 접수합니다.</p>

    @if($events->isEmpty())
        <p style="text-align:center; padding:48px; color:#999;">현재 진행 중인 접수가 없습니다.</p>
    @else
        <div class="rcp-list">
            @foreach($events as $e)
                <a href="/cmak/reception/{{ $e->slug }}" class="rcp-item">
                    <div class="rcp-item-main">
                        <span class="rcp-badge rcp-badge-{{ $e->status }}">{{ $e->statusLabel() }}</span>
                        <strong>{{ $e->title }}</strong>
                        @if($e->reg_start || $e->reg_end)
                            <span class="rcp-period">접수기간 :
                                {{ optional($e->reg_start)->format('Y-m-d H:i') ?: '상시' }}
                                ~ {{ optional($e->reg_end)->format('Y-m-d H:i') ?: '미정' }}
                            </span>
                        @endif
                    </div>
                    <span class="rcp-go">신청하기 →</span>
                </a>
            @endforeach
        </div>
    @endif
</div>

<style>
    .rcp-list { display:flex; flex-direction:column; gap:12px; margin-top:20px; }
    .rcp-item {
        display:flex; align-items:center; justify-content:space-between; gap:16px;
        padding:18px 22px; border:1px solid #e8ecf1; border-radius:8px;
        text-decoration:none; color:inherit; background:#fff; transition:box-shadow .2s;
    }
    .rcp-item:hover { box-shadow:0 6px 18px rgba(0,0,0,.08); }
    .rcp-item-main { display:flex; flex-direction:column; gap:6px; min-width:0; }
    .rcp-item-main strong { font-size:16px; color:#1a2b45; }
    .rcp-period { font-size:13px; color:#7a8699; }
    .rcp-badge { align-self:flex-start; font-size:11px; font-weight:700; padding:2px 8px; border-radius:10px; }
    .rcp-badge-open { background:#e5f0ff; color:#0061c2; }
    .rcp-badge-closed { background:#fbeaea; color:#c0392b; }
    .rcp-badge-done { background:#eef0f3; color:#7a8699; }
    .rcp-go { color:#0061c2; font-size:14px; font-weight:600; white-space:nowrap; }
    @media (max-width:520px){ .rcp-item{ flex-direction:column; align-items:flex-start; gap:10px; } }
</style>
@endsection
