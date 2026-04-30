@extends('layouts.app')

@section('title', 'Session expirée — CT ConstruTech')

@section('content')
<section style="min-height:60vh;display:flex;align-items:center;justify-content:center;text-align:center;padding:80px 20px">
    <div>
        <div style="font-size:72px;font-weight:900;color:#fd0100;line-height:1">419</div>
        <h2 style="font-size:24px;font-weight:700;margin:16px 0 8px">Session expirée</h2>
        <p style="color:#888;font-size:15px;margin-bottom:32px">Votre session a expiré. Veuillez actualiser la page et réessayer.</p>
        <a href="{{ url()->previous() }}" style="display:inline-block;background:#fd0100;color:#fff;padding:12px 32px;border-radius:8px;text-decoration:none;font-weight:700;font-size:15px">← Retour</a>
    </div>
</section>
@endsection
