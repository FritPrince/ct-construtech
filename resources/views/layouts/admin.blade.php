<!DOCTYPE html>
<html lang="fr" data-bs-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — CT ConstruTech</title>

    @php
        $adminLogo    = \App\Models\CompanySetting::get('logo');
        $adminLogoUrl = ($adminLogo && \Illuminate\Support\Facades\Storage::disk('public')->exists($adminLogo))
                        ? asset("storage/{$adminLogo}")
                        : null;
    @endphp
    <link rel="shortcut icon" type="image/x-icon" href="{{ $adminLogoUrl ?? asset('storage/template/assets/img/favicon.png') }}">

    <!-- Skydash vendors -->
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('admin-assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <!-- Skydash main CSS -->
    <link rel="stylesheet" href="{{ asset('admin-assets/css/style.css') }}">
    <!-- Font Awesome (nos icônes fa-regular) -->
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/fontawesome.min.css') }}">

    <style>
        /* ── Accent couleur CT ──────────────────────────────────── */
        :root {
            --ct-red: #fd0100;
        }

        /* ── Override couleurs primaires Skydash → rouge CT ───── */
        .sidebar .nav .nav-item.active > .nav-link,
        .sidebar .nav .nav-item.active > .nav-link i,
        .sidebar .nav .nav-item.active > .nav-link .menu-title {
            color: #ffffff !important;
        }
        .sidebar .nav .nav-item:hover > .nav-link,
        .sidebar .nav .nav-item:hover > .nav-link i,
        .sidebar .nav .nav-item:hover > .nav-link .menu-title {
            color: #ffffff !important;
        }
        .sidebar .nav .nav-item.active > .nav-link::before {
            background: var(--ct-red);
        }
        .btn-primary, .badge.badge-primary, .bg-primary {
            background-color: var(--ct-red) !important;
            border-color: var(--ct-red) !important;
        }
        .text-primary { color: var(--ct-red) !important; }

        /* ── Navbar brand logo / texte ────────────────────────── */
        .navbar .navbar-brand-wrapper .brand-text {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--ct-red);
            letter-spacing: 0.5px;
        }
        .navbar .navbar-brand-wrapper .brand-sub {
            font-size: 0.65rem;
            color: #999;
            display: block;
            line-height: 1;
        }

        /* ── Loader barre ─────────────────────────────────────── */
        #ct-loader-bar {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            width: 0%;
            background: var(--ct-red);
            z-index: 9999;
            transition: none;
        }
        #ct-loader-bar.running {
            box-shadow: 0 0 8px rgba(253,1,0,0.6);
        }

        /* ── Composants CT (conservés pour les vues existantes) ── */
        .ct-page-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0 0 2px;
            color: inherit;
        }
        .ct-page-subtitle {
            font-size: 13px;
            color: #888;
        }

        .ct-card {
            border-radius: 12px;
            background: var(--bs-card-bg, #fff);
            border: 1px solid var(--bs-border-color, rgba(0,0,0,0.08));
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            overflow: hidden;
        }
        .ct-card-header {
            padding: 16px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--bs-border-color, rgba(0,0,0,0.07));
        }
        .ct-card-title {
            font-size: 14px;
            font-weight: 700;
            margin: 0;
            color: inherit;
        }
        .ct-card-body { padding: 20px; }

        .ct-form-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #888;
            margin-bottom: 6px;
        }
        .ct-form-control {
            width: 100%;
            border: 1px solid var(--bs-border-color, #e3e5e8);
            border-radius: 8px;
            padding: 9px 12px;
            font-size: 14px;
            color: inherit;
            background: var(--bs-body-bg, #fff);
            transition: border-color 0.2s;
            outline: none;
            font-family: inherit;
        }
        .ct-form-control:focus { border-color: var(--ct-red); }

        .btn-ct-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--ct-red);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.2s, opacity 0.2s;
        }
        .btn-ct-primary:hover { background: #c80000; color: #fff; text-decoration: none; }

        .btn-ct-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: inherit;
            border: 1px solid var(--bs-border-color, #e3e5e8);
            border-radius: 8px;
            padding: 9px 18px;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            text-decoration: none;
            transition: border-color 0.2s;
        }
        .btn-ct-outline:hover { border-color: var(--ct-red); color: var(--ct-red); text-decoration: none; }

        .ct-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }
        .ct-badge-success { background: #dcfce7; color: #166534; }
        .ct-badge-danger  { background: #fee2e2; color: #991b1b; }
        .ct-badge-info    { background: #dbeafe; color: #1e40af; }
        .ct-badge-warning { background: #fef9c3; color: #854d0e; }


        .ct-alert {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .ct-alert-success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .ct-alert-danger  { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }


        /* ── Tableau admin ─────────────────────────────────────── */
        .ct-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13.5px;
        }
        .ct-table th {
            padding: 10px 14px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.7px;
            color: #888;
            border-bottom: 1px solid var(--bs-border-color, rgba(0,0,0,0.07));
        }
        .ct-table td {
            padding: 12px 14px;
            border-bottom: 1px solid var(--bs-border-color, rgba(0,0,0,0.05));
            vertical-align: middle;
            color: inherit;
        }
        .ct-table tr:last-child td { border-bottom: none; }
        .ct-table tr:hover td { background: var(--bs-tertiary-bg, rgba(0,0,0,0.02)); }

        /* ── Stat card (dashboard) ─────────────────────────────── */
        .ct-stat-card {
            border-radius: 12px;
            background: var(--bs-card-bg, #fff);
            border: 1px solid var(--bs-border-color, rgba(0,0,0,0.07));
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            padding: 20px;
            position: relative;
            overflow: hidden;
        }
        .ct-stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: var(--accent, #fd0100);
        }
        .ct-stat-icon {
            width: 44px; height: 44px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
            background: var(--icon-bg, rgba(253,1,0,0.1));
            color: var(--icon-color, #fd0100);
            margin-bottom: 12px;
        }
        .ct-stat-value {
            font-size: 1.8rem;
            font-weight: 800;
            line-height: 1;
            color: inherit;
        }
        .ct-stat-label {
            font-size: 12px;
            color: #888;
            margin-top: 4px;
        }
    </style>
</head>

<body>

<div class="container-scroller">

    {{-- ── NAVBAR ────────────────────────────────────────────── --}}
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">

        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
            <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
                @if($adminLogoUrl)
                <img src="{{ $adminLogoUrl }}" alt="logo" style="height:36px;width:auto;object-fit:contain">
                @else
                <div style="display:flex;flex-direction:column;line-height:1.1">
                    <span class="brand-text">CT ConstruTech</span>
                    <span class="brand-sub">Administration</span>
                </div>
                @endif
            </a>
        </div>

        <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                <span class="icon-menu"></span>
            </button>

            <ul class="navbar-nav navbar-nav-right">

                {{-- Messages non lus --}}
                @php $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count(); @endphp
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}" title="Messages" style="position:relative">
                        <i class="mdi mdi-email-outline" style="font-size:20px"></i>
                        @if($unreadCount > 0)
                        <span style="position:absolute;top:6px;right:4px;background:var(--ct-red);color:#fff;font-size:9px;font-weight:700;border-radius:10px;padding:1px 5px;line-height:1.4">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </li>

{{-- Voir le site --}}
                <li class="nav-item d-none d-lg-flex align-items-center" style="margin-right:8px">
                    <a href="{{ route('home') }}" target="_blank" class="btn-ct-outline" style="padding:6px 14px;font-size:12px">
                        <i class="mdi mdi-open-in-new"></i> Site web
                    </a>
                </li>

                {{-- Profil / Déconnexion --}}
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" id="profileDropdown" style="display:flex;align-items:center;gap:8px">
                        <div style="width:32px;height:32px;background:var(--ct-red);border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-size:13px;flex-shrink:0">
                            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                        </div>
                        <span class="d-none d-lg-inline" style="font-size:13px;font-weight:600">{{ auth()->user()->name ?? 'Admin' }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown" aria-labelledby="profileDropdown">
                        <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                            <i class="mdi mdi-cog-outline me-2 text-primary"></i> Paramètres
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0" data-no-loader>
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="mdi mdi-logout me-2 text-primary"></i> Déconnexion
                            </button>
                        </form>
                    </div>
                </li>

            </ul>

            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                <span class="icon-menu"></span>
            </button>
        </div>
    </nav>
    {{-- ── /NAVBAR ─────────────────────────────────────────────── --}}

    <div class="container-fluid page-body-wrapper">

        {{-- ── SIDEBAR ────────────────────────────────────────── --}}
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">

                <li class="nav-item nav-category">
                    <span class="nav-link" style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#aaa;cursor:default;padding-bottom:4px">Général</span>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.dashboard') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline menu-icon"></i>
                        <span class="menu-title">Tableau de bord</span>
                    </a>
                </li>

                <li class="nav-item nav-category" style="margin-top:8px">
                    <span class="nav-link" style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#aaa;cursor:default;padding-bottom:4px">Contenu</span>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.services.*') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.services.index') }}">
                        <i class="mdi mdi-briefcase-outline menu-icon"></i>
                        <span class="menu-title">Services</span>
                    </a>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.projects.*') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.projects.index') }}">
                        <i class="mdi mdi-image-multiple-outline menu-icon"></i>
                        <span class="menu-title">Portfolio</span>
                    </a>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.formations.*') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.formations.index') }}">
                        <i class="mdi mdi-school-outline menu-icon"></i>
                        <span class="menu-title">Formations</span>
                    </a>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.testimonials.*') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.testimonials.index') }}">
                        <i class="mdi mdi-star-outline menu-icon"></i>
                        <span class="menu-title">Témoignages</span>
                    </a>
                </li>

                <li class="nav-item nav-category" style="margin-top:8px">
                    <span class="nav-link" style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#aaa;cursor:default;padding-bottom:4px">Communication</span>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.messages.*') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}">
                        <i class="mdi mdi-email-outline menu-icon"></i>
                        <span class="menu-title">
                            Messages
                            @if($unreadCount > 0)
                            <span class="badge" style="background:var(--ct-red);color:#fff;font-size:10px;border-radius:10px;padding:1px 7px;margin-left:6px">{{ $unreadCount }}</span>
                            @endif
                        </span>
                    </a>
                </li>

                <li class="nav-item nav-category" style="margin-top:8px">
                    <span class="nav-link" style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#aaa;cursor:default;padding-bottom:4px">Configuration</span>
                </li>

                <li class="nav-item" data-active="{{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }}">
                    <a class="nav-link" href="{{ route('admin.settings.index') }}">
                        <i class="mdi mdi-cog-outline menu-icon"></i>
                        <span class="menu-title">Paramètres</span>
                    </a>
                </li>

            </ul>
        </nav>
        {{-- ── /SIDEBAR ─────────────────────────────────────────── --}}

        {{-- ── MAIN PANEL ─────────────────────────────────────── --}}
        <div class="main-panel">
            <div class="content-wrapper">

                {{-- Barre de loader --}}
                <div id="ct-loader-bar"></div>

                {{-- Flash messages --}}
                @if(session('success'))
                <div class="ct-alert ct-alert-success" style="margin-bottom:20px">
                    <i class="mdi mdi-check-circle-outline"></i>
                    {{ session('success') }}
                </div>
                @endif
                @if(session('error'))
                <div class="ct-alert ct-alert-danger" style="margin-bottom:20px">
                    <i class="mdi mdi-alert-circle-outline"></i>
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')

            </div>

            <footer class="footer">
                <div class="d-sm-flex justify-content-between">
                    <span class="text-muted">© {{ date('Y') }} CT ConstruTech — Administration</span>
                    <span class="text-muted d-none d-sm-inline">Géré avec <i class="mdi mdi-heart text-danger ms-1"></i></span>
                </div>
            </footer>
        </div>
        {{-- ── /MAIN PANEL ──────────────────────────────────────── --}}

    </div>
