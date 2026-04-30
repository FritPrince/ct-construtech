@extends('layouts.admin')

@section('title', 'Sliders')

@section('content')

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px">
    <div>
        <h1 class="ct-page-title">Sliders</h1>
        <p class="ct-page-subtitle">Gérez les slides de la page d'accueil</p>
    </div>
    <a href="{{ route('admin.sliders.create') }}" class="btn-ct-primary">
        <i class="fa-regular fa-plus"></i> Nouveau slider
    </a>
</div>

@if(session('success'))
<div style="background:#dcfce7;border:1px solid #86efac;color:#166534;padding:12px 16px;border-radius:8px;margin-bottom:20px">
    {{ session('success') }}
</div>
@endif

<div class="ct-card">
    <table class="ct-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Titre</th>
                <th>Sous-titre</th>
                <th>Ordre</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($sliders as $slider)
            <tr>
                <td>
                    <img src="{{ asset('storage/' . $slider->image) }}"
                         style="height:48px;width:80px;object-fit:cover;border-radius:6px;border:1px solid #e0e0e0"
                         alt="{{ $slider->title }}">
                </td>
                <td style="font-weight:600;max-width:220px">{{ $slider->title }}</td>
                <td style="color:#666;max-width:180px">{{ $slider->subtitle }}</td>
                <td>{{ $slider->order }}</td>
                <td>
                    @if($slider->is_active)
                        <span class="ct-badge ct-badge-success">Actif</span>
                    @else
                        <span class="ct-badge ct-badge-danger">Inactif</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.sliders.edit', $slider) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px" title="Modifier">
                            <i class="fa-regular fa-pen"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.sliders.destroy', $slider) }}" onsubmit="return confirm('Supprimer ce slider ?')">
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
                <td colspan="6" style="text-align:center;color:#888;padding:40px">Aucun slider enregistré</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
