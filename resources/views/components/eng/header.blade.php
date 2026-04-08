{{-- English Header --}}
@php
    $bp = '/cmak';
    $engMenus = [
        ['title' => 'About CMAK', 'link' => "$bp/eng/about/greeting", 'sub' => [
            ['title' => "Chairman's Message", 'link' => "$bp/eng/about/greeting"],
            ['title' => 'Purpose of Establishment', 'link' => "$bp/eng/about/purpose"],
            ['title' => 'History', 'link' => "$bp/eng/about/history"],
            ['title' => 'Organization', 'link' => "$bp/eng/about/organization"],
            ['title' => 'Scheme of Work', 'link' => "$bp/eng/about/scheme"],
            ['title' => 'Contact Us', 'link' => "$bp/eng/about/contact"],
        ]],
        ['title' => 'International CM Day', 'link' => "$bp/eng/cmday/introduction", 'sub' => [
            ['title' => 'Introduction', 'link' => "$bp/eng/cmday/introduction"],
            ['title' => 'Participating Members', 'link' => "$bp/eng/cmday/members"],
            ['title' => 'Celebrations', 'link' => "$bp/eng/cmday/celebrations"],
            ['title' => 'Registration', 'link' => "$bp/eng/cmday/registration"],
        ]],
        ['title' => 'IPMA Korea', 'link' => "$bp/eng/ipma/about", 'sub' => [
            ['title' => 'About', 'link' => "$bp/eng/ipma/about"],
            ['title' => 'Certification', 'link' => "$bp/eng/ipma/certification"],
            ['title' => 'Education', 'link' => "$bp/eng/ipma/education"],
            ['title' => 'News & Events', 'link' => "$bp/eng/ipma/news"],
            ['title' => 'Membership', 'link' => "$bp/eng/ipma/membership"],
            ['title' => 'Resources', 'link' => "$bp/eng/ipma/resources"],
        ]],
        ['title' => 'CMAK News', 'link' => "$bp/eng/news/publications", 'sub' => [
            ['title' => 'Publications', 'link' => "$bp/eng/news/publications"],
            ['title' => 'Educations & Seminars', 'link' => "$bp/eng/news/seminars"],
            ['title' => 'Conferences & Events', 'link' => "$bp/eng/news/conferences"],
        ]],
        ['title' => 'Membership', 'link' => "$bp/eng/membership", 'sub' => []],
    ];
@endphp

<header class="eng-header" id="engHeader" x-data="{ mobileOpen: false }">
    <div class="eng-header-inner">
        <h1 class="eng-logo">
            <a href="{{ $bp }}/eng">
                <span class="eng-logo-icon">CM</span>
                <span class="eng-logo-text">
                    <strong>CMAK</strong>
                    <em>Construction Management Association of Korea</em>
                </span>
            </a>
        </h1>

        <ul class="eng-gnb">
            @foreach($engMenus as $menu)
                <li>
                    <a href="{{ $menu['link'] }}"><span>{{ $menu['title'] }}</span></a>
                    @if(!empty($menu['sub']))
                        <div class="eng-sub-wrap">
                            <div class="eng-sub-area">
                                <div class="eng-sub-title">{{ $menu['title'] }}</div>
                                <div class="eng-sub-list">
                                    @foreach($menu['sub'] as $sub)
                                        <a href="{{ $sub['link'] }}">{{ $sub['title'] }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </li>
            @endforeach
        </ul>

        <div class="eng-header-util">
            <a href="{{ $bp }}" class="eng-lang-btn">KOR</a>
            <a href="https://www.ipma.world/" target="_blank" rel="noopener noreferrer" class="eng-special-btn">IPMA</a>
        </div>

        <button @click="mobileOpen = !mobileOpen" class="eng-mobile-btn">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    {{-- Mobile menu --}}
    <div x-show="mobileOpen" x-cloak class="eng-mobile-menu">
        <nav>
            @foreach($engMenus as $menu)
                <div x-data="{ open: false }">
                    <button @click="open = !open" class="eng-mobile-item">
                        <span>{{ $menu['title'] }}</span>
                        @if(!empty($menu['sub']))
                            <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        @endif
                    </button>
                    @if(!empty($menu['sub']))
                        <div x-show="open" x-cloak class="eng-mobile-sub">
                            @foreach($menu['sub'] as $sub)
                                <a href="{{ $sub['link'] }}">{{ $sub['title'] }}</a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </nav>
    </div>
</header>
