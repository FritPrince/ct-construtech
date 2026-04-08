@extends('layouts.admin')

@section('title', isset($testimonial) ? 'Modifier le témoignage' : 'Nouveau témoignage')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">{{ isset($testimonial) ? 'Modifier le témoignage' : 'Nouveau témoignage' }}</h1>
    <p class="ct-page-subtitle"><a href="{{ route('admin.testimonials.index') }}" style="color:var(--ct-red)">Témoignages</a> / {{ isset($testimonial) ? $testimonial->author_name : 'Nouveau' }}</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-body">
        <form method="POST" action="{{ isset($testimonial) ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($testimonial)) @method('PUT') @endif

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Nom de l'auteur <span style="color:var(--ct-red)">*</span></label>
                    <input type="text" name="author_name" class="ct-form-control" value="{{ old('author_name', $testimonial->author_name ?? '') }}" required>
                </div>
                <div class="col-md-6">
                    <label class="ct-form-label">Rôle / Titre</label>
                    <input type="text" name="author_role" class="ct-form-control" value="{{ old('author_role', $testimonial->author_role ?? '') }}" placeholder="Propriétaire d'entreprise">
                </div>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Contenu du témoignage <span style="color:var(--ct-red)">*</span></label>
                <textarea name="content" class="ct-form-control" rows="4" required>{{ old('content', $testimonial->content ?? '') }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Photo de l'auteur</label>
                    @if(isset($testimonial) && $testimonial->author_photo)
                    <div style="margin-bottom:8px;display:flex;align-items:center;gap:10px">
                        <img src="{{ asset('storage/' . $testimonial->author_photo) }}" style="height:52px;width:52px;object-fit:cover;border-radius:50%;border:2px solid #e0e0e0" alt="photo actuelle">
                        <small style="color:#999;font-size:11px">Remplacer :</small>
                    </div>
                    @endif
                    <input type="file" name="author_photo" class="ct-form-control" accept="image/*">
                    @error('author_photo')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Note (0–5)</label>
                    <input type="number" name="rating" class="ct-form-control" value="{{ old('rating', $testimonial->rating ?? 5.0) }}" step="0.1" min="0" max="5">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Statut</label>
                    <select name="is_active" class="ct-form-control">
                        <option value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('is_active', $testimonial->is_active ?? true) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn-ct-primary">
                    <i class="fa-regular fa-check"></i>
                    {{ isset($testimonial) ? 'Mettre à jour' : 'Créer le témoignage' }}
                </button>
                <a href="{{ route('admin.testimonials.index') }}" class="btn-ct-outline">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
