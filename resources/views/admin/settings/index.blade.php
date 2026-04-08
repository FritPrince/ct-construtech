@extends('layouts.admin')

@section('title', 'Paramètres')

@section('content')

<div style="margin-bottom:24px">
    <h1 class="ct-page-title">Paramètres de l'entreprise</h1>
    <p class="ct-page-subtitle">Informations générales affichées sur le site web</p>
</div>

<div class="ct-card" style="max-width:700px">
    <div class="ct-card-body">
        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf @method('PUT')

            {{-- Logo --}}
            <div class="mb-4" style="padding-bottom:20px;border-bottom:1px solid #f0f0f0">
                <label class="ct-form-label">Logo du site</label>
                <div style="display:flex;align-items:center;gap:16px;flex-wrap:wrap">
                    <div id="logo-preview-wrap" style="width:120px;height:60px;border:1px solid #e3e5e8;border-radius:10px;background:#f8f9fa;display:flex;align-items:center;justify-content:center;overflow:hidden;flex-shrink:0">
                        @if(!empty($settings['logo']) && \Illuminate\Support\Facades\Storage::disk('public')->exists($settings['logo']))
                            <img id="logo-preview" src="{{ asset('storage/' . $settings['logo']) }}" style="max-width:110px;max-height:52px;object-fit:contain" alt="logo">
                        @else
                            <img id="logo-preview" src="{{ asset('storage/template/assets/img/logo/logo-1.png') }}" style="max-width:110px;max-height:52px;object-fit:contain" alt="logo">
                        @endif
                    </div>
                    <div style="flex:1;min-width:200px">
                        <input type="file" name="logo" id="logo-input" accept="image/png,image/jpeg,image/svg+xml,image/webp"
                               style="display:none" onchange="previewLogo(this)">
                        <label for="logo-input" class="btn-ct-outline" style="cursor:pointer;display:inline-flex;align-items:center;gap:6px;margin-bottom:6px">
                            <i class="fa-regular fa-arrow-up-from-bracket"></i> Choisir un fichier
                        </label>
                        <div id="logo-filename" style="font-size:12px;color:#888">PNG, JPG, SVG ou WEBP — max 2 Mo</div>
                    </div>
                </div>
                @if(!empty($settings['logo']))
                <div style="margin-top:8px;font-size:11px;color:#bbb">Fichier actuel : {{ $settings['logo'] }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Nom de l'entreprise</label>
                <input type="text" name="settings[company_name]" class="ct-form-control" value="{{ old('settings.company_name', $settings['company_name'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Slogan</label>
                <input type="text" name="settings[tagline]" class="ct-form-control" value="{{ old('settings.tagline', $settings['tagline'] ?? '') }}">
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Adresse</label>
                <input type="text" name="settings[address]" class="ct-form-control" value="{{ old('settings.address', $settings['address'] ?? '') }}">
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="ct-form-label">Téléphone</label>
                    <input type="text" name="settings[phone]" class="ct-form-control" value="{{ old('settings.phone', $settings['phone'] ?? '') }}">
                </div>
                <div class="col-md-6">
                    <label class="ct-form-label">Email de contact</label>
                    <input type="email" name="settings[email]" class="ct-form-control" value="{{ old('settings.email', $settings['email'] ?? '') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">À propos (texte court)</label>
                <textarea name="settings[about_text]" class="ct-form-control" rows="3">{{ old('settings.about_text', $settings['about_text'] ?? '') }}</textarea>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3">
                    <label class="ct-form-label">Facebook URL</label>
                    <input type="text" name="settings[facebook_url]" class="ct-form-control" value="{{ old('settings.facebook_url', $settings['facebook_url'] ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Instagram URL</label>
                    <input type="text" name="settings[instagram_url]" class="ct-form-control" value="{{ old('settings.instagram_url', $settings['instagram_url'] ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">Twitter URL</label>
                    <input type="text" name="settings[twitter_url]" class="ct-form-control" value="{{ old('settings.twitter_url', $settings['twitter_url'] ?? '') }}">
                </div>
                <div class="col-md-3">
                    <label class="ct-form-label">YouTube URL</label>
                    <input type="text" name="settings[youtube_url]" class="ct-form-control" value="{{ old('settings.youtube_url', $settings['youtube_url'] ?? '') }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="ct-form-label">Google Maps — URL d'intégration (iframe src)</label>
                <input type="text" name="settings[google_maps_embed_url]" class="ct-form-control" placeholder="https://www.google.com/maps/embed?pb=..." value="{{ old('settings.google_maps_embed_url', $settings['google_maps_embed_url'] ?? '') }}">
                <div style="font-size:11px;color:#aaa;margin-top:4px">Sur Google Maps → Partager → Intégrer une carte → copier uniquement la valeur de <code>src="..."</code></div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label class="ct-form-label">Année de fondation</label>
                    <input type="text" name="settings[years_founded]" class="ct-form-control" value="{{ old('settings.years_founded', $settings['years_founded'] ?? '') }}">
                </div>
                <div class="col-md-4">
                    <label class="ct-form-label">Nombre de clients VIP</label>
                    <input type="text" name="settings[vip_clients]" class="ct-form-control" value="{{ old('settings.vip_clients', $settings['vip_clients'] ?? '') }}">
                </div>
            </div>

            <button type="submit" class="btn-ct-primary">
                <i class="fa-regular fa-floppy-disk"></i>
                Enregistrer les paramètres
            </button>
        </form>
    </div>
</div>

@section('scripts')
<script>
function previewLogo(input) {
    if (!input.files || !input.files[0]) return;
    var file = input.files[0];
    document.getElementById('logo-filename').textContent = file.name;
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('logo-preview').src = e.target.result;
    };
    reader.readAsDataURL(file);
}
</script>
@endsection

@endsection
