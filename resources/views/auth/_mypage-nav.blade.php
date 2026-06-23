@php
    $active = $active ?? '';
    $tabs = [
        'home' => ['label' => '내 정보', 'url' => '/cmak/mypage'],
        'profile' => ['label' => '회원정보 수정', 'url' => '/cmak/mypage/profile'],
        'password' => ['label' => '비밀번호 변경', 'url' => '/cmak/mypage/password'],
        'posts' => ['label' => '내가 쓴 글', 'url' => '/cmak/mypage/posts'],
        'withdraw' => ['label' => '회원 탈퇴', 'url' => '/cmak/mypage/withdraw'],
    ];
@endphp
<div style="display:flex; flex-wrap:wrap; gap:6px; border-bottom:1px solid #e8ecf1; margin-bottom:24px; padding-bottom:0;">
    @foreach($tabs as $key => $tab)
        @php $isActive = ($active === $key); @endphp
        <a href="{{ $tab['url'] }}"
           style="padding:10px 16px; font-size:13.5px; text-decoration:none; border-bottom:2px solid {{ $isActive ? '#265de8' : 'transparent' }}; color:{{ $isActive ? '#265de8' : '#666' }}; font-weight:{{ $isActive ? '700' : '500' }}; margin-bottom:-1px;">
            {{ $tab['label'] }}
        </a>
    @endforeach
</div>
