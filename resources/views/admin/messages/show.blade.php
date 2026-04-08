@extends('layouts.admin')

@section('title', 'Message de ' . $message->full_name)

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">Message de {{ $message->full_name }}</h1>
    <p class="ct-page-subtitle"><a href="{{ route('admin.messages.index') }}" style="color:var(--ct-red)">Messages</a> / Détail</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-header">
        <h2 class="ct-card-title">Informations de contact</h2>
        <span class="ct-badge {{ $message->is_read ? 'ct-badge-success' : 'ct-badge-warning' }}">
            {{ $message->is_read ? 'Lu' : 'Non lu' }}
        </span>
    </div>
    <div class="ct-card-body">
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div style="font-size:12px;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px">Nom complet</div>
                <div style="font-weight:600">{{ $message->full_name }}</div>
            </div>
            <div class="col-md-6">
                <div style="font-size:12px;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px">Email</div>
                <a href="mailto:{{ $message->email }}" style="color:var(--ct-red)">{{ $message->email }}</a>
            </div>
            <div class="col-md-6">
                <div style="font-size:12px;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px">Téléphone</div>
                <div>{{ $message->phone ?? '—' }}</div>
            </div>
            <div class="col-md-6">
                <div style="font-size:12px;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px">Service demandé</div>
                <div>{{ $message->service ?? '—' }}</div>
            </div>
            <div class="col-md-6">
                <div style="font-size:12px;color:#888;margin-bottom:4px;text-transform:uppercase;letter-spacing:0.5px">Date de réception</div>
                <div>{{ $message->created_at->format('d/m/Y à H:i') }}</div>
            </div>
        </div>

        <div style="margin-bottom:24px">
            <div style="font-size:12px;color:#888;margin-bottom:8px;text-transform:uppercase;letter-spacing:0.5px">Message</div>
            <div style="background:#f8f9fa;border-radius:8px;padding:16px;font-size:14px;line-height:1.7;color:#333">
                {{ $message->message }}
            </div>
        </div>

        <div style="display:flex;gap:10px">
            <a href="mailto:{{ $message->email }}" class="btn-ct-primary">
                <i class="fa-regular fa-envelope"></i>
                Répondre par email
            </a>
            @if(!$message->is_read)
            <form method="POST" action="{{ route('admin.messages.read', $message) }}">
                @csrf @method('PATCH')
                <button type="submit" class="btn-ct-outline">
                    <i class="fa-regular fa-check"></i>
                    Marquer comme lu
                </button>
            </form>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="btn-ct-outline">
                <i class="fa-regular fa-arrow-left"></i>
                Retour
            </a>
        </div>
    </div>
</div>

@endsection
