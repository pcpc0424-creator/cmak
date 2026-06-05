@extends('layouts.sub')

@section('title', '협회장 인사말 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/cmak/intro/greeting')
@section('page-title', '협회장 인사말')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <div style="display:flex; gap:30px; align-items:flex-start; margin:20px 0; flex-wrap:wrap;">
        <div style="flex-shrink:0; text-align:center;">
            <img src="/cmak/images/intro/greeting_president.png"
                 alt="한국CM협회 회장 배영휘"
                 style="max-width:250px; width:100%; height:auto; border-radius:8px;">
            <p style="margin-top:10px; font-weight:700; color:#064277; font-size:15px;">한국CM협회 회장 배영휘</p>
        </div>
        <div style="flex:1; min-width:280px;">
            <h3 style="font-size:22px; color:#0061c2; margin-bottom:8px;">CM은 선택이 아닙니다.</h3>
            <p style="font-size:16px; margin-bottom:20px;">우리 협회 홈페이지에 오신 것을 환영합니다.</p>

        <p style="line-height:2;">
            우리는 일상생활에서 무슨 일이든 잘하고자 하면서도 그 일을 추진하는 과정(즉 수단과 방법)에 소홀하여 회복하지 못할 결과를 가져오는 경우가 많습니다.
        </p>
        <p style="line-height:2;">
            따라서 우리 협회는 회원이 건설시설물의 생산과정에 더욱더 열심히 참여하여 이러한 잘못을 최소화하고 우리가 원하는 최고의 시설물을 얻을 수 있도록 하는데 필수적인 CM 확대보급의 주역으로서의 기능을 여기에 오신 여러분의 성원 아래 다 하고자 합니다.
        </p>
        <p style="line-height:2;">
            즉 정확한 미래 예측에 따라 계획한 프로그램에 의하여 시설물 생산활동을 적극적으로 할 수 있도록 함으로써 CM이 설계 시공과 함께 건설산업 3대 축의 하나로 확실하게 자리매김하는 그날까지 열심히 하겠습니다.
        </p>
        <p style="line-height:2; margin-top:20px;">
            여러분의 적극적인 참여 바랍니다.
        </p>
        </div>
    </div>
</div>
@endsection
