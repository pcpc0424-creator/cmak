@php $page = eng_page('membership'); @endphp
@extends('layouts.eng')

@section('title', ($page->title ?? 'Membership') . ' - CMAK')
@section('hero', true)
@section('category', 'Membership')
@section('category-link', '/cmak/eng/membership')
@section('page-title', $page->title ?? 'Membership')

@section('side-menu')
<a href="/cmak/eng/membership" class="active">Membership</a>
<a href="/cmak/eng/about/contact">Contact Us</a>
@endsection

@push('styles')
<style>
.eng-firm-table { width: 100%; border-collapse: collapse; margin-top: 18px; font-size: 13.5px; }
.eng-firm-table th { background: #0a3d7c; color: #fff; padding: 12px 10px; font-weight: 700; text-align: center; white-space: nowrap; }
.eng-firm-table td { padding: 11px 10px; border-bottom: 1px solid #eef1f5; color: #444; vertical-align: middle; }
.eng-firm-table tbody tr:hover { background: #f6f9fd; }
.eng-firm-table .c { text-align: center; white-space: nowrap; }
.eng-firm-table .name { font-weight: 700; color: #1a1a1a; }
.eng-firm-table .name a { color: #0061c2; }
.eng-firm-wrap { overflow-x: auto; }
@media (max-width: 800px) { .eng-firm-table { min-width: 720px; } }
</style>
@endpush

@php $firms = ($page?->activeItems ?? collect())->where('type', 'member_firm')->values(); @endphp

@section('content')
<div class="eng-card">
    <h2>{{ $page->title ?? 'Membership' }}</h2>
    <p class="desc">{{ $page->description ?? 'Member firms of the Construction Management Association of Korea.' }}</p>

    @if($firms->count())
        <p style="color:#666; font-size:14px;">Total <strong>{{ $firms->count() }}</strong> member firms</p>
        <div class="eng-firm-wrap">
            <table class="eng-firm-table">
                <thead>
                    <tr>
                        <th style="width:44px;">No.</th>
                        <th>Firm Name</th>
                        <th>Address</th>
                        <th style="width:120px;">Tel.</th>
                        <th style="width:120px;">Fax.</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($firms as $i => $f)
                        <tr>
                            <td class="c">{{ $i + 1 }}</td>
                            <td class="name">
                                @if($f->link)
                                    <a href="{{ \Illuminate\Support\Str::startsWith($f->link, 'http') ? $f->link : 'http://'.$f->link }}" target="_blank">{{ $f->title }}</a>
                                @else
                                    {{ $f->title }}
                                @endif
                            </td>
                            <td>{{ $f->description }}</td>
                            <td class="c">{{ $f->tag ?: '-' }}</td>
                            <td class="c">{{ $f->date_text ?: '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>Member firm directory will be available soon.</p>
    @endif

    <div class="eng-info-box" style="margin-top:28px;">
        <dt>Email</dt><dd>cm@cmak.or.kr</dd>
        <dt>Telephone</dt><dd>(+82) 2-585-4712~4</dd>
        <dt>Address</dt><dd>(06673) 4F, Union Bldg. 88, Seocho-daero, Seocho-gu, Seoul, Republic of Korea</dd>
    </div>
</div>
@endsection
