@extends('layouts.admin')

@section('title', isset($slider) ? 'Modifier le slider' : 'Nouveau slider')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">{{ isset($slider) ? 'Modifier le slider' : 'Nouveau slider' }}</h1>
    <p class="ct-page-subtitle"><a href="{{ route('admin.sliders.index') }}" style="color:var(--ct-red)">Sliders</a> / {{ isset($slider) ? $slider->title : 'Nouveau' }}</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-body">
        <form method="POST" action="{{ isset($slider) ? route('admin.sliders.update', $slider) : route('admin.sliders.store') }}" enctype="multipart/form-data">
            @csrf
            @if(isset($slider)) @method('PUT') @endif

            <div class="mb-3">
                <label class="ct-form-label">Titre principal <span style="color:var(--ct-red)">*</span></label>
                <input type="text" name="title" class="ct-form-control" value="{{ old('title', $slider->title ?? '') }}" required placeholder="ex : L'excellence en architecture et ingénierie">
                @error('title')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Sous-titre <small style="color:#999">(badge au-dessus du titre)</small></label>
                <input type="text" name="subtitle" class="ct-form-control" value="{{ old('subtitle', $slider->subtitle ?? '') }}" placeholder="ex : Rapide et fiable">
                @error('subtitle')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Description</label>
                <textarea name="description" class="ct-form-control" rows="3" placeholder="Texte d'accroche sous le titre...">{{ old('description', $slider->description ?? '') }}</textarea>
                @error('description')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Image de fond <span style="color:var(--ct-red)">{{ isset($slider) ? '' : '*' }}</span> <small style="color:#999">(recommandé : 1920×1080px)</small></label>
                @if(isset($slider) && $slider->image)
                <div style="margin-bottom:8px">
                    <img src="{{ asset('storage/' . $slider->image) }}" style="max-height:140px;width:100%;object-fit:cover;border-radius:8px;border:1px solid #e0e0e0" alt="image actuelle">
                    <small style="color:#999;display:block;margin-top:4px;font-size:11px">Image actuelle — téléchargez-en une nouvelle pour la remplacer.</small>
                </div>
                @endif
                <input type="file" name="image" class="ct-form-control" accept="image/*" {{ isset($slider) ? '' : 'required' }}>
                @error('image')<div style="color:#dc2626;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Texte du bouton CTA</label>
                    <input type="text" name="cta_label" class="ct-form-control" value="{{ old('cta_label', $slider->cta_label ?? '') }}" placeholder="ex : Prendre conseil">
                </div>
                <div class="col-md-6">
                    <label class="ct-form-label">Lien du bouton CTA</label>
                    <input type="text" name="cta_url" class="ct-form-control" value="{{ old('cta_url', $slider->cta_url ?? '') }}" placeholder="ex : /contact">
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="ct-form-label">Ordre d'affichage</label>
                    <input type="number" name="order" class="ct-form-control" value="{{ old('order', $slider->order ?? 0) }}" min="0">
                </div>
                <div class="col-md-6">
                    <label class="ct-form-label">Statut</label>
                    <select name="is_active" class="ct-form-control">
                        <option value="1" {{ old('is_active', $slider->is_active ?? true) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('is_active', $slider->is_active ?? true) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;gap:10px">
                <button type="submit" class="btn-ct-primary">
                    <i class="fa-regular fa-check"></i>
                    {{ isset($slider) ? 'Mettre à jour' : 'Créer le slider' }}
                </button>
                <a href="{{ route('admin.sliders.index') }}" class="btn-ct-outline">Annuler</a>
            </div>
        </form>
    </div>
</div>

@endsection
