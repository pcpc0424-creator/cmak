@extends('layouts.sub')

@section('title', '조직도 - 한국CM협회')
@section('category', '협회소개')
@section('category-link', '/intro/greeting')
@section('page-title', '조직도')

@section('side-menu')
    @include('intro._side-menu')
@endsection

@section('content')
<div class="sub-content-card">
    <h2 class="sub-content-title">조직도</h2>
    <p class="sub-content-desc">한국CM협회의 조직구성과 부서별 업무를 안내합니다.</p>

    {{-- 조직도 비주얼 --}}
    <div style="text-align:center; margin-bottom:40px;">
        <div style="display:inline-flex; flex-direction:column; align-items:center; gap:0;">
            {{-- 회장 --}}
            <div style="background:linear-gradient(135deg, #0a3d7c, #0061c2); color:#fff; padding:14px 40px; border-radius:8px; font-size:16px; font-weight:700;">
                회 장
            </div>
            <div style="width:2px; height:20px; background:#0061c2;"></div>

            {{-- 부회장 --}}
            <div style="background:#2d6da8; color:#fff; padding:10px 32px; border-radius:6px; font-size:14px; font-weight:600;">
                부회장
            </div>
            <div style="width:2px; height:20px; background:#aaa;"></div>

            {{-- 사무국 --}}
            <div style="background:#4e5761; color:#fff; padding:10px 32px; border-radius:6px; font-size:14px; font-weight:600;">
                사무국장
            </div>
            <div style="width:2px; height:20px; background:#aaa;"></div>

            {{-- 부서들 --}}
            <div style="display:flex; gap:12px; flex-wrap:wrap; justify-content:center;">
                @php
                    $depts = [
                        ['name' => '기획부', 'duties' => ['경영기획·예산', '총무·인사', '회계·세무', '이사회·총회', '홍보·대외업무']],
                        ['name' => '사업부', 'duties' => ['CM제도 운영', 'CM능력평가', '건설산업 동향', 'CMP 자격검정']],
                        ['name' => '정책부', 'duties' => ['CM정책 연구', 'CM실적 관리', '능력평가·공시', '제도 개선 건의']],
                        ['name' => '교육부', 'duties' => ['CM전문교육', '세미나·포럼', '인력양성', '교육과정 개발']],
                        ['name' => '연구부', 'duties' => ['건설정보 조사', 'CM기술 연구', '발간물 관리', '데이터 분석']],
                    ];
                @endphp
                @foreach($depts as $dept)
                    <div style="border:1px solid #dde3ed; border-radius:8px; width:170px; overflow:hidden;">
                        <div style="background:#f0f4fa; padding:10px; text-align:center; font-weight:700; font-size:14px; color:#0a3d7c; border-bottom:1px solid #dde3ed;">
                            {{ $dept['name'] }}
                        </div>
                        <ul style="padding:10px 14px; margin:0; list-style:none;">
                            @foreach($dept['duties'] as $duty)
                                <li style="font-size:12.5px; color:#555; padding:3px 0; border-bottom:1px dotted #eee;">{{ $duty }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- 원본 사이트 이미지 (보조) --}}
    <div style="text-align:center;">
        <img src="https://www.cmak.or.kr/img/intro/partjob.jpg"
             alt="부서별 업무안내"
             class="sub-img-content"
             style="max-width:100%; border-radius:8px;"
             onerror="this.style.display='none'">
    </div>
</div>
@endsection
