<!DOCTYPE html>
<html class="no-js" lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('meta_description', '')">

    <title>@yield('title', 'CT ConstructTech')</title>

    @php
        $siteSettings = \App\Models\CompanySetting::pluck('value', 'key');
        $siteLogo  = $siteSettings['logo'] ?? null;
        $logoUrl   = ($siteLogo && \Illuminate\Support\Facades\Storage::disk('public')->exists($siteLogo))
                     ? asset("storage/{$siteLogo}")
                     : null;
        $sitePhone    = $siteSettings['phone']         ?? null;
        $siteEmail    = $siteSettings['email']         ?? null;
        $siteAddress  = $siteSettings['address']       ?? null;
        $siteFacebook = $siteSettings['facebook_url']  ?? '#';
        $siteInsta    = $siteSettings['instagram_url'] ?? '#';
        $siteTwitter  = $siteSettings['twitter_url']   ?? '#';
        $siteYoutube  = $siteSettings['youtube_url']   ?? null;
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ $logoUrl ?? asset('storage/template/assets/img/favicon.png') }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/venobox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/odometer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/carouselTicker.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/twentytwenty.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/custom.css') }}">

    @yield('styles')

    <style>
        /* ── Fix VenoBox : bouton fermer et navigation ────────── */
        .vbox-overlay {
            pointer-events: all !important;
        }
        .vbox-close,
        .vbox-next,
        .vbox-prev,
        .vbox-left-corner {
            pointer-events: all !important;
            z-index: 1000000 !important;
            position: fixed !important;
        }
        /* Quand la lightbox est ouverte, bloquer le scroll du smoother */
        body.vbox-open #antra-smooth-wrapper,
        body.vbox-open #antra-smooth-content {
            pointer-events: none !important;
        }
    </style>

    {{-- Appliqué avant le rendu pour éviter le flash de thème --}}
    <script>
        (function () {
            var saved = localStorage.getItem('ct-theme') || 'light';
            document.documentElement.setAttribute('data-theme', saved);
        })();
    </script>
</head>

