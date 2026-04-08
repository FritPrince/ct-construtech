<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion — CT ConstructTech</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/template/assets/img/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            display: flex;
            background: #f5f5f5;
        }

        /* ── PANNEAU GAUCHE — Formulaire ──────────────────────── */
        .login-left {
            width: 100%;
            max-width: 520px;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 64px;
            position: relative;
            z-index: 2;
            box-shadow: 4px 0 40px rgba(0,0,0,0.06);
        }

        .login-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 48px;
        }

        .logo-mark {
            width: 44px;
            height: 44px;
            background: #fd0100;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -0.5px;
            flex-shrink: 0;
        }

        .logo-text {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }

        .logo-name {
            font-size: 15px;
            font-weight: 800;
            color: #111;
            letter-spacing: -0.3px;
        }

        .logo-sub {
            font-size: 11px;
            font-weight: 500;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .login-heading {
            margin-bottom: 8px;
        }

        .login-heading h1 {
            font-size: 28px;
            font-weight: 800;
            color: #111;
            letter-spacing: -0.5px;
            line-height: 1.2;
        }

        .login-heading p {
            font-size: 14px;
            color: #888;
            margin-top: 6px;
            font-weight: 400;
        }

        .divider {
            height: 1px;
            background: #f0f0f0;
            margin: 28px 0;
        }

        .alert-error {
            background: #fff5f5;
            border: 1px solid #fecaca;
            border-left: 3px solid #fd0100;
            border-radius: 8px;
            padding: 12px 16px;
            color: #991b1b;
            font-size: 13px;
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #555;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #bbb;
            font-size: 15px;
            pointer-events: none;
        }

        .form-control {
            width: 100%;
            border: 1.5px solid #e8e8e8;
            border-radius: 10px;
            padding: 12px 14px 12px 42px;
            font-size: 14px;
            font-family: inherit;
            color: #111;
            background: #fafafa;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
        }

        .form-control:focus {
            border-color: #fd0100;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(253,1,0,0.08);
        }

        .form-control::placeholder { color: #ccc; }

        .form-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-label {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 13px;
            color: #666;
            font-weight: 500;
        }

        .remember-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #fd0100;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            background: #fd0100;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 14px;
            font-size: 15px;
            font-weight: 700;
            font-family: inherit;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
            letter-spacing: 0.2px;
            box-shadow: 0 4px 16px rgba(253,1,0,0.25);
        }

        .btn-login:hover {
            background: #d10000;
            box-shadow: 0 6px 20px rgba(253,1,0,0.35);
        }

        .btn-login:active { transform: scale(0.99); }

        .back-link {
            text-align: center;
            margin-top: 28px;
        }

        .back-link a {
            font-size: 13px;
            color: #aaa;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .back-link a:hover { color: #fd0100; }

        /* ── PANNEAU DROIT — Visuel architecture ──────────────── */
        .login-right {
            flex: 1;
            background: #0d0d0d;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 60px;
        }

        /* Grille architecturale en fond */
        .login-right::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(253,1,0,0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(253,1,0,0.06) 1px, transparent 1px);
            background-size: 48px 48px;
        }

        /* Dégradé rouge diagonal */
        .login-right::after {
            content: '';
            position: absolute;
            bottom: -120px;
            right: -120px;
            width: 480px;
            height: 480px;
            background: radial-gradient(circle, rgba(253,1,0,0.18) 0%, transparent 70%);
            pointer-events: none;
        }

        .visual-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 440px;
        }

        /* Illustration architecturale CSS */
        .arch-illustration {
            width: 280px;
            height: 280px;
            margin: 0 auto 40px;
            position: relative;
        }

        /* Bâtiment central */
        .building-main {
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 180px;
            background: linear-gradient(180deg, #fd0100 0%, #7a0000 100%);
            border-radius: 4px 4px 0 0;
        }

        .building-main::before {
            content: '';
            position: absolute;
            top: 0; left: 50%;
            transform: translateX(-50%);
            width: 12px;
            height: 24px;
            background: #fd0100;
            border-radius: 2px 2px 0 0;
        }

        /* Fenêtres bâtiment principal */
        .building-main::after {
            content: '';
            position: absolute;
            top: 20px; left: 12px; right: 12px;
            bottom: 20px;
            background-image:
                repeating-linear-gradient(
                    180deg,
                    rgba(255,255,255,0.12) 0px,
                    rgba(255,255,255,0.12) 8px,
                    transparent 8px,
                    transparent 18px
                );
        }

        /* Bâtiment gauche */
        .building-left {
            position: absolute;
            bottom: 0;
            left: 30px;
            width: 55px;
            height: 130px;
            background: linear-gradient(180deg, #2a2a2a 0%, #1a1a1a 100%);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 3px 3px 0 0;
        }

        .building-left::after {
            content: '';
            position: absolute;
            top: 15px; left: 8px; right: 8px;
            bottom: 15px;
            background-image:
                repeating-linear-gradient(
                    180deg,
                    rgba(253,1,0,0.2) 0px,
                    rgba(253,1,0,0.2) 6px,
                    transparent 6px,
                    transparent 14px
                ),
                repeating-linear-gradient(
                    90deg,
                    rgba(253,1,0,0.2) 0px,
                    rgba(253,1,0,0.2) 1px,
                    transparent 1px,
                    transparent 14px
                );
        }

        /* Bâtiment droite */
        .building-right {
            position: absolute;
            bottom: 0;
            right: 30px;
            width: 55px;
            height: 110px;
            background: linear-gradient(180deg, #222 0%, #161616 100%);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: 3px 3px 0 0;
        }

        .building-right::after {
            content: '';
            position: absolute;
            top: 15px; left: 8px; right: 8px;
            bottom: 15px;
            background-image:
                repeating-linear-gradient(
                    180deg,
                    rgba(255,255,255,0.07) 0px,
                    rgba(255,255,255,0.07) 6px,
                    transparent 6px,
                    transparent 14px
                );
        }

        /* Sol */
        .ground {
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, transparent, #fd0100, transparent);
            opacity: 0.6;
        }

        /* Cercle décoratif */
        .deco-circle {
            position: absolute;
            top: 20px;
            right: 30px;
            width: 60px;
            height: 60px;
            border: 2px solid rgba(253,1,0,0.3);
            border-radius: 50%;
        }

        .deco-circle::after {
            content: '';
            position: absolute;
            inset: 8px;
            border: 1px solid rgba(253,1,0,0.2);
            border-radius: 50%;
        }

        /* Points lumineux */
        .dot {
            position: absolute;
            width: 6px;
            height: 6px;
            background: #fd0100;
            border-radius: 50%;
            box-shadow: 0 0 8px rgba(253,1,0,0.8);
        }

        .dot-1 { top: 40px; left: 40px; }
        .dot-2 { top: 80px; right: 60px; opacity: 0.6; width: 4px; height: 4px; }
        .dot-3 { bottom: 60px; left: 20px; opacity: 0.4; width: 4px; height: 4px; }

        /* Lignes décoratives */
        .line-h {
            position: absolute;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(253,1,0,0.4), transparent);
        }

        .line-h-1 { top: 40px; left: 0; right: 0; }
        .line-h-2 { top: 100px; left: 20px; right: 20px; opacity: 0.3; }

        .visual-title {
            font-size: 26px;
            font-weight: 800;
            color: #fff;
            line-height: 1.25;
            letter-spacing: -0.5px;
            margin-bottom: 14px;
        }

        .visual-title span {
            color: #fd0100;
        }

        .visual-desc {
            font-size: 14px;
            color: rgba(255,255,255,0.45);
            line-height: 1.7;
            font-weight: 400;
        }

        /* ── Pastilles stats en bas du visuel ────────────────── */
        .visual-stats {
            display: flex;
            gap: 16px;
            margin-top: 40px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .stat-pill {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 40px;
            padding: 10px 20px;
            text-align: center;
        }

        .stat-pill .val {
            font-size: 18px;
            font-weight: 800;
            color: #fd0100;
            line-height: 1;
        }

        .stat-pill .lbl {
            font-size: 11px;
            color: rgba(255,255,255,0.4);
            margin-top: 3px;
            font-weight: 500;
        }

        /* ── Responsive ───────────────────────────────────────── */
        @media (max-width: 900px) {
            .login-right { display: none; }
            .login-left  { max-width: 100%; padding: 40px 28px; }
        }

        @media (max-width: 400px) {
            .login-left { padding: 32px 20px; }
        }
    </style>
</head>
<body>

    {{-- ── PANNEAU FORMULAIRE ──────────────────────────────── --}}
    <div class="login-left">

        <div class="login-logo">
            <div class="logo-mark">CT</div>
            <div class="logo-text">
                <span class="logo-name">CT ConstructTech</span>
                <span class="logo-sub">Administration</span>
            </div>
        </div>

        <div class="login-heading">
            <h1>Connexion</h1>
            <p>Accédez à votre espace d'administration</p>
        </div>

        <div class="divider"></div>

        @if($errors->any())
        <div class="alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div class="form-group">
                <label class="form-label">Adresse email</label>
                <div class="input-wrap">
                    <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}"
                           placeholder="admin@construtech.com"
                           autocomplete="email" required>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <div class="input-wrap">
                    <svg class="input-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <input type="password" name="password" class="form-control"
                           placeholder="••••••••"
                           autocomplete="current-password" required>
                </div>
            </div>

            <div class="form-row">
                <label class="remember-label">
                    <input type="checkbox" name="remember" value="1">
                    Se souvenir de moi
                </label>
            </div>

            <button type="submit" class="btn-login">
                Se connecter →
            </button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← Retour au site</a>
        </div>
    </div>

    {{-- ── PANNEAU VISUEL ───────────────────────────────────── --}}
    <div class="login-right">

        <div class="visual-content">

            <div class="arch-illustration">
                <div class="line-h line-h-1"></div>
                <div class="line-h line-h-2"></div>
                <div class="dot dot-1"></div>
                <div class="dot dot-2"></div>
                <div class="dot dot-3"></div>
                <div class="deco-circle"></div>
                <div class="building-left"></div>
                <div class="building-right"></div>
                <div class="building-main"></div>
                <div class="ground"></div>
            </div>

            <h2 class="visual-title">
                Façonnons des espaces<br>
                <span>qui inspirent</span>
            </h2>
            <p class="visual-desc">
                Gérez vos projets, services et formations<br>
                depuis un seul tableau de bord intuitif.
            </p>

            <div class="visual-stats">
                <div class="stat-pill">
                    <div class="val">5★</div>
                    <div class="lbl">Qualité</div>
                </div>
                <div class="stat-pill">
                    <div class="val">100%</div>
                    <div class="lbl">Sécurisé</div>
                </div>
                <div class="stat-pill">
                    <div class="val">24/7</div>
                    <div class="lbl">Disponible</div>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
