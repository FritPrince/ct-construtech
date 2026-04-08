@extends('layouts.admin')

@section('title', 'Portfolio')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div>
        <h1 class="ct-page-title">Portfolio / Projets</h1>
        <p class="ct-page-subtitle">Gérez les projets réalisés par CT ConstructTech</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="btn-ct-primary">
        <i class="fa-regular fa-plus"></i> Nouveau projet
    </a>
</div>

<div class="ct-card">
    <table class="ct-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Localisation</th>
                <th>Année</th>
                <th>Catégories</th>
                <th>Mis en avant</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
            <tr>
                <td style="font-weight:600">{{ $project->title }}</td>
                <td style="color:#666">{{ $project->location ?? '—' }}</td>
                <td>{{ $project->year ?? '—' }}</td>
                <td style="font-size:12px">{{ $project->categories->pluck('name')->join(', ') ?: '—' }}</td>
                <td>
                    @if($project->is_featured)
                        <span class="ct-badge ct-badge-info">Oui</span>
                    @else
                        <span style="color:#ccc;font-size:12px">—</span>
                    @endif
                </td>
                <td>
                    @if($project->is_active)
                        <span class="ct-badge ct-badge-success">Actif</span>
                    @else
                        <span class="ct-badge ct-badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.projects.show', $project) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Voir">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.projects.edit', $project) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Modifier">
                            <i class="fa-regular fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Supprimer ce projet ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-ct-outline" style="padding:5px 10px;font-size:12px;color:#dc2626;border-color:#dc2626" title="Supprimer">
                                <i class="fa-regular fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:#888;padding:40px">Aucun projet enregistré</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
