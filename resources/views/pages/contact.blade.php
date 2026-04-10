@extends('layouts.app')

@section('title', 'Contactez-nous — CT ConstruTech')
@section('meta_description', 'Contactez CT ConstruTech pour vos projets de construction, rénovation ou pour vous inscrire à une formation. Notre équipe vous répond rapidement.')
@section('canonical', route('contact'))

@section('content')

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('storage/template/assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Contactez-nous</h1>
                    <h4 class="sub-title"><a class='home' href='{{ route('home') }}'>Accueil </a><span class="icon">-</span><a class='inner-page' href='{{ route('contact') }}'> Contact</a></h4>
                </div>
            </div>
        </section>
        <!-- ./ page-header -->

        @php
            $cs = \App\Models\CompanySetting::pluck('value', 'key');
            $ctPhone   = $cs['phone']   ?? null;
            $ctEmail   = $cs['email']   ?? null;
            $ctAddress = $cs['address'] ?? null;
            $mapsUrl   = $cs['google_maps_embed_url'] ?? null;
        @endphp

        <section class="contact-section pt-150 pb-150">
            <div class="container container-2">
                <div class="row section-heading-wrap w-100 ml-0">
                    <div class="shape"><img src="{{ asset('storage/template/assets/img/shapes/section-heading.png') }}" alt="shape"></div>
                    <div class="col-lg-4 col-md-12">
                        <div class="section-heading mb-0">
                            <h4 class="sub-heading" data-text-animation="fade-in-right" data-split="char" data-duration="0.9" data-stagger="0.03">prenons contact</h4>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="section-heading section-heading-2 mb-0">
                            <h2 class="section-title title-2">Vous avez un projet en <span>tête ? <br> Faisons-le</span> ensemble</h2>
                        </div>
                    </div>
                </div>
                <div class="row request-wrap contact-page-area">
                    <div class="col-lg-6">
                        <div class="request-content">
                            <div class="request-item-wrap">
                                @if($ctAddress)
                                <div class="request-item white-content">
                                    <span>Adresse</span>
                                    <p>{{ $ctAddress }}</p>
                                </div>
                                @endif
                                @if($ctPhone || $ctEmail)
                                <div class="request-item white-content">
                                    <span>Support</span>
                                    @if($ctPhone)<a href="tel:{{ $ctPhone }}">{{ $ctPhone }}</a>@endif
                                    @if($ctEmail)<a href="mailto:{{ $ctEmail }}">{{ $ctEmail }}</a>@endif
                                </div>
                                @endif
                            </div>
                            <div class="contact-img">
                                <img src="{{ asset('storage/template/assets/img/images/contact-img-1.png') }}" alt="img">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="request-form-wrap">
                            @if(session('success'))
                            <div style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:10px;padding:14px 18px;margin-bottom:20px;font-size:14px">
                                <i class="fa-regular fa-circle-check" style="margin-right:8px"></i>{{ session('success') }}
                            </div>
                            @endif

                            @if(!empty($prefillFormation))
                            <div style="background:#fff7ed;color:#9a3412;border:1px solid #fed7aa;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:13.5px">
                                <i class="fa-regular fa-graduation-cap" style="margin-right:8px"></i>
                                Vous êtes intéressé par la formation : <strong>{{ $prefillFormation }}</strong>
                            </div>
                            @endif

                            <form action="{{ route('contact.send') }}" method="post" class="form-horizontal">
                                @csrf
                                @if(!empty($prefillFormation))
                                <input type="hidden" name="_formation" value="{{ $prefillFormation }}">
                                @endif
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Nom complet *</h4>
                                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="Votre nom" value="{{ old('full_name') }}">
                                            @error('full_name')<span style="color:#dc2626;font-size:12px">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Téléphone</h4>
                                            <input type="text" name="phone" class="form-control" placeholder="+(000) 000-0000" value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Adresse Email *</h4>
                                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="contact@example.com" value="{{ old('email') }}">
                                            @error('email')<span style="color:#dc2626;font-size:12px">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <h4 class="form-title">Objet / Formation souhaitée</h4>
                                            <input type="text" name="service" class="form-control" placeholder="Je souhaite..."
                                                   value="{{ old('service', !empty($prefillFormation) ? "Formation : {$prefillFormation}" : '') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="form-item message-item">
                                            <h4 class="form-title">Votre message *</h4>
                                            <textarea name="message" cols="30" rows="5" class="form-control address @error('message') is-invalid @enderror" placeholder="Votre message..">{{ old('message') }}</textarea>
                                            @error('message')<span style="color:#dc2626;font-size:12px">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="submit-btn">
                                    <button class="tl-primary-btn" type="submit">Envoyer le message <span class="icon"><i class="fa-regular fa-arrow-right"></i></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ./ contact-section -->

        @if($mapsUrl)
        <div class="map-wrapper pb-150">
            <div class="container">
                <iframe src="{{ $mapsUrl }}" width="100%" height="620" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
        @endif
        <!-- ./ map-wrapper -->

@endsection
