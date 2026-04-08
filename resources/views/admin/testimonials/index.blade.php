@extends('layouts.admin')

@section('title', 'Témoignages')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div>
        <h1 class="ct-page-title">Témoignages</h1>
        <p class="ct-page-subtitle">Gérez les avis et témoignages clients</p>
    </div>
    <a href="{{ route('admin.testimonials.create') }}" class="btn-ct-primary">
        <i class="fa-regular fa-plus"></i> Nouveau témoignage
    </a>
</div>

<div class="ct-card">
    <table class="ct-table">
        <thead>
            <tr>
                <th>Auteur</th>
                <th>Rôle</th>
                <th>Contenu</th>
                <th>Note</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($testimonials as $testi)
            <tr>
                <td style="font-weight:600">{{ $testi->author_name }}</td>
                <td style="color:#666">{{ $testi->author_role ?? '—' }}</td>
                <td style="color:#666;max-width:250px">{{ Str::limit($testi->content, 70) }}</td>
                <td>
                    <span style="color:#f59e0b">★</span>
                    {{ number_format($testi->rating, 1) }}
                </td>
                <td>
                    @if($testi->is_active)
                        <span class="ct-badge ct-badge-success">Actif</span>
                    @else
                        <span class="ct-badge ct-badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.testimonials.show', $testi) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Voir">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.testimonials.edit', $testi) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Modifier">
                            <i class="fa-regular fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.testimonials.destroy', $testi) }}" onsubmit="return confirm('Supprimer ce témoignage ?')">
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
                <td colspan="6" style="text-align:center;color:#888;padding:40px">Aucun témoignage enregistré</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
