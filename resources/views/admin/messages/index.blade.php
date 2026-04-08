@extends('layouts.admin')

@section('title', 'Messages')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">Messages de contact</h1>
    <p class="ct-page-subtitle">Boîte de réception des demandes clients</p>
</div>

<div class="ct-card">
    <table class="ct-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Service demandé</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $msg)
            <tr style="{{ !$msg->is_read ? 'font-weight:600' : '' }}">
                <td>{{ $msg->full_name }}</td>
                <td style="color:#666">{{ $msg->email }}</td>
                <td style="color:#666">{{ $msg->phone ?? '—' }}</td>
                <td style="color:#666">{{ $msg->service ?? '—' }}</td>
                <td style="color:#888;font-size:12px">{{ $msg->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    @if($msg->is_read)
                        <span class="ct-badge ct-badge-success">Lu</span>
                    @else
                        <span class="ct-badge ct-badge-warning">Non lu</span>
                    @endif
                </td>
                <td>
                    <div style="display:flex;gap:6px">
                        <a href="{{ route('admin.messages.show', $msg) }}" class="btn-ct-outline" style="padding:5px 10px;font-size:12px">
                            <i class="fa-regular fa-eye"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" onsubmit="return confirm('Supprimer ce message ?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-ct-outline" style="padding:5px 10px;font-size:12px;color:#dc2626;border-color:#dc2626">
                                <i class="fa-regular fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align:center;color:#888;padding:40px">Aucun message reçu</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    @if($messages->hasPages())
    <div style="padding:16px 20px;border-top:1px solid #f0f0f0">
        {{ $messages->links() }}
    </div>
    @endif
</div>

@endsection
