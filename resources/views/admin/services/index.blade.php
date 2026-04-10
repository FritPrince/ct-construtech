@extends('layouts.admin')

@section('title', 'Services')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div>
        <h1 class="ct-page-title">Services</h1>
        <p class="ct-page-subtitle">Gérez les services proposés par CT ConstruTech</p>
    </div>
    <a href="{{ route('admin.services.create') }}" class="btn-ct-primary">
        <i class="fa-regular fa-plus"></i> Nouveau service
    </a>
</div>

<div class="ct-card">
    <table class="ct-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Ordre</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td style="font-weight:600">{{ $service->title }}</td>
                <td style="color:#666;max-width:300px">{{ Str::limit($service->description, 80) }}</td>
                <td>{{ $service->order }}</td>
                <td>
                    @if($service->is_active)
                        <span class="ct-badge ct-badge-success">Actif</span>
                    @else
                        <span class="ct-badge ct-badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.services.show', $service) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Voir">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Modifier">
                            <i class="fa-regular fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.services.destroy', $service) }}" onsubmit="return confirm('Supprimer ce service ?')">
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
                <td colspan="6" style="text-align:center;color:#888;padding:40px">Aucun service enregistré</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
