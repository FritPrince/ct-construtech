@extends('layouts.app')

@section('title', $service->title . ' - CT ConstructTech')

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
                                <div class="icon">
                                    <img src="{{ asset('storage/template/assets/img/icon/service-details-cta.png') }}" alt="icon">
                                </div>
                                <span>Besoin d'aide ?</span>
                                @php $settings = \App\Models\CompanySetting::pluck('value','key'); @endphp
                                @if(!empty($settings['phone']))
                                <a class="number" href="tel:{{ $settings['phone'] }}">{{ $settings['phone'] }}</a>
                                @endif
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
                                        <h3 class="title">Optimisation de l'espace</h3>
                                        <p>Maximiser chaque mètre carré grâce à une planification intelligente.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-2.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Aménagements flexibles</h3>
                                        <p>Des layouts adaptables à vos besoins présents et futurs.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-3.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Technologie intelligente</h3>
                                        <p>Intégration des solutions domotiques et connectées.</p>
                                    </div>
                                </div>
                                <div class="service-details-item">
                                    <div class="icon"><img src="{{ asset('storage/template/assets/img/icon/service-details-4.png') }}" alt="service"></div>
                                    <div class="content">
                                        <h3 class="title">Efficacité des coûts</h3>
                                        <p>Un rapport qualité-prix optimal sur chaque projet.</p>
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
                            <p>Chez CT ConstructTech, chaque projet est une opportunité de créer un espace unique qui reflète la personnalité et les besoins de nos clients. Notre équipe d'experts combine créativité, précision technique et matériaux de haute qualité pour garantir des résultats exceptionnels.</p>

                            <h2 class="details-title">Nos engagements</h2>
                            <div class="service-details-list-wrap">
                                <ul>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Services de design haut de gamme</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Livraison dans les délais convenus</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Maîtrise technique et créative</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Accompagnement personnalisé</li>
                                </ul>
                                <ul>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Adaptation à toute structure</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Service client réactif</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Ingénieurs et designers expérimentés</li>
                                    <li><i class="fa-sharp fa-solid fa-circle-check"></i>Garantie de satisfaction</li>
                                </ul>
                            </div>

                            <p class="mb-50">CT ConstructTech est engagé dans l'excellence — de la conception à la réalisation. Faites confiance à notre expertise pour transformer vos espaces en œuvres d'art habitables.</p>

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
                                                    Nos services couvrent toute la chaîne du design intérieur et architectural : du concept initial à la livraison finale. Design résidentiel, commercial, consultation, rénovation et visualisation 3D.
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
                                                    Nous commençons par une consultation approfondie, proposons des concepts visuels, affinons le design en collaboration avec vous, puis supervisons la réalisation jusqu'à la livraison finale.
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
                                                    Absolument. Chaque projet est unique — design, budget et contraintes d'espace sont pris en compte dès le départ pour un résultat qui vous ressemble.
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
