@extends('layouts.admin')

@section('title', $project->title)

@section('content')

<div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
    <div>
        <h1 class="ct-page-title">{{ $project->title }}</h1>
        <p class="ct-page-subtitle" style="margin:0">
            <a href="{{ route('admin.projects.index') }}" style="color:var(--ct-red)">Portfolio</a>
            / {{ $project->title }}
        </p>
    </div>
    <div style="display:flex;gap:8px">
        <a href="{{ route('admin.projects.edit', $project) }}" class="btn-ct-primary">
            <i class="fa-regular fa-pen-to-square"></i> Modifier
        </a>
        <a href="{{ route('admin.projects.index') }}" class="btn-ct-outline">
            <i class="fa-regular fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="row g-3">
    <div class="col-lg-8">

        {{-- Main image --}}
        @if($project->image)
        <div class="ct-card" style="margin-bottom:16px">
            <img src="{{ asset('storage/' . $project->image) }}"
                 style="width:100%;max-height:380px;object-fit:cover;display:block"
                 alt="{{ $project->title }}">
        </div>
        @endif

        <div class="ct-card">
            <div class="ct-card-header">
                <h2 class="ct-card-title">Détails du projet</h2>
                <div style="display:flex;gap:8px">
                    @if($project->is_featured)
                    <span class="ct-badge ct-badge-info">En vedette</span>
                    @endif
                    <span class="ct-badge {{ $project->is_active ? 'ct-badge-success' : 'ct-badge-danger' }}">
                        {{ $project->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
            </div>
            <div class="ct-card-body">
                <div style="margin-bottom:20px">
                    <div class="ct-form-label">Titre</div>
                    <div style="font-size:20px;font-weight:700;color:#111">{{ $project->title }}</div>
                </div>
                @if($project->description)
                <div style="margin-bottom:20px">
                    <div class="ct-form-label">Description</div>
                    <p style="color:#444;line-height:1.7;margin:0">{{ $project->description }}</p>
                </div>
                @endif
                <div style="display:flex;gap:32px;flex-wrap:wrap">
                    @if($project->location)
                    <div>
                        <div class="ct-form-label">Localisation</div>
                        <div style="font-size:14px;color:#555"><i class="fa-regular fa-location-dot" style="color:#aaa;margin-right:4px"></i>{{ $project->location }}</div>
                    </div>
                    @endif
                    @if($project->year)
                    <div>
                        <div class="ct-form-label">Année</div>
                        <div style="font-size:14px;color:#555"><i class="fa-regular fa-calendar" style="color:#aaa;margin-right:4px"></i>{{ $project->year }}</div>
                    </div>
                    @endif
                    <div>
                        <div class="ct-form-label">Ordre</div>
                        <div style="font-size:14px;color:#555">{{ $project->order }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="row g-3">

            {{-- Categories --}}
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-header"><h2 class="ct-card-title">Catégories</h2></div>
                    <div class="ct-card-body">
                        @forelse($project->categories as $cat)
                        <span class="ct-badge ct-badge-info" style="margin:3px">{{ $cat->name }}</span>
                        @empty
                        <span style="color:#aaa;font-size:13px">Aucune catégorie</span>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="col-12">
                <div class="ct-card">
                    <div class="ct-card-body" style="display:flex;flex-direction:column;gap:8px">
                        <a href="{{ route('portfolio.show', $project) }}" target="_blank" class="btn-ct-outline" style="justify-content:center">
                            <i class="fa-regular fa-arrow-up-right-from-square"></i> Voir sur le site
                        </a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" data-no-loader
                              onsubmit="return confirm('Supprimer ce projet ?')">
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
