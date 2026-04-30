@extends('layouts.app')

@section('title', $service->title . ' — CT ConstruTech')
@section('meta_description', Str::limit(strip_tags($service->description ?? ''), 155, '...') ?: 'Service ' . $service->title . ' proposé par CT ConstruTech.')
@section('og_title', $service->title . ' — CT ConstruTech')
@section('canonical', route('services.show', $service))

@section('styles')
<style>
    /* ── Service-details : dark mode ──────────────────────────── */

    /* Sidebar : liste des services */
    [data-theme="dark"] .service-details-left-content .service-category-list {
        background-color: #1c1c1d;
    }
    [data-theme="dark"] .service-details-left-content .service-category-list .list-title {
        color: #ffffff;
    }
    [data-theme="dark"] .service-details-left-content .service-category-list ul li {
        color: #cccccc;
    }
    [data-theme="dark"] .service-details-left-content .service-category-list ul li:not(:last-of-type) {
        border-bottom-color: rgba(255,255,255,0.08);
    }
    [data-theme="dark"] .service-details-left-content .service-category-list ul li a {
        color: #bbbbbb;
    }
    [data-theme="dark"] .service-details-left-content .service-category-list ul li a:hover {
        color: #ffffff;
    }

    /* Contenu principal */
    [data-theme="dark"] .service-details-content .details-title {
        color: #ffffff;
    }
    [data-theme="dark"] .service-details-content > p,
    [data-theme="dark"] .service-details-content .service-details-items .service-details-item .content p,
    [data-theme="dark"] .service-details-content .mb-50 {
        color: #aaaaaa;
    }
    [data-theme="dark"] .service-details-content .service-details-items .service-details-item .content .title {
        color: #ffffff;
    }
    [data-theme="dark"] .service-details-content .service-details-list-wrap ul li {
        color: #bbbbbb;
    }

    /* FAQ */
    [data-theme="dark"] .service-details-content .service-faq .faq-title {
        color: #ffffff;
    }
    [data-theme="dark"] .service-details-content .accordion-item {
        background-color: #1c1c1d;
        border-color: rgba(255,255,255,0.08);
    }
    [data-theme="dark"] .service-details-content .accordion-button {
        background-color: #1c1c1d;
        color: #ffffff;
    }
    [data-theme="dark"] .service-details-content .accordion-button:not(.collapsed) {
        background-color: #252525;
        color: #ffffff;
    }
    [data-theme="dark"] .service-details-content .accordion-button::after {
        filter: invert(1);
    }
    [data-theme="dark"] .service-details-content .accordion-body {
        background-color: #252525;
        color: #aaaaaa;
    }

    /* Section globale */
    [data-theme="dark"] .service-details {
        background-color: #111111;
    }
</style>
@endsection

