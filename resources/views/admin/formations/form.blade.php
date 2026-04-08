@extends('layouts.admin')

@section('title', isset($formation) ? 'Modifier la formation' : 'Nouvelle formation')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">{{ isset($formation) ? 'Modifier la formation' : 'Nouvelle formation' }}</h1>
    <p class="ct-page-subtitle"><a href="{{ route('admin.formations.index') }}" style="color:var(--ct-red)">Formations</a> / {{ isset($formation) ? $formation->title : 'Nouvelle' }}</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-body">
        <form method="POST" action="{{ isset($formation) ? route('admin.formations.update', $formation) : route('admin.formations.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($formation)) @method('PUT') @endif

            <div class="mb-3">
                <label class="ct-form-label">Titre <span style="color:var(--ct-red)">*</span></label>
                <input type="text" name="title" class="ct-form-control" value="{{ old('title', $formation->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Description</label>
                <textarea name="description" class="ct-form-control" rows="3">{{ old('description', $formation->description ?? '') }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Catégorie</label>
                    <select name="formation_category_id" class="ct-form-control">
                        <option value="">— Aucune —</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('formation_category_id', $formation->formation_category_id ?? '') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Prix (€) <span style="color:var(--ct-red)">*</span></label>
                    <input type="number" name="price" class="ct-form-control" value="{{ old('price', $formation->price ?? '') }}" step="0.01" min="0" required>
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Note moy.</label>
                    <input type="number" name="average_rating" class="ct-form-control" value="{{ old('average_rating', $formation->average_rating ?? 5.0) }}" step="0.1" min="0" max="5">
                </div>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Image</label>
                @if(isset($formation) && $formation->image)
                <div style="margin-bottom:8px">
                    <img src="{{ asset('storage/' . $formation->image) }}" style="max-height:100px;border-radius:8px;border:1px solid #e0e0e0" alt="image actuelle">
                    <small style="color:#999;display:block;margin-top:4px;font-size:11px">Image actuelle — téléchargez-en une nouvelle pour la remplacer.</small>
                </div>
                @endif
                <input type="file" name="image" class="ct-form-control" accept="image/*">
                @error('image')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <label class="ct-form-label">Ordre</label>
                    <input type="number" name="order" class="ct-form-control" value="{{ old('order', $formation->order ?? 0) }}" min="0">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Mis en avant</label>
                    <select name="is_featured" class="ct-form-control">
                        <option value="0" {{ !old('is_featured', $formation->is_featured ?? false) ? 'selected' : '' }}>Non</option>
                        <option value="1" {{ old('is_featured', $formation->is_featured ?? false) ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Statut</label>
                    <select name="is_active" class="ct-form-control">
                        <option value="1" {{ old('is_active', $formation->is_active ?? true) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('is_active', $formation->is_active ?? true) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn-ct-primary">
                    <i class="fa-regular fa-check"></i>
                    {{ isset($formation) ? 'Mettre à jour' : 'Créer la formation' }}
                </button>
                <a href="{{ route('admin.formations.index') }}" class="btn-ct-outline">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
