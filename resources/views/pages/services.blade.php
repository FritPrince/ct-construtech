@extends('layouts.app')

@section('title', 'Nos Services — CT ConstruTech')
@section('meta_description', 'CT ConstruTech vous propose des services complets en architecture, construction, rénovation et design d\'intérieur. Expertise et qualité garanties.')
@section('meta_keywords', 'services architecture, construction bâtiment, rénovation maison, design intérieur, maîtrise d\'œuvre')
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
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">QUI NOUS SOMMES</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title title-2">Explorez nos <span>services complets <br> de design</span> intérieur</h2>
                            <p class="mb-0">Nous sommes spécialisés dans la transformation de visions en réalité. Explorez notre portfolio de projets architecturaux <br> et de design intérieur <br> créés avec précision.</p>
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
                                <h3 class="banner-process-title"><a href="#">Rénovation et <br> réaménagement</a></h3>
                                <div class="banner-process-content">Nous transformons vos espaces existants en les modernisant pour améliorer leur fonctionnalité et leur esthétique.</div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">02</span>
                                <h3 class="banner-process-title"><a href="#">Consultation <br> design personnalisé</a></h3>
                                <div class="banner-process-content">Nous transformons vos espaces existants en les modernisant pour améliorer leur fonctionnalité et leur esthétique.</div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">03</span>
                                <h3 class="banner-process-title"><a href="#">Planification <br> de l'espace</a></h3>
                                <div class="banner-process-content">Nous transformons vos espaces existants en les modernisant pour améliorer leur fonctionnalité et leur esthétique.</div>
                            </div>
                        </div>
                        <div class="swiper-slide elementor-banner-process-item">
                            <div class="banner-process-caption">
                                <span class="number">04</span>
                                <h3 class="banner-process-title"><a href="#">Visualisation <br> 3D design</a></h3>
                                <div class="banner-process-content">Nous transformons vos espaces existants en les modernisant pour améliorer leur fonctionnalité et leur esthétique.</div>
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
                                <p>Nous sommes spécialisés dans la transformation de visions en réalité. Explorez notre portfolio de projets architecturaux et de design intérieur créés avec précision.</p>
                            </div>
                            <div class="skills-items">
                                <div class="skills-item fade-top">
                                    <h4 class="title">Design Intérieur</h4>
                                    <div class="progress">
                                        <div class="progress-bar wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms" role="progressbar" style="width: 85%;">
                                            <span>85%</span><div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skills-item fade-top">
                                    <h4 class="title">Modélisation 3D</h4>
                                    <div class="progress">
                                        <div class="progress-bar wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms" role="progressbar" style="width: 95%;">
                                            <span>95%</span><div class="dot"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="skills-item fade-top">
                                    <h4 class="title">Planification 2D</h4>
                                    <div class="progress">
                                        <div class="progress-bar wow slideInLeft" data-wow-delay="0ms" data-wow-duration="2000ms" role="progressbar" style="width: 65%;">
                                            <span>65%</span><div class="dot"></div>
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
                    <div class="newsletter-form">
                        <input type="text" id="email" name="email" class="form-control" placeholder="Adresse email..">
                        <button type="submit"><i class="fa-regular fa-arrow-right-long"></i></button>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ newsletter-section -->

@endsection
