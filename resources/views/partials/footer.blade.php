<footer class="footer-section overflow-hidden">
    @php
        $fcs      = \App\Models\CompanySetting::pluck('value', 'key');
        $fLogo    = $fcs['logo']          ?? null;
        $fLogoUrl = ($fLogo && \Illuminate\Support\Facades\Storage::disk('public')->exists($fLogo))
                    ? asset("storage/{$fLogo}")
                    : null;
        $fEmail    = $fcs['email']          ?? null;
        $fAddress  = $fcs['address']        ?? null;
        $fLinkedin = $fcs['linkedin_url']   ?? null;
        $fAbout    = $fcs['about_text']     ?? 'Nous transformons votre vision en espaces magnifiquement conçus.';
        $fName     = $fcs['company_name']   ?? 'CT ConstruTech';
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
                                @if($fLogoUrl)
                                <img src="{{ $fLogoUrl }}" alt="logo" style="max-height:48px;width:auto">
                                @else
                                <span style="font-size:18px;font-weight:800;color:#fff">CT ConstruTech</span>
                                @endif
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
                        @if($fEmail)<a class="mail" href="mailto:{{ $fEmail }}">{{ $fEmail }}</a>@endif
                        <ul class="social-list">
                            @if($fEmail)<li><a href="mailto:{{ $fEmail }}">Email</a></li>@endif
                            @if($fLinkedin)<li><a href="{{ $fLinkedin }}">LinkedIn</a></li>@endif
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
