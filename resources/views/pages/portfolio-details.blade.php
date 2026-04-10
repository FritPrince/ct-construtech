@extends('layouts.app')

@section('title', $project->title . ' — CT ConstruTech')
@section('meta_description', Str::limit(strip_tags($project->description ?? ''), 155, '...') ?: 'Découvrez ce projet de ' . $project->title . ' réalisé par CT ConstruTech.')
@section('og_title', $project->title . ' — CT ConstruTech')
@section('og_description', Str::limit(strip_tags($project->description ?? ''), 155, '...'))
@if($project->featured_image)
@section('og_image', asset('storage/' . $project->featured_image))
@endif
@section('canonical', route('portfolio.show', $project))

@section('styles')
<style>
    /* ── Portfolio-details : dark mode ────────────────────────── */

    [data-theme="dark"] .portfolio-details {
        background-color: #111111;
    }

    /* Titre principal et secondaires */
    [data-theme="dark"] .portfolio-details .details-title,
    [data-theme="dark"] .portfolio-details .details-title-2 {
        color: #ffffff;
    }

    /* Texte courant */
    [data-theme="dark"] .portfolio-details p {
        color: #aaaaaa;
    }

    /* Méta (Localisation, Année, Catégories…) */
    [data-theme="dark"] .portfolio-details .project-details-meta .details-meta {
        border-color: rgba(255,255,255,0.08);
    }
    [data-theme="dark"] .portfolio-details .project-details-meta .details-meta span {
        color: #888888;
    }
    [data-theme="dark"] .portfolio-details .project-details-meta .details-meta h5 {
        color: #ffffff;
    }

    /* Checklist */
    [data-theme="dark"] .portfolio-details .project-details-list ul li {
        color: #bbbbbb;
        border-color: rgba(255,255,255,0.08);
    }
    [data-theme="dark"] .portfolio-details .project-details-list ul li strong {
        color: #ffffff;
    }

    /* Statistiques de surface */
    [data-theme="dark"] .portfolio-details .project-details-items .project-details-item {
        background-color: #1c1c1d;
        border-color: rgba(255,255,255,0.08);
    }
    [data-theme="dark"] .portfolio-details .project-details-items .project-details-item .title {
        color: #ffffff;
    }
    [data-theme="dark"] .portfolio-details .project-details-items .project-details-item span {
        color: #aaaaaa;
    }

    /* Autres projets */
    [data-theme="dark"] .portfolio-nav-card {
        background-color: #1c1c1d;
        border-color: rgba(255,255,255,0.08);
    }
    [data-theme="dark"] .portfolio-nav-card .nav-card-title {
        color: #ffffff;
    }
    [data-theme="dark"] .portfolio-nav-card .nav-card-meta {
        color: #888888;
    }
</style>
@endsection

