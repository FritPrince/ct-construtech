@extends('layouts.app')

@section('title', 'Nos Services — CT ConstruTech')
@section('meta_description', 'CT ConstruTech vous propose des services en architecture et ingénierie : études techniques, maîtrise d\'œuvre, suivi de chantier et gestion de projets de construction.')
@section('meta_keywords', 'services architecture ingénierie, maîtrise d\'œuvre, suivi chantier, études techniques, bureau d\'études BTP')
@section('canonical', route('services'))

@section('content')

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('storage/template/assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Services</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route('home') }}'>Accueil </a><span class="icon">-</span><a class='inner-page' href='{{ route('services') }}'> Services</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="feature-section pt-150 pb-110 overflow-hidden">
            <div class="container container-2">
                <div class="row section-heading-wrap feature-top">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Nos Services</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title title-2">Une expertise complète <span>en architecture <br> et ingénierie</span></h2>
                            <p class="mb-0">De la conception technique au suivi de chantier, ConstruTech intervient à chaque étape de votre projet pour garantir des ouvrages fiables, maîtrisés et livrés dans les délais.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="feature-item-imgs">
                            <div class="feature-img">
                                @if($services->first() && $services->first()->image)
                                <img src="{{ asset('storage/' . $services->first()->image) }}" alt="{{ $services->first()->title }}">
                                @else
                                <img src="{{ asset('storage/template/assets/img/service/feature-img-1.png') }}" alt="feature">
                                @endif
                                <div class="img-content">
                                    <p>{{ $services->first()->image_text ?? $services->first()->description ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-item-list feature-item-list-1">
                            @foreach($services as $service)
                            <div class="feature-item"
                                 data-img="{{ $service->image ? asset('storage/' . $service->image) : asset('storage/template/assets/img/service/feature-img-' . ($loop->iteration) . '.png') }}"
                                 data-text="{{ $service->image_text ?? $service->description }}">
                                <span class="number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                <h3 class="title"><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                                <a href="{{ route('services.show', $service) }}" class="arrow"><i class="fa-regular fa-arrow-right"></i></a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ feature-section -->

        <section class="banner-process-area overflow-hidden">
            <div class="service-carousel-wrap">
                <div class="banner-process-carousel">
                    <div class="swiper-wrapper antra-swiper-wrapper">
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">01</span>
                                <h3 class="banner-process-title"><a href="#">Études &amp; <br> conception architecturale</a></h3>
                                <div class="banner-process-content">Élaboration des plans, études de faisabilité et conception technique adaptée aux contraintes du site et du programme.</div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">02</span>
                                <h3 class="banner-process-title"><a href="#">Ingénierie <br> structurelle</a></h3>
                                <div class="banner-process-content">Calculs de structure, dimensionnement des fondations et vérification de la résistance des ouvrages selon les normes en vigueur.</div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">03</span>
                                <h3 class="banner-process-title"><a href="#">Maîtrise <br> d'œuvre</a></h3>
                                <div class="banner-process-content">Coordination des intervenants, pilotage du planning et contrôle du respect du budget tout au long du projet.</div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">04</span>
                                <h3 class="banner-process-title"><a href="#">Suivi <br> de chantier</a></h3>
                                <div class="banner-process-content">Contrôle de la conformité des travaux, vérification de la qualité d'exécution et validation des étapes clés jusqu'à la livraison.</div>
                            </div>
                        </div>
                    </div>
                    <div class="banner-process-image-list">
                        <div class="banner-process-img"><div class="process-img"><img src="{{ asset('storage/template/assets/img/bg-img/banner-process-1.png') }}" alt="img"></div></div>
                        <div class="banner-process-img"><div class="process-img"><img src="{{ asset('storage/template/assets/img/bg-img/slider-img-1.png') }}" alt="img"></div></div>
                        <div class="banner-process-img"><div class="process-img"><img src="{{ asset('storage/template/assets/img/bg-img/slider-img-2.png') }}" alt="img"></div></div>
                        <div class="banner-process-img"><div class="process-img"><img src="{{ asset('storage/template/assets/img/bg-img/video-bg-1.png') }}" alt="img"></div></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ banner-process-area -->

        <section class="skill-section skill-inner bg-grey pt-130 pb-130 overflow-hidden">
            <div class="skill-text">CT ConstruTech</div>
            <div class="shape-1"><img src="{{ asset('storage/template/assets/img/shapes/skill-shape-1.png') }}" alt="shape"></div>
            <div class="container container-2">
                <div class="row section-heading-wrap">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Ce que disent nos clients</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title title-2">Voici les <span>mots chaleureux <br> de nos clients</span></h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5">
                        <div class="skill-left-content">
                            <div class="skill-desc">
                                <p>Nous combinons expertise structurelle, maîtrise d'œuvre et rigueur technique pour livrer des ouvrages conformes, durables et dans les délais convenus.</p>
                            </div>
                            <div class="skills-items">
                                <div class="skills-item fade-top">
                                    <h4 class="title">Ingénierie structurelle</h4>
                                    <div class="progress">
                                        <div class="progress-bar wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms" role="progressbar" style="width: 95%;">
                                            <span>95%</span><div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skills-item fade-top">
                                    <h4 class="title">Maîtrise d'œuvre</h4>
                                    <div class="progress">
                                        <div class="progress-bar wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms" role="progressbar" style="width: 88%;">
                                            <span>88%</span><div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skills-item fade-top">
                                    <h4 class="title">Suivi & contrôle de chantier</h4>
                                    <div class="progress">
                                        <div class="progress-bar wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms" role="progressbar" style="width: 90%;">
                                            <span>90%</span><div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="skill-img">
                            <img src="{{ asset('storage/template/assets/img/images/skill-img-1.png') }}" alt="skill">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ skill-section -->

        <section class="newsletter-section bg-white pt-130 pb-130 overflow-hidden">
            <div class="bg-shape"><img src="{{ asset('storage/template/assets/img/shapes/newsletter-shape.png') }}" alt="shape"></div>
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="section-heading text-center">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Abonnez-vous à la newsletter</h4>
                        <h2 class="section-title">Rejoignez <span>notre newsletter <br> et restez</span> informé</h2>
                        <p>Rejoignez notre newsletter. Apprenez de nouvelles choses, accédez à du contenu exclusif, <br> et restez informé des dernières actualités du secteur.</p>
                    </div>
                    <form class="newsletter-form" action="{{ route('newsletter.subscribe') }}" method="POST">
                        @csrf
                        <input type="email" id="email" name="email" class="form-control" placeholder="Adresse email.." required>
                        <button type="submit"><i class="fa-regular fa-arrow-right-long"></i></button>
                    </form>
                </div>
            </div>
        </section>
        <!-- ./ newsletter-section -->

@endsection
