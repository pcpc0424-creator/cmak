@extends('layouts.sub')

@section('title', 'ConsMa - 한국CM협회')
@section('category', '협회업무')
@section('category-link', '/cmak/business/consma')
@section('page-title', 'ConsMa')

@section('side-menu')
    @include('business._side-menu')
@endsection

@php
    $editions = [
        ['year' => '2025', 'img' => 'consma_img2025.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA16/intro.html'],
        ['year' => '2023', 'img' => 'consma_img2023.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA15/intro.html'],
        ['year' => '2020', 'img' => 'consma_img2020.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA14/intro.html'],
        ['year' => '2019', 'img' => 'consma_img2019.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA13/intro.html'],
        ['year' => '2018', 'img' => 'consma_img2018.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA12/intro.html'],
        ['year' => '2017', 'img' => 'consma_img2017.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA11/intro.html'],
        ['year' => '2016', 'img' => 'consma_img2016.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA10/intro.html'],
        ['year' => '2014', 'img' => 'consma_img2014.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA9/intro.html'],
        ['year' => '2013', 'img' => 'consma_img2013.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA8/intro.html'],
        ['year' => '2012', 'img' => 'consma_img2012.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA7/intro.html'],
        ['year' => '2011', 'img' => 'consma_img2011.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA6/intro.html'],
        ['year' => '2010', 'img' => 'consma_img2010.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA5/index.asp'],
        ['year' => '2009', 'img' => 'consma_img2009.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA4/index.html'],
        ['year' => '2008', 'img' => 'consma_img2008.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/COMSMA3/index.htm'],
        ['year' => '2007', 'img' => 'consma_img2007.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/COMSMA3/ConsMa.html'],
        ['year' => '2006', 'img' => 'consma_img2006.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/html/cm_consma_pop3.htm'],
        ['year' => '2005', 'img' => 'consma_img2005.jpg', 'popup' => '/cmak/legacy/cmak_popup/consma/CONSMA1/consma1_data.html'],
    ];
@endphp

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">ConsMa</h2>

    <div class="consma-list">
        @foreach($editions as $e)
            <div class="consma-banner" style="background-image:url('/cmak/images/business/consma/{{ $e['img'] }}');">
                <a href="{{ $e['popup'] }}" target="_blank" class="consma-btn">자세히 보기</a>
            </div>
        @endforeach
    </div>
</div>

<style>
    .consma-list { display:flex; flex-direction:column; gap:20px; margin-top:20px; }
    .consma-banner {
        width: 100%;
        padding-top: 39%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        border: 1px solid #e8ecf1;
        border-radius: 6px;
    }
    .consma-btn {
        position: absolute;
        right: 20px;
        bottom: 20px;
        padding: 8px 18px;
        background: rgba(0,97,194,0.9);
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        font-size: 13px;
        font-weight: 600;
    }
    .consma-btn:hover { background: #0061c2; }
</style>
@endsection
