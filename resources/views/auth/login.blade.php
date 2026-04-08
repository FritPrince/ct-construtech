<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion — CT ConstructTech Admin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/template/assets/img/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('storage/template/assets/css/bootstrap.min.css') }}">
    <style>
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            background: #111111;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .login-card {
            background: #1a1a1a;
            border: 1px solid rgba(255,255,255,0.07);
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 24px 60px rgba(0,0,0,0.5);
        }

        .login-brand {
            text-align: center;
            margin-bottom: 32px;
        }

        .brand-mark {
            width: 56px; height: 56px;
            background: #fd0100;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 900;
            color: #fff;
            margin-bottom: 14px;
        }

        .login-title {
            color: #fff;
            font-size: 22px;
            font-weight: 800;
            margin: 0 0 4px;
        }

        .login-subtitle {
            color: #666;
            font-size: 13px;
            margin: 0;
        }

        .form-label {
            font-size: 13px;
            font-weight: 600;
            color: #aaa;
            margin-bottom: 6px;
            display: block;
        }

        .form-control {
            width: 100%;
            background: #111;
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 11px 14px;
            font-size: 14px;
            color: #fff;
            outline: none;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #fd0100;
            box-shadow: 0 0 0 3px rgba(253,1,0,0.15);
        }

        .form-control::placeholder { color: #444; }

        .error-text {
            color: #f87171;
            font-size: 12px;
            margin-top: 5px;
        }

        .btn-login {
            width: 100%;
            background: #fd0100;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 8px;
        }

        .btn-login:hover { background: #c80000; }

        .remember-wrap {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 20px;
        }

        .remember-wrap label {
            color: #888;
            font-size: 13px;
            cursor: pointer;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #555;
            font-size: 13px;
            text-decoration: none;
        }

        .back-link a:hover { color: #fd0100; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-brand">
            <div class="brand-mark">CT</div>
            <h1 class="login-title">Administration</h1>
            <p class="login-subtitle">CT ConstructTech — Accès réservé</p>
        </div>

        @if($errors->any())
        <div style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);border-radius:8px;padding:10px 14px;margin-bottom:20px;color:#f87171;font-size:13px">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="/login">
            @csrf

            <div style="margin-bottom:16px">
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email') }}" placeholder="admin@example.com"
                       autocomplete="email" required>
            </div>

            <div style="margin-bottom:16px">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control"
                       placeholder="••••••••"
                       autocomplete="current-password" required>
            </div>

            <div class="remember-wrap">
                <input type="checkbox" name="remember" id="remember" value="1">
                <label for="remember">Se souvenir de moi</label>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home') }}">← Retour au site</a>
        </div>
    </div>
</body>
</html>
