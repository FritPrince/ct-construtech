@php
    $hEmail    = $siteEmail    ?? \App\Models\CompanySetting::get('email');
    $hLinkedin = $siteLinkedin ?? \App\Models\CompanySetting::get('linkedin_url');
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
                            <span style="font-size:18px;font-weight:800;color:#fff">CT ConstruTech</span>
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
                    <!-- /.header-right -->
                </div>
            </div>
            <!-- /.primary-header-inner -->
        </div>
    </div>
</header>
<!-- /.Main Header -->
