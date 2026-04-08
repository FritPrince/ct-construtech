@php
    // Réutilise les variables définies dans app.blade.php si disponibles
    $hPhone     = $sitePhone    ?? \App\Models\CompanySetting::get('phone');
    $hEmail     = $siteEmail    ?? \App\Models\CompanySetting::get('email');
    $hAddress   = $siteAddress  ?? \App\Models\CompanySetting::get('address');
    $hFacebook  = $siteFacebook ?? (\App\Models\CompanySetting::get('facebook_url')  ?? '#');
    $hInstagram = $siteInsta    ?? (\App\Models\CompanySetting::get('instagram_url') ?? '#');
    $hTwitter   = $siteTwitter  ?? (\App\Models\CompanySetting::get('twitter_url')   ?? '#');
    $hYoutube   = $siteYoutube  ?? \App\Models\CompanySetting::get('youtube_url');
@endphp
<!-- header-area-start -->
<header class="header sticky-active">
    <div class="primary-header">
        <div class="container">
            <div class="primary-header-inner">
                <div class="header-left-wrap">
                    <div class="header-logo d-lg-block">
                        <a href="{{ route('home') }}">
                            @isset($logoUrl)
                            <img src="{{ $logoUrl }}" alt="logo" style="max-height:98px;width:auto">
                            @else
                            <img src="{{ asset('storage/template/assets/img/logo/logo-2.png') }}" alt="logo">
                            @endisset
                        </a>
                    </div>
                    <div class="header-menu-wrap">
                        <div class="mobile-menu-items">
                            <ul>
                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                    <a href="{{ route('home') }}">Accueil</a>
                                </li>
                                <li class="{{ request()->routeIs('services') ? 'active' : '' }}">
                                    <a href="{{ route('services') }}">Services</a>
                                </li>
                                <li class="{{ request()->routeIs('portfolio') ? 'active' : '' }}">
                                    <a href="{{ route('portfolio') }}">Projets</a>
                                </li>
                                <li class="{{ request()->routeIs('formation') ? 'active' : '' }}">
                                    <a href="{{ route('formation') }}">Formations</a>
                                </li>
                                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a href="{{ route('contact') }}">Contacts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.header-menu-wrap -->
                </div>
                <div class="header-right-wrap">
                    @if($hPhone)
                    <a href="tel:{{ $hPhone }}" class="header-contact">
                        <span class="icon"><i class="fa-regular fa-phone"></i></span>
                        <span class="content">
                            <span class="call-text">Appelez-nous</span>
                            <span class="call-number">{{ $hPhone }}</span>
                        </span>
                    </a>
                    @endif
                    <div class="header-btn-wrap">
                        <a href="{{ route('contact') }}" class="tl-primary-btn header-btn">Nous contacter</a>
                    </div>
                    <div class="search-icon dl-search-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <button class="theme-toggle" id="themeToggle" title="Changer de thème" aria-label="Basculer thème clair/sombre">
                        <span class="icon-moon">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/>
                            </svg>
                        </span>
                        <span class="icon-sun">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="5"/>
                                <line x1="12" y1="1" x2="12" y2="3"/>
                                <line x1="12" y1="21" x2="12" y2="23"/>
                                <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/>
                                <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                                <line x1="1" y1="12" x2="3" y2="12"/>
                                <line x1="21" y1="12" x2="23" y2="12"/>
                                <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/>
                                <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                            </svg>
                        </span>
                    </button>
                    <div class="sidebar-icon">
                        <button class="sidebar-trigger open">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 2C11 0.89543 11.8954 0 13 0H14C15.1046 0 16 0.895431 16 2V3C16 4.10457 15.1046 5 14 5H13C11.8954 5 11 4.10457 11 3V2Z" fill="white"/>
                                <path d="M0 2C0 0.89543 0.895431 0 2 0H3C4.10457 0 5 0.895431 5 2V3C5 4.10457 4.10457 5 3 5H2C0.89543 5 0 4.10457 0 3V2Z" fill="white"/>
                                <path d="M0 13C0 11.8954 0.895431 11 2 11H3C4.10457 11 5 11.8954 5 13V14C5 15.1046 4.10457 16 3 16H2C0.89543 16 0 15.1046 0 14V13Z" fill="white"/>
                                <path d="M11 13C11 11.8954 11.8954 11 13 11H14C15.1046 11 16 11.8954 16 13V14C16 15.1046 15.1046 16 14 16H13C11.8954 16 11 15.1046 11 14V13Z" fill="white"/>
                            </svg>
                        </button>
                    </div>
                    <!-- /.header-right -->
                </div>
            </div>
            <!-- /.primary-header-inner -->
        </div>
    </div>
</header>
<!-- /.Main Header -->
