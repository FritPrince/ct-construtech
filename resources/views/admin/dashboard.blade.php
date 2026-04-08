@extends('layouts.admin')

@section('title', 'Tableau de bord')

@section('content')

<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                <h3 class="font-weight-bold">Bonjour, {{ auth()->user()->name ?? 'Admin' }}</h3>
                <h6 class="font-weight-normal mb-0 text-muted">
                    Bienvenue dans l'administration de CT ConstructTech.
                    @if($stats['unread'] > 0)
                        Vous avez <span class="text-primary">{{ $stats['unread'] }} message{{ $stats['unread'] > 1 ? 's' : '' }} non lu{{ $stats['unread'] > 1 ? 's' : '' }}.</span>
                    @else
                        Tous les messages ont été lus.
                    @endif
                </h6>
            </div>
            <div class="col-12 col-xl-4">
                <div class="justify-content-end d-flex">
                    <p class="text-muted mb-0 mt-1" style="font-size:13px">
                        <i class="mdi mdi-calendar me-1"></i>
                        {{ now()->locale('fr')->isoFormat('dddd D MMMM YYYY') }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Stat cards --}}
<div class="row">
    <div class="col-md-6 grid-margin transparent">
        <div class="row">
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-tale">
                    <div class="card-body">
                        <p class="mb-4">Services actifs</p>
                        <p class="fs-30 mb-2">{{ $stats['services'] }}</p>
                        <a href="{{ route('admin.services.index') }}" style="color:rgba(255,255,255,0.7);font-size:12px;text-decoration:none">
                            Gérer les services &rarr;
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-4 stretch-card transparent">
                <div class="card card-dark-blue">
                    <div class="card-body">
                        <p class="mb-4">Projets portfolio</p>
                        <p class="fs-30 mb-2">{{ $stats['projects'] }}</p>
                        <a href="{{ route('admin.projects.index') }}" style="color:rgba(255,255,255,0.7);font-size:12px;text-decoration:none">
                            Gérer les projets &rarr;
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                <div class="card card-light-blue">
                    <div class="card-body">
                        <p class="mb-4">Formations</p>
                        <p class="fs-30 mb-2">{{ $stats['formations'] }}</p>
                        <a href="{{ route('admin.formations.index') }}" style="color:rgba(255,255,255,0.7);font-size:12px;text-decoration:none">
                            Gérer les formations &rarr;
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 stretch-card transparent">
                <div class="card card-light-danger">
                    <div class="card-body">
                        <p class="mb-4">Messages reçus</p>
                        <p class="fs-30 mb-2">{{ $stats['messages'] }}</p>
                        @if($stats['unread'] > 0)
                        <span style="color:rgba(255,255,255,0.9);font-size:12px;font-weight:600">
                            {{ $stats['unread'] }} non lu{{ $stats['unread'] > 1 ? 's' : '' }}
                        </span>
                        @else
                        <span style="color:rgba(255,255,255,0.7);font-size:12px">Tous lus</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin transparent">
        <div class="card" style="height:100%">
            <div class="card-body">
                <p class="card-title">Actions rapides</p>
                <div class="d-flex flex-column gap-2">
                    <a href="{{ route('admin.services.create') }}" class="d-flex align-items-center gap-3 p-3 rounded" style="border:1px solid #eee;text-decoration:none;color:#333;transition:all 0.2s" onmouseover="this.style.borderColor='#7DA0FA';this.style.color='#4747A1'" onmouseout="this.style.borderColor='#eee';this.style.color='#333'">
                        <div style="width:36px;height:36px;background:#DAE7FF;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="mdi mdi-briefcase-plus-outline" style="color:#4747A1;font-size:18px"></i>
                        </div>
                        <span style="font-size:13.5px;font-weight:500">Nouveau service</span>
                        <i class="mdi mdi-arrow-right ms-auto" style="color:#bbb"></i>
                    </a>
                    <a href="{{ route('admin.projects.create') }}" class="d-flex align-items-center gap-3 p-3 rounded" style="border:1px solid #eee;text-decoration:none;color:#333;transition:all 0.2s" onmouseover="this.style.borderColor='#7DA0FA';this.style.color='#4747A1'" onmouseout="this.style.borderColor='#eee';this.style.color='#333'">
                        <div style="width:36px;height:36px;background:#DAE7FF;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="mdi mdi-image-plus-outline" style="color:#4747A1;font-size:18px"></i>
                        </div>
                        <span style="font-size:13.5px;font-weight:500">Nouveau projet</span>
                        <i class="mdi mdi-arrow-right ms-auto" style="color:#bbb"></i>
                    </a>
                    <a href="{{ route('admin.formations.create') }}" class="d-flex align-items-center gap-3 p-3 rounded" style="border:1px solid #eee;text-decoration:none;color:#333;transition:all 0.2s" onmouseover="this.style.borderColor='#7DA0FA';this.style.color='#4747A1'" onmouseout="this.style.borderColor='#eee';this.style.color='#333'">
                        <div style="width:36px;height:36px;background:#DAE7FF;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="mdi mdi-school-outline" style="color:#4747A1;font-size:18px"></i>
                        </div>
                        <span style="font-size:13.5px;font-weight:500">Nouvelle formation</span>
                        <i class="mdi mdi-arrow-right ms-auto" style="color:#bbb"></i>
                    </a>
                    <a href="{{ route('admin.testimonials.create') }}" class="d-flex align-items-center gap-3 p-3 rounded" style="border:1px solid #eee;text-decoration:none;color:#333;transition:all 0.2s" onmouseover="this.style.borderColor='#7DA0FA';this.style.color='#4747A1'" onmouseout="this.style.borderColor='#eee';this.style.color='#333'">
                        <div style="width:36px;height:36px;background:#DAE7FF;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <i class="mdi mdi-star-plus-outline" style="color:#4747A1;font-size:18px"></i>
                        </div>
                        <span style="font-size:13.5px;font-weight:500">Nouveau témoignage</span>
                        <i class="mdi mdi-arrow-right ms-auto" style="color:#bbb"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Messages table --}}
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <p class="card-title mb-0">Derniers messages</p>
                    <a href="{{ route('admin.messages.index') }}" class="text-primary" style="font-size:13px;text-decoration:none">
                        Voir tous &rarr;
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                            <tr>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Statut</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentMessages as $msg)
                            <tr>
                                <td class="font-weight-bold">{{ $msg->full_name }}</td>
                                <td class="text-muted">{{ $msg->email }}</td>
                                <td>
                                    @if($msg->service)
                                    <span style="font-size:12px;background:#f4f5f7;padding:3px 10px;border-radius:20px;color:#555">{{ $msg->service }}</span>
                                    @else
                                    <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td class="text-muted" style="font-size:13px">{{ $msg->created_at->diffForHumans() }}</td>
                                <td>
                                    @if($msg->is_read)
                                    <div class="badge badge-success">Lu</div>
                                    @else
                                    <div class="badge badge-warning">Nouveau</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.messages.show', $msg) }}" class="text-muted" style="font-size:13px" title="Voir">
                                        <i class="mdi mdi-eye-outline"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    <i class="mdi mdi-email-outline" style="font-size:28px;display:block;margin-bottom:8px"></i>
                                    Aucun message reçu
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