@section('content')

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('storage/template/assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">{{ $service->title }}</h1>
                    <h4 class="sub-title">
                        <a class="home" href="{{ route('home') }}">Accueil</a>
                        <span class="icon">-</span>
                        <a class="inner-page" href="{{ route('services') }}">Services</a>
                        <span class="icon">-</span>
                        <span>{{ $service->title }}</span>
                    </h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        <section class="service-details pt-130 pb-130">
            <div class="container container-2">
                <div class="row pin-inner">

                    {{-- Sidebar gauche --}}
                    <div class="col-lg-4 col-md-12">
                        <div class="service-details-left-content pin-box">

                            <div class="service-category-list">
                                <h3 class="list-title">Autres services</h3>
                                <ul>
                                    <li class="active">
                                        <a href="{{ route('services.show', $service) }}">{{ $service->title }}</a>
                                    </li>
                                    @foreach($otherServices as $other)
                                    <li>
                                        <a href="{{ route('services.show', $other) }}">{{ $other->title }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>

                            <div class="service-details-cta">
                                <div class="cta-bg" data-background="{{ asset('storage/template/assets/img/bg-img/service-cta-bg-2.png') }}"></div>
                                <div class="icon" style="display:flex;align-items:center;justify-content:center;width:60px;height:60px;background:rgba(253,1,0,0.12);border-radius:50%;margin:0 auto 12px">
                                    <i class="fa-regular fa-headset" style="font-size:26px;color:#fd0100"></i>
                                </div>
                                <span>Besoin d'aide ?</span>
                                @php $settings = \App\Models\CompanySetting::pluck('value','key'); @endphp
                                @if(!empty($settings['email']))
                                <a class="mail" href="mailto:{{ $settings['email'] }}">{{ $settings['email'] }}</a>
                                @endif
                                <div class="cta-btn">
                                    <a href="{{ route('contact') }}">Nous <br> contacter</a>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Contenu principal --}}
                    <div class="col-lg-8 col-md-12">
                        <div class="service-details-content scroll-content">

                            {{--
                                Image principale :
                                - Si l'admin a uploadé une image (chemin commençant par "uploads/"), on l'utilise
                                - Sinon on prend une image service-details du template (cycle sur 3 images selon l'ordre)
                            --}}
                            @php
                                $detailImgIndex = (($service->order - 1) % 3) + 1;
                                $fallbackImg = asset('storage/template/assets/img/service/service-details-img-' . $detailImgIndex . '.png');
                                $mainImg = ($service->image && !str_starts_with($service->image, 'template/'))
                                    ? asset('storage/' . $service->image)
                                    : $fallbackImg;
                            @endphp
                            <div class="service-details-img">
                                <img src="{{ $mainImg }}" alt="{{ $service->title }}">
                            </div>

                            <h1 class="details-title">{{ $service->title }}</h1>
                            <p>{{ $service->description }}</p>

                            <div class="service-details-items">
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-1.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Études techniques</h3>
                                        <p>Analyses structurelles, calculs de charge et dimensionnement des ouvrages.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-2.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Maîtrise d'œuvre</h3>
                                        <p>Coordination des intervenants et pilotage du projet de A à Z.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-3.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Suivi de chantier</h3>
                                        <p>Contrôle de conformité, qualité d'exécution et respect des délais.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-4.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Optimisation des coûts</h3>
                                        <p>Anticipation des contraintes pour maîtriser le budget dès la conception.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="service-details-img-wrap">
                                <div class="details-img">
                                    <img src="{{ asset('storage/template/assets/img/service/service-details-img-2.png') }}" alt="service">
                                </div>
                                <div class="details-img">
                                    <img src="{{ asset('storage/template/assets/img/service/service-details-img-3.png') }}" alt="service">
                                </div>
                            </div>

                            <h2 class="details-title">Notre approche</h2>
                            <p>Chez CT ConstruTech, chaque projet est étudié dans sa globalité afin d'anticiper les contraintes techniques, optimiser les coûts et assurer une exécution conforme aux exigences. Notre équipe combine conception architecturale, calcul structurel et contrôle terrain pour livrer des ouvrages fiables et durables.</p>

                            <h2 class="details-title">Nos engagements</h2>
                            <div class="service-details-list-wrap">
                                <ul>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Études structurelles rigoureuses</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Livraison dans les délais convenus</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Maîtrise technique à chaque étape</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Accompagnement personnalisé</li>
                                </ul>
                                <ul>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Coordination de tous les intervenants</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Contrôle qualité sur le terrain</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Ingénieurs et architectes expérimentés</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Transparence et suivi continu</li>
                                </ul>
                            </div>

                            <p class="mb-50">CT ConstruTech s'engage dans chaque mission avec une exigence d'excellence technique. De la phase d'étude jusqu'au contrôle final sur chantier, nous veillons à ce que chaque ouvrage soit réalisé dans les règles de l'art.</p>

                            {{-- FAQ --}}
                            <div class="service-faq">
                                <h3 class="faq-title">Questions fréquentes</h3>
                                <div class="faq-accordion fade-wrapper">
                                    <div class="accordion" id="serviceFaq">
                                        <div class="accordion-item fade-top">
                                            <h2 class="accordion-header" id="faqOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseOne" aria-expanded="true">
                                                    Quels sont les services que vous proposez ?
                                                </button>
                                            </h2>
                                            <div id="faqCollapseOne" class="accordion-collapse collapse show" data-bs-parent="#serviceFaq">
                                                <div class="accordion-body">
                                                    Nos services couvrent toute la chaîne du projet de construction : études techniques, conception architecturale, maîtrise d'œuvre, suivi de chantier et coordination des intervenants.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item fade-top">
                                            <h2 class="accordion-header" id="faqTwo">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseTwo">
                                                    Quel est votre processus de travail ?
                                                </button>
                                            </h2>
                                            <div id="faqCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#serviceFaq">
                                                <div class="accordion-body">
                                                    Nous commençons par analyser votre besoin et les contraintes du projet, développons les études techniques, coordonnons les intervenants, puis assurons le suivi et le contrôle de l'exécution sur le terrain.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item fade-top">
                                            <h2 class="accordion-header" id="faqThree">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseThree">
                                                    Proposez-vous des designs sur mesure ?
                                                </button>
                                            </h2>
                                            <div id="faqCollapseThree" class="accordion-collapse collapse" data-bs-parent="#serviceFaq">
                                                <div class="accordion-body">
                                                    Oui. Chaque projet est traité selon ses propres contraintes techniques, son budget et ses exigences spécifiques. Nous adaptons notre approche à chaque contexte pour garantir un résultat conforme à vos attentes.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item fade-top">
                                            <h2 class="accordion-header" id="faqFour">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapseFour">
                                                    Quelle est la durée typique d'un projet ?
                                                </button>
                                            </h2>
                                            <div id="faqCollapseFour" class="accordion-collapse collapse" data-bs-parent="#serviceFaq">
                                                <div class="accordion-body">
                                                    La durée varie selon la complexité. Une consultation simple peut prendre quelques jours, une rénovation complète peut s'étendre sur plusieurs mois. Un planning clair est établi dès le départ.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- CTA bas : utilise les classes du template (thème automatique) --}}
                            <div class="process-text" style="margin-top:50px">
                                <h5 class="bottom-text">
                                    Prêt à démarrer votre projet ?
                                    <a href="{{ route('contact') }}">Contactez-nous dès aujourd'hui</a>
                                </h5>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
