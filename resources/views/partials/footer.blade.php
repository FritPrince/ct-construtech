<footer class="footer-section overflow-hidden">
    @php
        $fcs      = \App\Models\CompanySetting::pluck('value', 'key');
        $fLogo    = $fcs['logo']          ?? null;
        $fLogoUrl = ($fLogo && \Illuminate\Support\Facades\Storage::disk('public')->exists($fLogo))
                    ? asset('storage/' . $fLogo)
                    : null;
        $fPhone    = $fcs['phone']         ?? null;
        $fEmail    = $fcs['email']         ?? null;
        $fAddress  = $fcs['address']       ?? null;
        $fFacebook = $fcs['facebook_url']  ?? '#';
        $fInsta    = $fcs['instagram_url'] ?? '#';
        $fTwitter  = $fcs['twitter_url']   ?? '#';
        $fYoutube  = $fcs['youtube_url']   ?? null;
        $fAbout    = $fcs['about_text']    ?? 'Nous transformons votre vision en espaces magnifiquement conçus.';
        $fName     = $fcs['company_name']  ?? 'CT ConstructTech';
    @endphp
    <div class="footer-bg" data-background="{{ asset('storage/template/assets/img/bg-img/footer-bg.png') }}"></div>
    <div class="footer-shade"></div>
    <div class="container container-2">
        <div class="row footer-wrap">
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="widget-header">
                        <div class="footer-logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ $fLogoUrl ?? asset('storage/template/assets/img/logo/logo-2.png') }}" alt="logo" @if($fLogoUrl) style="max-height:48px;width:auto" @endif>
                            </a>
                        </div>
                    </div>
                    <p class="mb-10">{{ $fAbout }}</p>
                    @if($fAddress)<p class="mb-0">{{ $fAddress }}</p>@endif
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget footer-col-2">
                    <ul class="footer-list">
                        <li><a href="{{ route('home') }}">Accueil</a></li>
                        <li><a href="{{ route('services') }}">Services</a></li>
                        <li><a href="{{ route('portfolio') }}">Projets</a></li>
                        <li><a href="{{ route('formation') }}">Formations</a></li>
                        <li><a href="{{ route('contact') }}">Contacts</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget footer-col-2 pl-0">
                    <ul class="footer-list">
                        <li><a href="{{ route('portfolio') }}">Nos Projets</a></li>
                        <li><a href="{{ route('contact') }}">Partenaires</a></li>
                        <li><a href="{{ route('contact') }}">Programme Partenaire</a></li>
                        <li><a href="{{ route('contact') }}">Conditions Générales</a></li>
                        <li><a href="{{ route('contact') }}">Centre de support</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-widget">
                    <div class="footer-address">
                        @if($fPhone)<a class="number" href="tel:{{ $fPhone }}">{{ $fPhone }}</a>@endif
                        @if($fEmail)<a class="mail" href="mailto:{{ $fEmail }}">{{ $fEmail }}</a>@endif
                        <ul class="social-list">
                            @if($fFacebook !== '#')<li><a href="{{ $fFacebook }}">Facebook</a></li>@endif
                            @if($fInsta !== '#')<li><a href="{{ $fInsta }}">Instagram</a></li>@endif
                            @if($fYoutube)<li><a href="{{ $fYoutube }}">YouTube</a></li>@endif
                            @if($fTwitter !== '#')<li><a href="{{ $fTwitter }}">Twitter</a></li>@endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-area">
        <div class="container">
            <div class="copyright-content">
                <p>© {{ date('Y') }} {{ $fName }}. Tous droits réservés.</p>
            </div>
        </div>
    </div>
    <div class="footer-text"><span>{{ $fName }}</span></div>
</footer>
<!-- ./ footer-section -->
