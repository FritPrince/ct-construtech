@extends('layouts.admin')

@section('title', $testimonial->author_name)

@section('content')

<div style="margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
    <div>
        <h1 class="ct-page-title">{{ $testimonial->author_name }}</h1>
        <p class="ct-page-subtitle" style="margin:0">
            <a href="{{ route('admin.testimonials.index') }}" style="color:var(--ct-red)">Témoignages</a>
            / {{ $testimonial->author_name }}
        </p>
    </div>
    <div style="display:flex;gap:8px">
        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn-ct-primary">
            <i class="fa-regular fa-pen-to-square"></i> Modifier
        </a>
        <a href="{{ route('admin.testimonials.index') }}" class="btn-ct-outline">
            <i class="fa-regular fa-arrow-left"></i> Retour
        </a>
    </div>
</div>

<div class="row g-3 justify-content-center">
    <div class="col-lg-7">
        <div class="ct-card">
            <div class="ct-card-header">
                <div style="display:flex;align-items:center;gap:14px">
                    @if($testimonial->author_photo)
                    <img src="{{ asset('storage/' . $testimonial->author_photo) }}"
                         style="width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid #eee"
                         alt="{{ $testimonial->author_name }}">
                    @else
                    <div style="width:52px;height:52px;border-radius:50%;background:var(--ct-red);display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px;font-weight:700">
                        {{ strtoupper(substr($testimonial->author_name, 0, 1)) }}
                    </div>
                    @endif
                    <div>
                        <div style="font-size:16px;font-weight:700;color:#111">{{ $testimonial->author_name }}</div>
                        @if($testimonial->author_role)
                        <div style="font-size:13px;color:#888">{{ $testimonial->author_role }}</div>
                        @endif
                    </div>
                </div>
                <span class="ct-badge {{ $testimonial->is_active ? 'ct-badge-success' : 'ct-badge-danger' }}">
                    {{ $testimonial->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>
            <div class="ct-card-body">
                {{-- Stars --}}
                <div style="margin-bottom:16px;display:flex;align-items:center;gap:10px">
                    <div style="display:flex;gap:3px">
                        @for($i = 1; $i <= 5; $i++)
                        <i class="fa-solid fa-star" style="color:{{ $i <= round($testimonial->rating) ? '#f59e0b' : '#e5e7eb' }};font-size:16px"></i>
                        @endfor
                    </div>
                    <span style="font-size:16px;font-weight:700;color:#111">{{ number_format($testimonial->rating, 1) }}</span>
                    <span style="color:#aaa;font-size:13px">/ 5</span>
                </div>

                {{-- Content --}}
                <blockquote style="border-left:3px solid var(--ct-red);padding-left:16px;margin:0 0 20px;color:#444;font-size:15px;line-height:1.8;font-style:italic">
                    "{{ $testimonial->content }}"
                </blockquote>

                <div style="font-size:12px;color:#bbb">
                    Ajouté le {{ $testimonial->created_at->format('d/m/Y') }}
                </div>
            </div>
            <div class="ct-card-body" style="border-top:1px solid #f0f0f0;display:flex;gap:8px">
                <form method="POST" action="{{ route('admin.testimonials.destroy', $testimonial) }}" data-no-loader
                      onsubmit="return confirm('Supprimer ce témoignage ?')" style="margin:0">
                    @csrf @method('DELETE')
                    <button type="submit" style="background:none;border:1px solid #fee2e2;color:#dc2626;border-radius:8px;padding:8px 16px;font-size:13px;cursor:pointer;font-weight:500">
                        <i class="fa-regular fa-trash"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