</div>

{{-- Skydash JS --}}
<script src="{{ asset('admin-assets/vendors/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('admin-assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('admin-assets/js/template.js') }}"></script>

<script>
    /* ── Correction active sidebar : template.js ajoute .active sur tous
       les items car toutes nos URLs contiennent "/admin".
       On neutralise en repartant des attributs data-active définis côté serveur. ── */
    $(function () {
        var $items = $('.sidebar .nav-item[data-active]');
        $items.removeClass('active');
        $items.filter('[data-active="true"]').addClass('active');
    });
</script>

<script>
    /* ── Loader de navigation ─────────────────────────────── */
    var Loader = {
        bar: document.getElementById('ct-loader-bar'),
        _timer: null,
        start: function () {
            var self = this;
            clearInterval(self._timer);
            self.bar.style.transition = 'none';
            self.bar.style.width = '0%';
            self.bar.classList.add('running');
            var w = 0;
            self._timer = setInterval(function () {
                if (w < 80) w += Math.random() * 12;
                else if (w < 95) w += Math.random() * 2;
                self.bar.style.transition = 'width 0.2s ease';
                self.bar.style.width = Math.min(w, 95) + '%';
            }, 200);
        },
        done: function () {
            var self = this;
            clearInterval(self._timer);
            self.bar.style.transition = 'width 0.2s ease';
            self.bar.style.width = '100%';
            setTimeout(function () {
                self.bar.classList.remove('running');
                self.bar.style.width = '0%';
            }, 300);
        }
    };

    document.addEventListener('submit', function (e) {
        if (!e.target.closest('[data-no-loader]')) Loader.start();
    });
    document.addEventListener('click', function (e) {
        var link = e.target.closest('a[href]');
        if (!link) return;
        var href = link.getAttribute('href');
        if (!href || link.target === '_blank' || href.startsWith('#') || href.startsWith('mailto:') || link.closest('[data-no-loader]')) return;
        Loader.start();
    });
    window.addEventListener('pageshow', function () { Loader.done(); });
</script>

@yield('scripts')

</body>
</html>
