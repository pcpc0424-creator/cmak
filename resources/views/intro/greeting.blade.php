@extends('layouts.sub')

@section('title', '협회장 인사말 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/intro/greeting')
@section('page-title', '협회장 인사말')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">협회장 인사말</h2>
    <p class="sub-content-desc">한국CM협회를 방문해 주셔서 감사합니다.</p>

    <div style="display:flex; gap:30px; flex-wrap:wrap;">
        <div style="flex:1; min-width:280px;">
            <div class="sub-section">
                <p>
                    안녕하십니까.<br>
                    한국CM협회 홈페이지를 방문해 주신 여러분을 진심으로 환영합니다.
                </p>
            </div>

            <div class="sub-section">
                <p>
                    한국CM협회는 1996년 설립 이래 건설사업관리(CM) 제도의 발전과 CM산업의 선진화를 위해
                    끊임없이 노력해 왔습니다. 급변하는 건설환경 속에서 CM의 역할은 더욱 중요해지고 있으며,
                    우리 협회는 회원사와 함께 건설산업의 미래를 이끌어 나가고 있습니다.
                </p>
            </div>

            <div class="sub-section">
                <p>
                    협회는 CM능력평가·공시, 건설사업관리사 자격검정, CM전문교육, 정책연구 등
                    다양한 사업을 통해 CM산업의 경쟁력을 강화하고, 회원사의 권익을 보호하며,
                    건설산업 발전에 기여하고자 합니다.
                </p>
            </div>

            <div class="sub-section">
                <p>
                    앞으로도 한국CM협회는 회원사 여러분과 함께 소통하고 협력하며,
                    대한민국 건설사업관리의 미래를 선도하는 협회가 되겠습니다.
                </p>
                <p style="margin-top:20px; font-weight:600; color:#1a1a1a;">
                    감사합니다.
                </p>
                <p style="margin-top:16px; text-align:right; font-size:16px; font-weight:700; color:#0061c2;">
                    한국CM협회 회장
                </p>
            </div>
        </div>

        <div style="flex-shrink:0; text-align:center;">
            <img src="https://www.cmak.or.kr/img/intro/greetings.jpg"
                 alt="협회장 인사말"
                 class="sub-img-content"
                 style="max-width:300px; border-radius:8px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);"
                 onerror="this.style.display='none'">
        </div>
    </div>
</div>
@endsection
