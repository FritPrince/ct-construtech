@extends('layouts.admin')

@section('title', isset($project) ? 'Modifier le projet' : 'Nouveau projet')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">{{ isset($project) ? 'Modifier le projet' : 'Nouveau projet' }}</h1>
    <p class="ct-page-subtitle"><a href="{{ route('admin.projects.index') }}" style="color:var(--ct-red)">Portfolio</a> / {{ isset($project) ? $project->title : 'Nouveau' }}</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-body">
        <form method="POST" action="{{ isset($project) ? route('admin.projects.update', $project) : route('admin.projects.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($project)) @method('PUT') @endif

            <div class="mb-3">
                <label class="ct-form-label">Titre <span style="color:var(--ct-red)">*</span></label>
                <input type="text" name="title" class="ct-form-control" value="{{ old('title', $project->title ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Description</label>
                <textarea name="description" class="ct-form-control" rows="3">{{ old('description', $project->description ?? '') }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Localisation</label>
                    <input type="text" name="location" class="ct-form-control" value="{{ old('location', $project->location ?? '') }}" placeholder="Berlin, Germany">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Année</label>
                    <input type="number" name="year" class="ct-form-control" value="{{ old('year', $project->year ?? date('Y')) }}" min="2000" max="2099">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Ordre</label>
                    <input type="number" name="order" class="ct-form-control" value="{{ old('order', $project->order ?? 0) }}" min="0">
                </div>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Image <span style="color:var(--ct-red)">{{ isset($project) ? '' : '*' }}</span></label>
                @if(isset($project) && $project->image)
                <div style="margin-bottom:8px">
                    <img src="{{ asset('storage/' . $project->image) }}" style="max-height:120px;border-radius:8px;border:1px solid #e0e0e0" alt="image actuelle">
                    <small style="color:#999;display:block;margin-top:4px;font-size:11px">Image actuelle — téléchargez-en une nouvelle pour la remplacer.</small>
                </div>
                @endif
                <input type="file" name="image" class="ct-form-control" accept="image/*" {{ isset($project) ? '' : 'required' }}>
                @error('image')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Catégories</label>
                <div style="display:flex;flex-wrap:wrap;gap:10px;padding:12px;border:1px solid #e0e0e0;border-radius:8px">
                    @foreach($categories as $cat)
                    <label style="display:flex;align-items:center;gap:6px;font-size:13px;cursor:pointer">
                        <input type="checkbox" name="categories[]" value="{{ $cat->id }}"
                               {{ in_array($cat->id, old('categories', isset($project) ? $project->categories->pluck('id')->toArray() : [])) ? 'checked' : '' }}>
                        {{ $cat->name }}
                    </label>
                    @endforeach
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="ct-form-label">Mis en avant</label>
                    <select name="is_featured" class="ct-form-control">
                        <option value="0" {{ !old('is_featured', $project->is_featured ?? false) ? 'selected' : '' }}>Non</option>
                        <option value="1" {{ old('is_featured', $project->is_featured ?? false) ? 'selected' : '' }}>Oui</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="ct-form-label">Statut</label>
                    <select name="is_active" class="ct-form-control">
                        <option value="1" {{ old('is_active', $project->is_active ?? true) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('is_active', $project->is_active ?? true) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn-ct-primary">
                    <i class="fa-regular fa-check"></i>
                    {{ isset($project) ? 'Mettre à jour' : 'Créer le projet' }}
                </button>
                <a href="{{ route('admin.projects.index') }}" class="btn-ct-outline">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