@section('content')

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('storage/template/assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">{{ $project->title }}</h1>
                    <h4 class="sub-title">
                        <a class="home" href="{{ route('home') }}">Accueil</a>
                        <span class="icon">-</span>
                        <a class="inner-page" href="{{ route('portfolio') }}">Portfolio</a>
                        <span class="icon">-</span>
                        <span>{{ $project->title }}</span>
                    </h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="portfolio-details pt-130 pb-130">
            <div class="container container-2">
                <div class="project-details-wrap">

                    <h1 class="details-title">{{ $project->title }}</h1>

                    <div class="project-details-meta">
                        @if($project->location)
                        <div class="details-meta">
                            <span>Localisation :</span>
                            <h5>{{ $project->location }}</h5>
                        </div>
                        @endif
                        @if($project->year)
                        <div class="details-meta">
                            <span>Année :</span>
                            <h5>{{ $project->year }}</h5>
                        </div>
                        @endif
                        @if($project->categories->count())
                        <div class="details-meta">
                            <span>Catégorie :</span>
                            <h5>{{ $project->categories->pluck('name')->join(', ') }}</h5>
                        </div>
                        @endif
                        <div class="details-meta">
                            <span>Type :</span>
                            <h5>{{ $project->is_featured ? 'Projet vedette' : 'Projet standard' }}</h5>
                        </div>
                        <div class="details-meta">
                            <span>Statut :</span>
                            <h5>Livré</h5>
                        </div>
                        <div class="details-meta">
                            <span>Approche :</span>
                            <h5>Sur mesure</h5>
                        </div>
                    </div>

                    {{-- Image principale --}}
                    @php
                        $mainImg = ($project->image && !str_starts_with($project->image, 'template/'))
                            ? asset('storage/' . $project->image)
                            : asset('storage/' . ($project->image ?? 'template/assets/img/project/project-details-img-1.png'));
                    @endphp
                    <div class="project-details-img">
                        <img src="{{ $mainImg }}" alt="{{ $project->title }}">
                    </div>

                    <h2 class="details-title-2">Conception en détail</h2>

                    @if($project->description)
                    <p>{{ $project->description }}</p>
                    @else
                    <p>Chaque espace de ce projet a été pensé pour allier esthétique et fonctionnalité. Notre équipe a travaillé en étroite collaboration avec le client pour concevoir un environnement qui reflète ses besoins et sa personnalité, en s'appuyant sur des matériaux de qualité et une attention particulière aux détails.</p>
                    @endif

                    <div class="project-details-list">
                        <ul>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Espaces ouverts :</strong> Création de zones de vie en open-plan pour améliorer la fluidité et la connexion entre les espaces intérieurs et extérieurs.</li>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Matériaux naturels :</strong> Utilisation de bois recyclé, de pierre et de fibres naturelles pour une harmonie avec l'environnement.</li>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Grandes baies vitrées :</strong> Installation de baies sol-plafond pour maximiser la lumière naturelle et les vues dégagées.</li>
                        </ul>
                        <ul>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Espaces extérieurs :</strong> Conception de terrasses, piscines et jardins pour la détente et les loisirs.</li>
                            <li><i class="fa-sharp fa-solid fa-circle-check"></i><strong>Équipements modernes :</strong> Intégration de la domotique, appareils haut de gamme et équipements connectés.</li>
                        </ul>
                    </div>

                    <div class="project-details-items">
                        <div class="project-details-item text-center">
                            <h3 class="title">{{ $project->year ?? '2024' }}</h3>
                            <span>Année de réalisation</span>
                        </div>
                        <div class="project-details-item text-center">
                            <h3 class="title">{{ $project->categories->count() }}</h3>
                            <span>Catégorie(s)</span>
                        </div>
                        <div class="project-details-item text-center">
                            <h3 class="title">100%</h3>
                            <span>Satisfaction client</span>
                        </div>
                        <div class="project-details-item text-center">
                            <h3 class="title">Sur mesure</h3>
                            <span>Approche</span>
                        </div>
                    </div>

                    <h3 class="details-title-2">Un résultat exceptionnel</h3>
                    <p>CT ConstruTech s'engage dans chaque projet avec une exigence d'excellence. De la conception initiale à la livraison finale, nous veillons à ce que chaque détail soit maîtrisé pour offrir un espace qui surpasse les attentes du client. La satisfaction de nos clients est notre plus grande récompense.</p>

                    {{-- Autres projets --}}
                    @if($otherProjects->count())
                    <div style="margin-top:60px">
                        <h3 class="details-title-2" style="margin-bottom:24px">Autres projets</h3>
                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:16px">
                            @foreach($otherProjects as $other)
                            <a href="{{ route('portfolio.show', $other) }}"
                               class="portfolio-nav-card"
                               style="display:block;border-radius:12px;overflow:hidden;border:1px solid #e3e5e8;text-decoration:none;transition:box-shadow .2s">
                                <div style="aspect-ratio:16/9;overflow:hidden">
                                    <img src="{{ asset('storage/' . $other->image) }}"
                                         alt="{{ $other->title }}"
                                         style="width:100%;height:100%;object-fit:cover;transition:transform .3s">
                                </div>
                                <div style="padding:12px 14px">
                                    <div class="nav-card-title" style="font-weight:600;font-size:14px;margin-bottom:4px">{{ $other->title }}</div>
                                    <div class="nav-card-meta" style="font-size:12px;color:#888">
                                        {{ $other->location }}@if($other->location && $other->year), @endif{{ $other->year }}
                                    </div>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    {{-- CTA --}}
                    <div class="process-text" style="margin-top:50px">
                        <h5 class="bottom-text">
                            Intéressé par un projet similaire ?
                            <a href="{{ route('contact') }}">Contactez-nous dès aujourd'hui</a>
                        </h5>
                    </div>

                </div>
            </div>
        </section>

@endsection
