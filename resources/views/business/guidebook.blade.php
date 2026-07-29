@extends('layouts.sub')

@section('title', 'CM 업무 가이드북 - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/membership')
@section('page-title', 'CM 업무 가이드북')

@section('side-menu')
    @include('business._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">CM 업무 가이드북</h2>
    <p class="sub-content-desc">한국CM협회가 발간한 CM 업무 가이드북(개정판)입니다. 표지를 클릭하면 E-Book으로 연결됩니다.</p>

    @php
        $guidebooks = [
            ['title' => '공공 건설사업관리', 'cover' => 'mibx', 'url' => 'http://books.junglim.com/books/mibx/#p=1'],
            ['title' => '민간건설공사 CM(감리)', 'cover' => 'memd', 'url' => 'http://books.junglim.com/books/memd/#p=1'],
            ['title' => '주택건설공사감리', 'cover' => 'xibq', 'url' => 'http://books.junglim.com/books/xibq/#p=1'],
        ];
    @endphp

    <div class="guidebook-grid">
        @foreach($guidebooks as $book)
            <a href="{{ $book['url'] }}" target="_blank" rel="noopener noreferrer" class="guidebook-item">
                @php
                    // 표지를 교체해도 파일명이 같아 브라우저가 예전 이미지를 계속 쓰는 것을 막는다
                    $coverPath = public_path("images/business/guidebook/{$book['cover']}.jpg");
                    $coverVer  = is_file($coverPath) ? filemtime($coverPath) : null;
                @endphp
                <div class="guidebook-cover">
                    <img src="/cmak/images/business/guidebook/{{ $book['cover'] }}.jpg{{ $coverVer ? '?v=' . $coverVer : '' }}"
                         alt="CM 업무 가이드북(개정판) {{ $book['title'] }}">
                </div>
                <div class="guidebook-caption">
                    <strong>CM 업무 가이드북(개정판)</strong>
                    <span>{{ $book['title'] }}</span>
                </div>
            </a>
        @endforeach
    </div>
</div>

<style>
.guidebook-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 26px;
    margin-top: 26px;
}
.guidebook-item {
    display: block;
    text-decoration: none;
    color: inherit;
    transition: transform .2s, box-shadow .2s;
}
.guidebook-item:hover { transform: translateY(-4px); }
.guidebook-cover {
    border: 1px solid #e3e8ef;
    border-radius: 8px;
    overflow: hidden;
    background: #f6f8fa;
    box-shadow: 0 6px 16px rgba(10, 61, 124, 0.08);
}
.guidebook-item:hover .guidebook-cover {
    border-color: #064277;
    box-shadow: 0 10px 24px rgba(10, 61, 124, 0.18);
}
.guidebook-cover img { display: block; width: 100%; height: auto; }
.guidebook-caption {
    padding: 14px 4px 0;
    text-align: center;
}
.guidebook-caption strong {
    display: block;
    font-size: 14px;
    font-weight: 700;
    color: #064277;
    margin-bottom: 4px;
}
.guidebook-caption span {
    display: block;
    font-size: 13px;
    color: #6a7889;
}
@media (max-width: 480px) {
    .guidebook-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
}
</style>
@endsection
