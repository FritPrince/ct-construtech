@extends('layouts.admin')

@section('title', 'Formations')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div>
        <h1 class="ct-page-title">Formations</h1>
        <p class="ct-page-subtitle">Gérez le catalogue de formations</p>
    </div>
    <a href="{{ route('admin.formations.create') }}" class="btn-ct-primary">
        <i class="fa-regular fa-plus"></i> Nouvelle formation
    </a>
</div>

<div class="ct-card">
    <table class="ct-table">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Catégorie</th>
                <th>Prix</th>
                <th>Note</th>
                <th>Mis en avant</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($formations as $formation)
            <tr>
                <td style="font-weight:600">{{ $formation->title }}</td>
                <td style="color:#666">{{ $formation->category->name ?? '—' }}</td>
                <td style="font-weight:600;color:var(--ct-red)">€{{ number_format($formation->price, 2) }}</td>
                <td>
                    <span style="color:#f59e0b">★</span>
                    {{ number_format($formation->average_rating, 1) }}
                </td>
                <td>
                    @if($formation->is_featured)
                        <span class="ct-badge ct-badge-info">Oui</span>
                    @else
                        <span style="color:#ccc;font-size:12px">—</span>
                    @endif
                </td>
                <td>
                    @if($formation->is_active)
                        <span class="ct-badge ct-badge-success">Actif</span>
                    @else
                        <span class="ct-badge ct-badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.formations.show', $formation) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Voir">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.formations.edit', $formation) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Modifier">
                            <i class="fa-regular fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.formations.destroy', $formation) }}" onsubmit="return confirm('Supprimer cette formation ?')">
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
                <td colspan="7" style="text-align:center;color:#888;padding:40px">Aucune formation enregistrée</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
