@extends('layouts.admin')

@section('title', $formation->title)

@section('content')

<div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
    <div>
        <h1 class="ct-page-title">{{ $formation->title }}</h1>
        <p class="ct-page-subtitle" style="margin:0">
            <a href="{{ route('admin.formations.index') }}" style="color:var(--ct-red)">Formations</a>
            / {{ $formation->title }}
        </p>
    </div>
    <div style="display:flex;gap:8px">
        <a href="{{ route('admin.formations.edit', $formation) }}" class="btn-ct-primary">
            <i class="fa-regular fa-pen-to-square"></i> Modifier
        </a>
        <a href="{{ route('admin.formations.index') }}" class="btn-ct-outline">
            <i class="fa-regular fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">
        <div class="ct-card">
            <div class="ct-card-header">
                <h2 class="ct-card-title">Détails de la formation</h2>
                <div style="display:flex;gap:8px">
                    @if($formation->is_featured)
                    <span class="ct-badge ct-badge-info">En vedette</span>
                    @endif
                    <span class="ct-badge {{ $formation->is_active ? 'ct-badge-success' : 'ct-badge-danger' }}">
                        {{ $formation->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="ct-card-body">
                <div style="margin-bottom:20px">
                    <div class="ct-form-label">Titre</div>
                    <div style="font-size:20px;font-weight:700;color:#111">{{ $formation->title }}</div>
                </div>
                @if($formation->description)
                <div style="margin-bottom:20px">
                    <div class="ct-form-label">Description</div>
                    <p style="color:#444;line-height:1.7;margin:0">{{ $formation->description }}</p>
                </div>
                @endif
                <div style="display:flex;gap:32px;flex-wrap:wrap">
                    <div>
                        <div class="ct-form-label">Prix</div>
                        <div style="font-size:22px;font-weight:800;color:var(--ct-red)">
                            {{ number_format($formation->price, 2, ',', ' ') }} €
                        </div>
                    </div>
                    <div>
                        <div class="ct-form-label">Note moyenne</div>
                        <div style="font-size:16px;font-weight:600;color:#f59e0b">
                            ★ {{ number_format($formation->average_rating, 1) }} / 5
                        </div>
                    </div>
                    <div>
                        <div class="ct-form-label">Catégorie</div>
                        <div style="font-size:14px;color:#555">
                            {{ $formation->category->name ?? '—' }}
                        </div>
                    </div>
                    <div>
                        <div class="ct-form-label">Ordre</div>
                        <div style="font-size:14px;color:#555">{{ $formation->order }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="row g-3">

            {{-- Image --}}
            @if($formation->image)
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-header"><h2 class="ct-card-title">Image</h2></div>
                    <div class="ct-card-body" style="padding:0">
                        <img src="{{ asset('storage/' . $formation->image) }}"
                             style="width:100%;max-height:200px;object-fit:cover;border-radius:0 0 14px 14px;display:block"
                             alt="{{ $formation->title }}">
                    </div>
                </div>
            </div>
            @endif

            {{-- Actions --}}
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-body" style="display:flex;flex-direction:column;gap:8px">
                        <a href="{{ route('formation') }}" target="_blank" class="btn-ct-outline" style="justify-content:center">
                            <i class="fa-regular fa-arrow-up-right-from-square"></i> Voir les formations
                        </a>
                        <form method="POST" action="{{ route('admin.formations.destroy', $formation) }}" data-no-loader
                              onsubmit="return confirm('Supprimer cette formation ?')">
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
