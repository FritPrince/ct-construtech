@extends('layouts.admin')

@section('title', $service->title)

@section('content')

<div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
    <div>
        <h1 class="ct-page-title">{{ $service->title }}</h1>
        <p class="ct-page-subtitle" style="margin:0">
            <a href="{{ route('admin.services.index') }}" style="color:var(--ct-red)">Services</a>
            / {{ $service->title }}
        </p>
    </div>
    <div style="display:flex;gap:8px">
        <a href="{{ route('admin.services.edit', $service) }}" class="btn-ct-primary">
            <i class="fa-regular fa-pen-to-square"></i> Modifier
        </a>
        <a href="{{ route('admin.services.index') }}" class="btn-ct-outline">
            <i class="fa-regular fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="ct-card">
            <div class="ct-card-header">
                <h2 class="ct-card-title">Informations du service</h2>
                <span class="ct-badge {{ $service->is_active ? 'ct-badge-success' : 'ct-badge-danger' }}">
                    {{ $service->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>
            <div class="ct-card-body">
                <div style="margin-bottom:20px">
                    <div class="ct-form-label">Titre</div>
                    <div style="font-size:20px;font-weight:700;color:#111">{{ $service->title }}</div>
                </div>
                <div style="margin-bottom:20px">
                    <div class="ct-form-label">Description</div>
                    <p style="color:#444;line-height:1.7;margin:0">{{ $service->description }}</p>
                </div>
                <div style="display:flex;gap:24px;flex-wrap:wrap">
                    <div>
                        <div class="ct-form-label">Ordre d'affichage</div>
                        <div style="font-size:14px;color:#555">{{ $service->order }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="row g-3">

            {{-- Icon --}}
            @if($service->icon)
            @php $iconExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($service->icon); @endphp
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-header"><h2 class="ct-card-title">Icône</h2></div>
                    <div class="ct-card-body" style="text-align:center">
                        @if($iconExists)
                        <img src="{{ asset('storage/' . $service->icon) }}"
                             style="max-height:64px;max-width:64px;object-fit:contain"
                             alt="icon">
                        @else
                        <div style="width:64px;height:64px;border-radius:12px;background:#f8f9fa;display:inline-flex;align-items:center;justify-content:center">
                            <i class="fa-regular fa-image" style="font-size:22px;color:#ccc"></i>
                        </div>
                        @endif
                        <div style="font-size:10px;color:#bbb;margin-top:8px;word-break:break-all">{{ $service->icon }}</div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Feature image --}}
            @if($service->image)
            @php $imageExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($service->image); @endphp
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-header"><h2 class="ct-card-title">Image feature</h2></div>
                    <div class="ct-card-body" style="padding:0">
                        @if($imageExists)
                        <img src="{{ asset('storage/' . $service->image) }}"
                             style="width:100%;border-radius:0 0 14px 14px;object-fit:cover;max-height:200px;display:block"
                             alt="{{ $service->title }}">
                        @else
                        <div style="background:#f8f9fa;border-radius:0 0 14px 14px;height:120px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">
                            <i class="fa-regular fa-image" style="font-size:28px;color:#ccc"></i>
                            <span style="font-size:11px;color:#bbb">Fichier introuvable</span>
                            <span style="font-size:10px;color:#ddd;word-break:break-all;padding:0 12px;text-align:center">{{ $service->image }}</span>
                        </div>
                        @endif
                        @if($service->image_text)
                        <p style="font-size:12px;color:#888;margin:0;padding:10px 14px;font-style:italic">{{ $service->image_text }}</p>
                        @endif
                    </div>
                </div>
            </div>
            @endif

            {{-- Actions --}}
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-body" style="display:flex;flex-direction:column;gap:8px">
                        <a href="{{ route('services.show', $service) }}" target="_blank" class="btn-ct-outline" style="justify-content:center">
                            <i class="fa-regular fa-arrow-up-right-from-square"></i> Voir sur le site
                        </a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" data-no-loader
                              onsubmit="return confirm('Supprimer ce service ?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="width:100%;background:none;border:1px solid #fee2e2;color:#dc2626;border-radius:8px;padding:8px 16px;font-size:13px;cursor:pointer;font-weight:500">
                                <i class="fa-regular fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
