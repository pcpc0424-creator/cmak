@php $base = '/cmak'; @endphp
<a href="{{ $base }}/community/faq" class="{{ request()->is('*/community/faq') ? 'active' : '' }}">FAQ</a>
<a href="{{ $base }}/community/board" class="{{ request()->is('*/community/board') ? 'active' : '' }}">자유게시판</a>
<a href="{{ $base }}/community/job-offer" class="{{ request()->is('*/community/job-offer') ? 'active' : '' }}">구인</a>
<a href="{{ $base }}/community/job-seek" class="{{ request()->is('*/community/job-seek') ? 'active' : '' }}">구직</a>
