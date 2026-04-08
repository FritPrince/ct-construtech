@extends('layouts.admin')

@section('title', isset($service) ? 'Modifier le service' : 'Nouveau service')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">{{ isset($service) ? 'Modifier le service' : 'Nouveau service' }}</h1>
    <p class="ct-page-subtitle"><a href="{{ route('admin.services.index') }}" style="color:var(--ct-red)">Services</a> / {{ isset($service) ? $service->title : 'Nouveau' }}</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-body">
        <form method="POST" action="{{ isset($service) ? route('admin.services.update', $service) : route('admin.services.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($service)) @method('PUT') @endif

            <div class="mb-3">
                <label class="ct-form-label">Titre <span style="color:var(--ct-red)">*</span></label>
                <input type="text" name="title" class="ct-form-control" value="{{ old('title', $service->title ?? '') }}" required>
                @error('title')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Description <span style="color:var(--ct-red)">*</span></label>
                <textarea name="description" class="ct-form-control" rows="4" required>{{ old('description', $service->description ?? '') }}</textarea>
                @error('description')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Icône</label>
                    @if(isset($service) && $service->icon)
                    <div style="margin-bottom:8px;display:flex;align-items:center;gap:10px">
                        <img src="{{ asset('storage/' . $service->icon) }}" style="height:48px;width:48px;object-fit:contain;border-radius:6px;border:1px solid #e0e0e0;background:#f9f9f9;padding:4px" alt="icon actuel">
                        <small style="color:#999;font-size:11px">Remplacer :</small>
                    </div>
                    @endif
                    <input type="file" name="icon" class="ct-form-control" accept="image/*">
                    @error('icon')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Ordre</label>
                    <input type="number" name="order" class="ct-form-control" value="{{ old('order', $service->order ?? 0) }}" min="0">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Statut</label>
                    <select name="is_active" class="ct-form-control">
                        <option value="1" {{ old('is_active', $service->is_active ?? true) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('is_active', $service->is_active ?? true) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Image de la section feature</label>
                @if(isset($service) && $service->image)
                <div style="margin-bottom:8px">
                    <img src="{{ asset('storage/' . $service->image) }}" style="max-height:100px;border-radius:8px;border:1px solid #e0e0e0" alt="image actuelle">
                    <small style="color:#999;display:block;margin-top:4px;font-size:11px">Image actuelle — téléchargez-en une nouvelle pour la remplacer.</small>
                </div>
                @endif
                <input type="file" name="image" class="ct-form-control" accept="image/*">
                @error('image')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="mb-4">
                <label class="ct-form-label">Texte de l'image</label>
                <input type="text" name="image_text" class="ct-form-control" value="{{ old('image_text', $service->image_text ?? '') }}">
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn-ct-primary">
                    <i class="fa-regular fa-check"></i>
                    {{ isset($service) ? 'Mettre à jour' : 'Créer le service' }}
                </button>
                <a href="{{ route('admin.services.index') }}" class="btn-ct-outline">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
