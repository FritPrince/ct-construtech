@extends('layouts.app')

@section('title', 'Accueil - CT ConstructTech')

@section('content')

        <section class="slider-section overflow-hidden">
            <div class="antra-slider swiper-container">
                <div class="swiper-wrapper">
                    @foreach($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="slider-item">
                            <div class="bg-img" data-background="{{ asset('storage/' . $slider->image) }}"></div>
                            <div class="container slider-container">
                                <div class="slider-content-wrap">
                                    <div class="slider-content">
                                        <div class="section-heading white-content">
                                            @if($slider->subtitle)
                                            <h4 class="sub-heading" data-animation="antra-fadeInDown" data-delay="1000ms" data-duration="1400ms">{{ $slider->subtitle }}</h4>
                                            @endif
                                            <h2 class="section-title cursor-effect" data-animation="antra-fadeInDown" data-delay="1200ms" data-duration="1400ms">{!! nl2br(e($slider->title)) !!}</h2>
                                        </div>
                                        <div class="bottom-content">
                                            @if($slider->description)
                                            <div class="antra-desc" data-animation="antra-fadeInUp" data-delay="1000ms" data-duration="1400ms">
                                                <p>{{ $slider->description }}</p>
                                            </div>
                                            @endif
                                            @if($slider->cta_label && $slider->cta_url)
                                            <div class="antra-btn" data-animation="antra-fadeInUp" data-delay="1200ms" data-duration="1400ms">
                                                <a href="{{ $slider->cta_url }}" class="tl-primary-btn white-btn">{{ $slider->cta_label }} <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="slider-element-wrap" data-animation="antra-fadeInRight" data-delay="1300ms" data-duration="1300ms">
                                <div class="slider-element">
                                    <h3 class="element-title">260+</h3>
                                    <span>Projets réussis <br> et en cours</span>
                                    <p>Spécifications Techniques <br>Projet de Design <br>Visualisation 3D</p>
                                </div>
                                <div class="slider-thumb">
                                    <img src="{{ asset('storage/template/assets/img/images/slider-thumb-1.png') }}" alt="slider">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ./ slider-section -->

        <section class="service-section pt-150 pb-110 overflow-hidden tl-bg-color fade-wrapper">
            <div class="bg-shape" data-background="{{ asset('storage/template/assets/img/shapes/service-bg-shape-1.png') }}"></div>
            <div class="container">
                <div class="row section-heading-wrap fade-top">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">QUI NOUS SOMMES</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect">Vivez <span>l'art du Design</span> Intérieur</h2>
                            <p class="mb-0">Nous sommes spécialisés dans la transformation de visions en réalité. <br> Explorez notre portfolio de projets architecturaux et de design intérieur <br> créés avec précision.</p>
                        </div>
                    </div>
                </div>
                <div class="row gy-xl-0 gy-4">
                    @foreach($services->take(4) as $service)
                    <div class="col-xl-3 col-lg-6 col-md-12">
                        <div class="service-item slide-anim" data-delay="0.3" data-offset="100" data-direction="bottom">
                            <div class="service-top">
                                <h3 class="title"><a href="{{ route('services.show', $service) }}">{{ $service->title }}</a></h3>
                                @if($service->icon)
                                <div class="icon"><img src="{{ asset('storage/' . $service->icon) }}" alt="service"></div>
                                @endif
                            </div>
                            <p>{{ $service->description }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @if($services->count() > 4)
                <div class="row fade-top" style="margin-top:50px">
                    <div class="col-12 text-center">
                        <a href="{{ route('services') }}" class="tl-primary-btn">Voir tous nos services <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                </div>
                @endif
            </div>
        </section>
        <!-- ./ service-section -->

        <section class="about-section overflow-hidden">
            <div class="about-bg" data-background="{{ asset('storage/template/assets/img/bg-img/about-bg.png') }}"></div>
            <div class="about-text"><span>CT ConstructTech</span></div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="about-content white-content slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <div class="section-heading white-content mb-30">
                                <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Notre Histoire</h4>
                                <h2 class="section-title cursor-effect">Des Espaces <br> qui Inspirent, un <span>Design <br> qui Prend Vie</span></h2>
                            </div>
                            <ul class="about-list">
                                <li><img src="{{ asset('storage/template/assets/img/icon/about-1.png') }}" alt="about">Technologies de pointe</li>
                                <li><img src="{{ asset('storage/template/assets/img/icon/about-1.png') }}" alt="about">Designs Haute Qualité</li>
                                <li><img src="{{ asset('storage/template/assets/img/icon/about-1.png') }}" alt="about">Garantie 5 ans</li>
                                <li><img src="{{ asset('storage/template/assets/img/icon/about-1.png') }}" alt="about">Design Résidentiel</li>
                            </ul>
                            <p>Que ce soit pour votre maison, bureau ou un projet commercial, nous sommes toujours dédiés à donner vie à votre vision.</p>
                            <div class="about-btn">
                                <a href="{{ route('services') }}" class="tl-primary-btn white-btn">En savoir plus <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about-img slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <img src="{{ asset('storage/template/assets/img/images/about-img-1.png') }}" alt="about">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ about-section -->

        <section class="feature-section pt-150 pb-110 overflow-hidden tl-bg-color fade-wrapper">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top feature-top">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">QUI NOUS SOMMES</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Explorez nos <span>services complets <br> de design</span> intérieur</h2>
                            <p class="mb-0">Nous sommes spécialisés dans la transformation de visions en réalité. Explorez notre portfolio de projets architecturaux et de design intérieur créés avec précision.</p>
                        </div>
                    </div>
                </div>
                <div class="row fade-top">
                    <div class="col-lg-6">
                        <div class="feature-item-imgs">
                            <div class="feature-img">
                                @if($services->first() && $services->first()->image)
                                <img src="{{ asset('storage/' . $services->first()->image) }}" alt="feature">
                                <div class="img-content">
                                    <p>{{ $services->first()->image_text }}</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="feature-item-list feature-item-list-1">
                            @foreach($services->take(6) as $service)
                            <div class="feature-item"
                                 data-img="{{ $service->image ? asset('storage/' . $service->image) : '' }}"
                                 data-text="{{ $service->image_text }}">
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

        <section class="counter-section counter-1">
            <div class="counter-text"><span>CT ConstructTech</span></div>
            <div class="counter-element scroll-area"><img class="scroll-img" src="{{ asset('storage/template/assets/img/images/counter-img-1.png') }}" alt="counter"></div>
            <div class="container container-2">
                <div class="row gy-5 fade-wrapper">
                    @foreach($counters as $counter)
                    <div class="col-lg-3 col-md-6 fade-top">
                        <div class="counter-item">
                            <h3 class="title"><span class="odometer" data-count="{{ $counter->value }}">0</span><span class="icon">+</span></h3>
                            <h4 class="sub-title">{{ $counter->label }}</h4>
                            @if($counter->description)
                            <p>{{ $counter->description }}</p>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ./ counter-section -->

        <section class="process-section overflow-hidden fade-wrapper">
            <div class="bg-shape" data-background="{{ asset('storage/template/assets/img/shapes/process-shape-1.png') }}"></div>
            <div class="container container-2">
                <div class="heading-space align-items-end">
                    <div class="section-heading mb-0">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Notre Méthode</h4>
                        <h2 class="section-title cursor-effect title-2">Notre <span>processus <br> architectural</span> pour des <br> résultats exceptionnels.</h2>
                    </div>
                    <div class="process-desc">
                        <p class="mb-0">Notre processus est vivant - s'adaptant, s'affinant et grandissant <br> avec votre vision. Toujours. <br> Comme des artistes avec une toile vierge, nous transformons les pièces <br> en œuvres d'art vivantes.</p>
                    </div>
                </div>
                <div class="row gy-xl-0 gy-4 process-wrap fade-wrapper">
                    @foreach($processSteps as $step)
                    <div class="col-xl-3 col-lg-6 col-md-6">
                        <div class="process-item fade-top">
                            @if($step->image)
                            <div class="process-thumb"><img src="{{ asset('storage/' . $step->image) }}" alt="process"></div>
                            @endif
                            <div class="process-content">
                                <h3 class="title"><span>{{ str_pad($step->number, 2, '0', STR_PAD_LEFT) }}</span>. {{ $step->title }}</h3>
                                @if($step->description)
                                <p>{{ $step->description }}</p>
                                @endif
                            </div>
                            <span class="number">{{ str_pad($step->number, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="process-text">
                    <h5 class="bottom-text">Nous travaillons dur pour vous impressionner. <a href="{{ route('contact') }}">Commencez dès aujourd'hui</a></h5>
                </div>
            </div>
        </section>
        <!-- ./ process-section -->

        <section class="project-section pt-130 tl-bg-color fade-wrapper">
            <div class="bg-shape" data-background="{{ asset('storage/template/assets/img/shapes/project-shape-1.png') }}"></div>
            <div class="project-text"><span>Intérieur</span></div>
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Nos Projets</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Des projets <span>créatifs qui <br> définissent</span> notre style</h2>
                            <p class="mb-0">Notre portfolio présente une gamme variée de projets, des espaces résidentiels magnifiquement conçus aux intérieurs commerciaux fonctionnels et élégants.</p>
                        </div>
                    </div>
                </div>
                <div class="project-carousel swiper fade-top">
                    <div class="swiper-wrapper">
                        @foreach($projects as $project)
                        <div class="swiper-slide">
                            <div class="project-item">
                                <div class="project-img">
                                    <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                                    <ul>
                                        @foreach($project->categories as $cat)
                                        <li><a href="{{ route('portfolio.show', $project) }}">{{ $cat->name }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="project-content">
                                    <h3 class="title"><a href="{{ route('portfolio.show', $project) }}">{{ $project->title }}</a></h3>
                                    <span>{{ $project->location }} <br>{{ $project->year }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row fade-top" style="margin-top:50px;padding-bottom:60px">
                    <div class="col-12 text-center">
                        <a href="{{ route('portfolio') }}" class="tl-primary-btn">Voir tout le portfolio <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                </div>
            </div>
            <div class="project-house-img">
                <img src="{{ asset('storage/template/assets/img/images/project-house.png') }}" alt="img">
            </div>
        </section>
        <!-- ./ project-section -->

        <section class="testimonial-section pt-150 fade-wrapper">
            <div class="container container-2">
                <div class="row section-heading-wrap fade-top">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Ce que disent nos clients</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title cursor-effect title-2">Voici ce que <span>nos clients <br> disent</span> de nous</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="testi-img slide-anim" data-delay="0.3" data-offset="100" data-direction="left">
                            <img src="{{ asset('storage/template/assets/img/testi/testi-img-1.png') }}" alt="testi">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="testi-carousel-wrap slide-anim" data-delay="0.3" data-offset="100" data-direction="right">
                            <div class="testi-top-content">
                                <div class="left-content">
                                    <h3 class="rating">{{ number_format($testimonials->avg('rating'), 2) }}</h3>
                                    <div class="rating-list">
                                        <ul>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                            <li><i class="fa-solid fa-star"></i></li>
                                        </ul>
                                        <span>{{ $testimonials->count() }} avis</span>
                                    </div>
                                </div>
                                <div class="right-content">
                                    <p>Du concept à la réalité, l'équipe a transformé ma vision en un espace magnifique et fonctionnel. Je ne pourrais pas être plus heureux !</p>
                                </div>
                            </div>
                            <div class="testi-carousel swiper">
                                <div class="swiper-wrapper">
                                    @foreach($testimonials as $testi)
                                    <div class="swiper-slide">
                                        <div class="testi-item">
                                            <p>{{ $testi->content }}</p>
                                            <div class="testi-author">
                                                @if($testi->author_photo)
                                                <div class="author-img">
                                                    <img src="{{ asset('storage/' . $testi->author_photo) }}" alt="{{ $testi->author_name }}">
                                                </div>
                                                @endif
                                                <h4 class="name">{{ $testi->author_name }} @if($testi->author_role)<span>{{ $testi->author_role }}</span>@endif</h4>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ testimonial-section -->

        <section class="sponsor-section sponsor-1 bg-grey pt-120 pb-130 overflow-hidden">
            <div class="container">
                @php $vipClients = \App\Models\CompanySetting::get('vip_clients'); @endphp
                @if($vipClients)
                <div class="sponsor-text-wrap">
                    <h5 class="sponsor-text">Notre réseau de confiance <span>{{ $vipClients }}+</span> Clients VIP</h5>
                </div>
                @endif
                <div class="sponsor-carousel swiper">
                    <div class="swiper-wrapper">
                        @foreach($sponsors as $sponsor)
                        <div class="swiper-slide">
                            <div class="sponsor-item">
                                <a href="{{ $sponsor->url ?? '#' }}">
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}">
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ sponsor-section -->

        <div class="gallary-section overflow-hidden">
            <div class="gallary-text"><span>galerie</span></div>
            @php $chunks = $gallery->chunk(4); @endphp
            <div class="gallary-wrap wrap-1">
                <div class="gallery-scroll-wrap">
                    @foreach($chunks->first() ?? [] as $item)
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('storage/' . $item->image) }}" class="venobox" data-gall="gallary1">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->alt }}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="gallary-wrap gallery-scroll-direction-ltr">
                <div class="gallery-scroll-wrap align-items-start">
                    @foreach($chunks->skip(1)->first() ?? [] as $item)
                    <div class="gallary-scroll-item">
                        <a href="{{ asset('storage/' . $item->image) }}" class="venobox" data-gall="gallary1">
                            <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->alt }}">
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <section class="newsletter-section pb-130 overflow-hidden tl-bg-color fade-wrapper">
            <div class="bg-shape"><img src="{{ asset('storage/template/assets/img/shapes/newsletter-shape.png') }}" alt="shape"></div>
            <div class="container">
                <div class="newsletter-wrap">
                    <div class="section-heading text-center fade-top">
                        <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">Abonnez-vous à la newsletter</h4>
                        <h2 class="section-title cursor-effect">Rejoignez <span>notre newsletter <br> et restez</span> informé</h2>
                        <p class="fade-top">Rejoignez notre newsletter. Apprenez de nouvelles choses, accédez à du contenu exclusif, <br> et restez informé des dernières actualités du secteur.</p>
                    </div>
                    @if(session('newsletter_success'))
                    <div style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:10px;padding:12px 18px;text-align:center;margin-bottom:16px;font-size:14px">
                        <i class="fa-regular fa-circle-check" style="margin-right:8px"></i>{{ session('newsletter_success') }}
                    </div>
                    @endif
                    <form action="{{ route('newsletter.subscribe') }}" method="POST" class="newsletter-form fade-top">
                        @csrf
                        <input type="email" name="email" class="form-control" placeholder="Adresse email.." value="{{ old('email') }}" required>
                        <button type="submit"><i class="fa-regular fa-arrow-right-long"></i></button>
                    </form>
                    @error('email')<p style="color:#dc2626;text-align:center;font-size:13px;margin-top:8px">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>
        <!-- ./ newsletter-section -->

@endsection