<body>

    <!-- preloader -->
    <div class="preloader overflow-hidden">
        <div class="site-name"><span>CT ConstructTech</span></div>
        <div class="preloader-gutters">
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
            <div class="bar"><div class="inner-bar"></div></div>
        </div>
    </div>
    <!-- /.preloader -->

    @include('partials.header')

    <div id="popup-search-box">
        <div class="box-inner-wrap d-flex align-items-center">
            <form id="form" action="#" method="get" role="search">
                <input id="popup-search" type="text" name="s" placeholder="Rechercher...">
            </form>
            <div class="search-close"><i class="fa-sharp fa-regular fa-xmark"></i></div>
        </div>
    </div>
    <!-- /#popup-search-box -->

    <div id="sidebar-area" class="sidebar-area">
        <button class="sidebar-trigger close">
            <svg class="sidebar-close" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" width="16px" height="12.7px" viewBox="0 0 16 12.7"
                style="enable-background: new 0 0 16 12.7" xml:space="preserve">
                <g>
                    <rect x="0" y="5.4" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.1569 7.5208)" width="16" height="2"></rect>
                    <rect x="0" y="5.4" transform="matrix(0.7071 0.7071 -0.7071 0.7071 6.8431 -3.7929)" width="16" height="2"></rect>
                </g>
            </svg>
        </button>
        <div class="side-menu-content">
            <div class="side-menu-logo">
                <a class="dark-img" href="{{ route('home') }}"><img src="{{ $logoUrl ?? asset('storage/template/assets/img/logo/logo-2.png') }}" alt="logo" style="{{ $logoUrl ? 'max-height:98px;width:auto' : '' }}"></a>
                <a class="light-img" href="{{ route('home') }}"><img src="{{ $logoUrl ?? asset('storage/template/assets/img/logo/logo-1.png') }}" alt="logo" style="{{ $logoUrl ? 'max-height:98px;width:auto' : '' }}"></a>
            </div>
            <div class="side-menu-wrap"></div>
            <div class="side-menu-about">
                <h4 class="title">Nous façonnons des espaces intemporels et inspirants</h4>
            </div>
            <div class="side-menu-gallary">
                <div class="side-menu-gallary-item">
                    <a href="{{ asset('storage/template/assets/img/project/sidebar-gallary-1.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('storage/template/assets/img/project/sidebar-gallary-1.png') }}" alt="img"></a>
                </div>
                <div class="side-menu-gallary-item">
                    <a href="{{ asset('storage/template/assets/img/project/sidebar-gallary-2.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('storage/template/assets/img/project/sidebar-gallary-2.png') }}" alt="img"></a>
                </div>
                <div class="side-menu-gallary-item">
                    <a href="{{ asset('storage/template/assets/img/project/sidebar-gallary-3.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('storage/template/assets/img/project/sidebar-gallary-3.png') }}" alt="img"></a>
                </div>
                <div class="side-menu-gallary-item">
                    <a href="{{ asset('storage/template/assets/img/project/sidebar-gallary-4.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('storage/template/assets/img/project/sidebar-gallary-4.png') }}" alt="img"></a>
                </div>
                <div class="side-menu-gallary-item">
                    <a href="{{ asset('storage/template/assets/img/project/sidebar-gallary-5.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('storage/template/assets/img/project/sidebar-gallary-5.png') }}" alt="img"></a>
                </div>
                <div class="side-menu-gallary-item">
                    <a href="{{ asset('storage/template/assets/img/project/sidebar-gallary-6.png') }}" class="venobox" data-gall="gallary1"><img src="{{ asset('storage/template/assets/img/project/sidebar-gallary-6.png') }}" alt="img"></a>
                </div>
            </div>
            <div class="side-menu-contact">
                <ul class="side-menu-list">
                    @if($siteAddress)<li>{{ $siteAddress }}</li>@endif
                    @if($sitePhone)<li><a href="tel:{{ $sitePhone }}">{{ $sitePhone }}</a></li>@endif
                    @if($siteEmail)<li><a class="mail" href="mailto:{{ $siteEmail }}">{{ $siteEmail }}</a></li>@endif
                </ul>
            </div>
            <ul class="side-menu-social">
                <li class="facebook"><a href="{{ $siteFacebook }}"><i class="fab fa-facebook-f"></i></a></li>
                <li class="instagram"><a href="{{ $siteInsta }}"><i class="fab fa-instagram"></i></a></li>
                <li class="twitter"><a href="{{ $siteTwitter }}"><i class="fab fa-twitter"></i></a></li>
                @if($siteYoutube)<li class="youtube"><a href="{{ $siteYoutube }}"><i class="fab fa-youtube"></i></a></li>@endif
            </ul>
        </div>
    </div>
    <!--/.sidebar-area-->
    <div id="sidebar-overlay"></div>

    <div class="mobile-side-menu">
        <div class="side-menu-content">
            <div class="side-menu-head">
                <a href="{{ route('home') }}"><img src="{{ $logoUrl ?? asset('storage/template/assets/img/logo/logo-2.png') }}" alt="logo" style="{{ $logoUrl ? 'max-height:40px;width:auto' : '' }}"></a>
                <button class="mobile-side-menu-close"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <div class="side-menu-wrap"></div>
            <div class="side-menu-contact">
                <div class="side-menu-header">
                    <h3>Contactez-nous</h3>
                </div>
                <ul class="side-menu-list">
                    @if($siteAddress)
                    <li>
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{ $siteAddress }}</p>
                    </li>
                    @endif
                    @if($sitePhone)
                    <li>
                        <i class="fas fa-phone"></i>
                        <a href="tel:{{ $sitePhone }}">{{ $sitePhone }}</a>
                    </li>
                    @endif
                    @if($siteEmail)
                    <li>
                        <i class="fas fa-envelope-open-text"></i>
                        <a href="mailto:{{ $siteEmail }}">{{ $siteEmail }}</a>
                    </li>
                    @endif
                </ul>
            </div>
            <ul class="side-menu-social">
                <li class="facebook"><a href="{{ $siteFacebook }}"><i class="fab fa-facebook-f"></i></a></li>
                <li class="instagram"><a href="{{ $siteInsta }}"><i class="fab fa-instagram"></i></a></li>
                <li class="twitter"><a href="{{ $siteTwitter }}"><i class="fab fa-twitter"></i></a></li>
                @if($siteYoutube)<li class="youtube"><a href="{{ $siteYoutube }}"><i class="fab fa-youtube"></i></a></li>@endif
            </ul>
        </div>
    </div>
    <!-- /.mobile-side-menu -->
    <div class="mobile-side-menu-overlay"></div>

    <div id="antra-smooth-wrapper">
        <div id="antra-smooth-content">

            @yield('content')

            @include('partials.footer')

        </div>
    </div>

    <div id="scroll-percentage"><span id="scroll-percentage-value"></span></div>

    <!-- JS -->
    <script src="{{ asset('storage/template/assets/js/vendor/jquary-3.7.1.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/bootstrap-bundle.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/imagesloaded-pkgd.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/venobox.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/odometer.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/meanmenu.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/jquery.isotope.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/swiper.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/split-type.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/gsap.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/scroll-trigger.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/scroll-smoother.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/jquery.carouselTicker.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/nice-select.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/three.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/panolens.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/jquery.event.move.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/vendor/jquery.twentytwenty.min.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/slider.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/banner-process.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/contact.js') }}"></script>
    <script src="{{ asset('storage/template/assets/js/main.js') }}"></script>

    @yield('scripts')

    <script>
        // Thème clair / sombre
        (function () {
            var btn = document.getElementById('themeToggle');
            if (!btn) return;

            btn.addEventListener('click', function () {
                var current = document.documentElement.getAttribute('data-theme') || 'light';
                var next    = current === 'light' ? 'dark' : 'light';
                document.documentElement.setAttribute('data-theme', next);
                localStorage.setItem('ct-theme', next);
            });
        })();
    </script>

</body>
</html>
