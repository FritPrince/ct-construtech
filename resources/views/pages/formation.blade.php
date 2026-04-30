@extends('layouts.app')

@section('title', 'Formations Professionnelles — CT ConstruTech')
@section('meta_description', 'CT ConstruTech propose des formations professionnelles en architecture et ingénierie du bâtiment, destinées aux praticiens et aux porteurs de projets de construction.')
@section('meta_keywords', 'formation architecture ingénierie, formation BTP, formation chantier, formation maîtrise d\'œuvre, cours construction')
@section('canonical', route('formation'))

@section('styles')
<style>
    /* ── Card formation ──────────────────────────────────── */
    .ct-formation-card {
        background: var(--ct-card, #fff);
        border-radius: 14px;
        border: 1px solid rgba(0,0,0,0.07);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        cursor: pointer;
        transition: transform 0.22s ease, box-shadow 0.22s ease, border-color 0.22s ease;
        height: 100%;
    }
    .ct-formation-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 32px rgba(0,0,0,0.10);
        border-color: #fd0100;
    }
    [data-theme="dark"] .ct-formation-card {
        background: var(--ct-card, #161616);
        border-color: var(--ct-border);
    }

    /* Image */
    .ct-fc-img {
        position: relative;
        height: 190px;
        overflow: hidden;
        background: #f0f0f0;
        flex-shrink: 0;
    }
    .ct-fc-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.35s ease;
    }
    .ct-formation-card:hover .ct-fc-img img {
        transform: scale(1.04);
    }
    .ct-fc-img .placeholder-icon {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 44px;
    }
    .ct-fc-badge {
        position: absolute;
        top: 10px;
        left: 10px;
        background: #fd0100;
        color: #fff;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        padding: 3px 10px;
        border-radius: 20px;
    }
    .ct-fc-cat {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: rgba(0,0,0,0.55);
        color: #fff;
        font-size: 10px;
        font-weight: 600;
        padding: 3px 10px;
        border-radius: 20px;
        backdrop-filter: blur(4px);
    }

    /* Corps */
    .ct-fc-body {
        padding: 18px 18px 0;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .ct-fc-title {
        font-size: 15px;
        font-weight: 700;
        line-height: 1.35;
        margin-bottom: 8px;
        color: var(--ct-text, #111);
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .ct-fc-desc {
        font-size: 12.5px;
        color: var(--ct-text-muted, #666);
        line-height: 1.55;
        margin-bottom: 10px;
        flex: 1;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .ct-fc-stars {
        display: flex;
        gap: 2px;
        color: #fd0100;
        font-size: 12px;
        margin-bottom: 12px;
    }

    /* Pied de carte */
    .ct-fc-footer {
        padding: 12px 18px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-top: 1px solid rgba(0,0,0,0.06);
        margin-top: auto;
        flex-shrink: 0;
    }
    [data-theme="dark"] .ct-fc-footer {
        border-color: var(--ct-border);
    }
    .ct-fc-price {
        font-size: 20px;
        font-weight: 800;
        color: #fd0100;
    }
    .ct-fc-cta {
        font-size: 12px;
        font-weight: 600;
        color: #fd0100;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    /* ── Vue liste ───────────────────────────────────────── */
    .ct-fl-item {
        display: flex;
        gap: 18px;
        padding: 18px;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.07);
        background: var(--ct-card, #fff);
        margin-bottom: 14px;
        cursor: pointer;
        transition: border-color 0.2s, box-shadow 0.2s;
        align-items: flex-start;
    }
    .ct-fl-item:hover {
        border-color: #fd0100;
        box-shadow: 0 4px 16px rgba(0,0,0,0.07);
    }
    [data-theme="dark"] .ct-fl-item {
        background: var(--ct-card);
        border-color: var(--ct-border);
    }
    .ct-fl-img {
        width: 130px;
        min-width: 130px;
        height: 90px;
        object-fit: cover;
        border-radius: 8px;
        flex-shrink: 0;
    }
    .ct-fl-placeholder {
        width: 130px;
        min-width: 130px;
        height: 90px;
        border-radius: 8px;
        background: var(--ct-bg-alt, #f2f2f2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ccc;
        font-size: 28px;
        flex-shrink: 0;
    }
    .ct-fl-body { flex: 1; min-width: 0; }
    .ct-fl-meta {
        font-size: 11px;
        color: #aaa;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }
    .ct-fl-title {
        font-size: 15px;
        font-weight: 700;
        color: var(--ct-text, #111);
        margin-bottom: 5px;
        line-height: 1.3;
    }
    .ct-fl-desc {
        font-size: 12.5px;
        color: var(--ct-text-muted, #777);
        line-height: 1.5;
        margin-bottom: 10px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .ct-fl-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }
    .ct-fl-price {
        font-size: 18px;
        font-weight: 800;
        color: #fd0100;
    }

    /* ── Pagination ──────────────────────────────────────── */
    .ct-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 40px;
    }
    .ct-pagination a, .ct-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid rgba(0,0,0,0.12);
        color: inherit;
        transition: all 0.2s;
    }
    .ct-pagination span[aria-current="page"] {
        background: #fd0100;
        border-color: #fd0100;
        color: #fff;
    }
    .ct-pagination a:hover { border-color: #fd0100; color: #fd0100; }
    .ct-pagination span.disabled { opacity: 0.35; cursor: default; }

    /* ── Filtre actif ────────────────────────────────────── */
    .active-filter {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fd010015;
        color: #fd0100;
        border: 1px solid #fd010030;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        padding: 4px 12px;
        margin-bottom: 14px;
        text-decoration: none;
    }
    .active-filter:hover { background: #fd010025; color: #fd0100; }

    /* ── Modal ───────────────────────────────────────────── */
    #formationModal .modal-content {
        border: none;
        border-radius: 16px;
        overflow: hidden;
        background: var(--ct-card, #fff);
        color: var(--ct-text, #111);
    }
    [data-theme="dark"] #formationModal .modal-content {
        background: #1c1c1d;
        color: #ebebeb;
    }

    #fm-left {
        width: 38%;
        flex-shrink: 0;
        background: var(--ct-bg-alt, #f0f0f0);
        position: relative;
        min-height: 360px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }
    [data-theme="dark"] #fm-left { background: #111111; }
    #fm-left img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        position: absolute;
        top: 0; left: 0;
        display: none;
    }

    #fm-right {
        flex: 1;
        padding: 32px 28px 28px;
        display: flex;
        flex-direction: column;
    }

    /* Titre & catégorie */
    #fm-title { color: var(--ct-text, #111); }
    [data-theme="dark"] #fm-title { color: #ffffff; }

    /* Description */
    #fm-desc { color: var(--ct-text-muted, #555); }
    [data-theme="dark"] #fm-desc { color: #aaaaaa; }

    /* Séparateur bas */
    #fm-right > div:last-child {
        border-top-color: rgba(0,0,0,0.07);
    }
    [data-theme="dark"] #fm-right > div:last-child {
        border-top-color: rgba(255,255,255,0.08) !important;
    }

    /* Bouton fermer */
    #formationModal [data-bs-dismiss="modal"] {
        color: var(--ct-text-muted, #888);
    }
    [data-theme="dark"] #formationModal [data-bs-dismiss="modal"] {
        color: #aaaaaa;
    }

    @media (max-width: 575px) {
        #fm-left { width: 100%; min-height: 180px; }
        #formationModal .modal-body-inner { flex-direction: column; }
        #fm-right { padding: 20px; }
    }
</style>
@endsection

@section('content')

        <section class="page-header">
            <div class="bg-img" data-background="{{ asset('storage/template/assets/img/bg-img/page-header-bg.png') }}"></div>
            <div class="overlay"></div>
            <div class="container">
                <div class="page-header-content">
                    <h1 class="title">Formations</h1>
                    <h4 class="sub-title">
                        <a class="home" href="{{ route('home') }}">Accueil</a>
                        <span class="icon">-</span>
                        <a class="inner-page" href="{{ route('formation') }}">Formations</a>
                    </h4>
                </div>
            </div>
        </section>

        <section class="shop-grid pt-100 pb-100">
            <div class="container container-2">
                <div class="row">

                    {{-- ── SIDEBAR ──────────────────────────────────── --}}
                    <div class="col-lg-3 col-md-12" style="margin-bottom:30px">

                        <div class="shop-sidebar">
                            <h3 class="sidebar-header">Recherche</h3>
                            <form action="{{ route('formation') }}" method="GET" class="search-form">
                                @if(request('cat'))<input type="hidden" name="cat" value="{{ request('cat') }}">@endif
                                @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                                <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="{{ request('q') }}">
                                <button class="search-btn" type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
                            </form>
                        </div>

                        <div class="shop-sidebar">
                            <h3 class="sidebar-header">Catégories</h3>
                            <ul class="sidebar-list" style="list-style:none;padding:0;margin:0">
                                @foreach($categories as $cat)
                                <li style="margin-bottom:6px">
                                    <a href="{{ route('formation', array_merge(request()->except(['cat','page']), request('cat') === $cat->slug ? [] : ['cat' => $cat->slug])) }}"
                                       style="display:flex;align-items:center;justify-content:space-between;text-decoration:none;color:inherit;font-size:13.5px;padding:5px 0;border-bottom:1px solid rgba(0,0,0,0.05)">
                                        <span style="{{ request('cat') === $cat->slug ? 'color:#fd0100;font-weight:700' : '' }}">{{ $cat->name }}</span>
                                        <span style="font-size:11px;background:rgba(0,0,0,0.06);border-radius:10px;padding:2px 8px;{{ request('cat') === $cat->slug ? 'background:#fd010015;color:#fd0100' : '' }}">{{ $cat->formations_count }}</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                            @if(request('cat'))
                            <a href="{{ route('formation', request()->except(['cat','page'])) }}" style="font-size:12px;color:#fd0100;display:block;margin-top:10px">
                                <i class="fa-regular fa-xmark"></i> Effacer le filtre
                            </a>
                            @endif
                        </div>

                        @if($formations->isNotEmpty())
                        <div class="shop-sidebar">
                            <h3 class="sidebar-header">Formations récentes</h3>
                            <div class="sidebar-items">
                                @foreach($formations->take(3) as $recent)
                                <div class="sidebar-item">
                                    @if($recent->image)
                                    <div class="item-img"><img src="{{ asset('storage/' . $recent->image) }}" alt="{{ $recent->title }}"></div>
                                    @endif
                                    <div class="content">
                                        <h4 class="title">{{ $recent->title }}</h4>
                                        <ul class="review">
                                            @for($i = 1; $i <= 5; $i++)
                                            <li><i class="fa-solid fa-star" style="{{ $i <= round($recent->average_rating) ? '' : 'opacity:0.3' }}"></i></li>
                                            @endfor
                                        </ul>
                                        <span class="price">€{{ number_format($recent->price, 2) }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                    </div>

                    {{-- ── CONTENU PRINCIPAL ────────────────────────── --}}
                    <div class="col-lg-9 col-md-12">
                        <div class="shop-grid-left">

                            {{-- Barre du haut --}}
                            <div class="top-grid-content">
                                <div class="shop-tab-nav">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab" data-bs-target="#nav-grid" type="button" role="tab" title="Vue grille">
                                                <svg width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg"><rect x="15" width="5" height="3" fill="currentColor"/><rect x="15" y="7" width="5" height="3" fill="currentColor"/><rect x="15" y="14" width="5" height="3" fill="currentColor"/><rect x="7.71875" width="5" height="3" fill="currentColor"/><rect x="7.71875" y="7" width="5" height="3" fill="currentColor"/><rect x="7.71875" y="14" width="5" height="3" fill="currentColor"/><rect width="5" height="3" fill="currentColor"/><rect y="7" width="5" height="3" fill="currentColor"/><rect y="14" width="5" height="3" fill="currentColor"/></svg>
                                            </button>
                                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab" data-bs-target="#nav-list" type="button" role="tab" title="Vue liste">
                                                <svg width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg"><rect x="5.71875" width="14.2857" height="3" fill="currentColor"/><rect x="5.71875" y="7" width="14.2857" height="3" fill="currentColor"/><rect x="5.71875" y="14" width="14.2857" height="3" fill="currentColor"/><rect width="3.80952" height="3" fill="currentColor"/><rect y="7" width="3.80952" height="3" fill="currentColor"/><rect y="14" width="3.80952" height="3" fill="currentColor"/></svg>
                                            </button>
                                        </div>
                                    </nav>
                                    <span style="font-size:13px;color:#888">
                                        @if($formations->total() > 0)
                                            {{ $formations->firstItem() }}–{{ $formations->lastItem() }} sur {{ $formations->total() }} formation{{ $formations->total() > 1 ? 's' : '' }}
                                        @else
                                            Aucun résultat
                                        @endif
                                    </span>
                                </div>
                                <form method="GET" action="{{ route('formation') }}" id="sort-form">
                                    @if(request('q'))<input type="hidden" name="q" value="{{ request('q') }}">@endif
                                    @if(request('cat'))<input type="hidden" name="cat" value="{{ request('cat') }}">@endif
                                    <select name="sort" class="form-control" style="border-radius:8px;padding:8px 14px;font-size:13px;width:auto;cursor:pointer" onchange="document.getElementById('sort-form').submit()">
                                        <option value="" {{ !request('sort') ? 'selected' : '' }}>Tri par défaut</option>
                                        <option value="featured"   {{ request('sort') === 'featured'   ? 'selected' : '' }}>Mis en avant</option>
                                        <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Prix croissant</option>
                                        <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Prix décroissant</option>
                                        <option value="rating"     {{ request('sort') === 'rating'     ? 'selected' : '' }}>Meilleures notes</option>
                                    </select>
                                </form>
                            </div>

                            {{-- Filtres actifs --}}
                            @if(request('q') || request('cat'))
                            <div style="margin:12px 0 4px">
                                @if(request('q'))
                                <a href="{{ route('formation', request()->except(['q','page'])) }}" class="active-filter">
                                    <i class="fa-regular fa-magnifying-glass"></i> "{{ request('q') }}" <i class="fa-regular fa-xmark"></i>
                                </a>
                                @endif
                                @if(request('cat'))
                                @php $activeCat = $categories->firstWhere('slug', request('cat')); @endphp
                                <a href="{{ route('formation', request()->except(['cat','page'])) }}" class="active-filter">
                                    <i class="fa-regular fa-tag"></i> {{ $activeCat?->name ?? request('cat') }} <i class="fa-regular fa-xmark"></i>
                                </a>
                                @endif
                            </div>
                            @endif

                            <div class="tab-content" id="nav-tabContent">

                                {{-- ── VUE GRILLE ──────────────────── --}}
                                <div class="tab-pane fade show active" id="nav-grid" role="tabpanel">
                                    @if($formations->isEmpty())
                                    <div style="text-align:center;padding:60px 20px;color:#aaa">
                                        <i class="fa-regular fa-folder-open" style="font-size:40px;display:block;margin-bottom:12px"></i>
                                        Aucune formation trouvée.
                                        <a href="{{ route('formation') }}" style="display:block;margin-top:12px;color:#fd0100;font-size:13px">Réinitialiser les filtres</a>
                                    </div>
                                    @else
                                    <div class="row gy-4">
                                        @foreach($formations as $formation)
                                        <div class="col-xl-4 col-lg-6 col-md-6">
                                            <div class="ct-formation-card formation-card"
                                                 data-title="{{ $formation->title }}"
                                                 data-category="{{ $formation->category->name ?? '' }}"
                                                 data-price="€{{ number_format($formation->price, 2) }}"
                                                 data-rating="{{ round($formation->average_rating) }}"
                                                 data-featured="{{ $formation->is_featured ? '1' : '0' }}"
                                                 data-description="{{ e($formation->description ?? '') }}"
                                                 data-image="{{ $formation->image ? asset('storage/' . $formation->image) : '' }}"
                                                 data-contact="{{ route('contact') }}?formation={{ urlencode($formation->title) }}">

                                                {{-- Image --}}
                                                <div class="ct-fc-img">
                                                    @if($formation->image)
                                                    <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->title }}">
                                                    @else
                                                    <div class="placeholder-icon"><i class="fa-regular fa-graduation-cap"></i></div>
                                                    @endif
                                                    @if($formation->is_featured)
                                                    <span class="ct-fc-badge">★ Vedette</span>
                                                    @endif
                                                    @if($formation->category)
                                                    <span class="ct-fc-cat">{{ $formation->category->name }}</span>
                                                    @endif
                                                </div>

                                                {{-- Corps --}}
                                                <div class="ct-fc-body">
                                                    <h3 class="ct-fc-title">{{ $formation->title }}</h3>
                                                    @if($formation->description)
                                                    <p class="ct-fc-desc">{{ $formation->description }}</p>
                                                    @endif
                                                    <div class="ct-fc-stars">
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa-solid fa-star" style="{{ $i <= round($formation->average_rating) ? '' : 'opacity:0.2' }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>

                                                {{-- Pied --}}
                                                <div class="ct-fc-footer">
                                                    <span class="ct-fc-price">€{{ number_format($formation->price, 2) }}</span>
                                                    <span class="ct-fc-cta">Voir les détails <i class="fa-regular fa-arrow-right"></i></span>
                                                </div>

                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>

                                {{-- ── VUE LISTE ───────────────────── --}}
                                <div class="tab-pane fade" id="nav-list" role="tabpanel">
                                    @if($formations->isEmpty())
                                    <div style="text-align:center;padding:60px 20px;color:#aaa">
                                        <i class="fa-regular fa-folder-open" style="font-size:40px;display:block;margin-bottom:12px"></i>
                                        Aucune formation trouvée.
                                    </div>
                                    @else
                                    @foreach($formations as $formation)
                                    <div class="ct-fl-item formation-card"
                                         data-title="{{ $formation->title }}"
                                         data-category="{{ $formation->category->name ?? '' }}"
                                         data-price="€{{ number_format($formation->price, 2) }}"
                                         data-rating="{{ round($formation->average_rating) }}"
                                         data-featured="{{ $formation->is_featured ? '1' : '0' }}"
                                         data-description="{{ e($formation->description ?? '') }}"
                                         data-image="{{ $formation->image ? asset('storage/' . $formation->image) : '' }}"
                                         data-contact="{{ route('contact') }}?formation={{ urlencode($formation->title) }}">

                                        @if($formation->image)
                                        <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->title }}" class="ct-fl-img">
                                        @else
                                        <div class="ct-fl-placeholder"><i class="fa-regular fa-graduation-cap"></i></div>
                                        @endif

                                        <div class="ct-fl-body">
                                            <div class="ct-fl-meta">
                                                {{ $formation->category->name ?? '' }}
                                                @if($formation->is_featured) · <span style="color:#fd0100">★ Vedette</span>@endif
                                            </div>
                                            <h3 class="ct-fl-title">{{ $formation->title }}</h3>
                                            @if($formation->description)
                                            <p class="ct-fl-desc">{{ $formation->description }}</p>
                                            @endif
                                            <div class="ct-fl-footer">
                                                <div style="display:flex;align-items:center;gap:12px">
                                                    <div style="display:flex;gap:2px;color:#fd0100;font-size:12px">
                                                        @for($i = 1; $i <= 5; $i++)
                                                        <i class="fa-solid fa-star" style="{{ $i <= round($formation->average_rating) ? '' : 'opacity:0.2' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <span class="ct-fl-price">€{{ number_format($formation->price, 2) }}</span>
                                                </div>
                                                <span style="font-size:12px;font-weight:600;color:#fd0100">Voir les détails →</span>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if($formations->hasPages())
                        <div class="ct-pagination">
                            @if($formations->onFirstPage())
                            <span class="disabled">‹</span>
                            @else
                            <a href="{{ $formations->previousPageUrl() }}">‹</a>
                            @endif

                            @foreach($formations->links()->elements as $element)
                                @if(is_string($element))<span>…</span>@endif
                                @if(is_array($element))
                                    @foreach($element as $page => $url)
                                        @if($page == $formations->currentPage())
                                            <span aria-current="page">{{ $page }}</span>
                                        @else
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if($formations->hasMorePages())
                            <a href="{{ $formations->nextPageUrl() }}">›</a>
                            @else
                            <span class="disabled">›</span>
                            @endif
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        {{-- ── Modal ───────────────────────────────────────────── --}}
        <div class="modal fade" id="formationModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body-inner" style="display:flex;min-height:360px">

                        {{-- Panneau image --}}
                        <div id="fm-left">
                            <img id="fm-img" src="" alt="">
                            <i id="fm-placeholder" class="fa-regular fa-graduation-cap" style="font-size:50px;color:#ccc"></i>
                            <span id="fm-badge" style="display:none;position:absolute;top:12px;left:12px;background:#fd0100;color:#fff;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:4px 10px;border-radius:20px">★ Vedette</span>
                        </div>

                        {{-- Panneau contenu --}}
                        <div id="fm-right">
                            <button type="button" data-bs-dismiss="modal" aria-label="Fermer"
                                    style="position:absolute;top:14px;right:16px;background:none;border:none;font-size:20px;cursor:pointer;color:#888;line-height:1">&times;</button>

                            <div id="fm-category" style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#fd0100;margin-bottom:8px"></div>
                            <h3 id="fm-title" style="font-size:20px;font-weight:800;margin-bottom:10px;line-height:1.3;color:inherit"></h3>
                            <div id="fm-stars" style="display:flex;gap:3px;color:#fd0100;font-size:14px;margin-bottom:14px"></div>
                            <p id="fm-desc" style="font-size:14px;line-height:1.7;flex:1;margin-bottom:0"></p>

                            <div style="margin-top:24px;padding-top:20px;border-top:1px solid rgba(0,0,0,0.07);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px">
                                <div>
                                    <div style="font-size:10px;color:#aaa;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:2px">Prix</div>
                                    <div id="fm-price" style="font-size:26px;font-weight:800;color:#fd0100"></div>
                                </div>
                                <a id="fm-cta" href="#" class="tl-primary-btn" style="font-size:14px;padding:12px 24px">
                                    Je suis intéressé <span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

@endsection

@section('scripts')
<script>
(function () {
    var modalEl = document.getElementById('formationModal');
    if (!modalEl) return;

    // Sortir le modal du scroll-wrapper GSAP pour qu'il s'affiche correctement
    if (modalEl.parentElement !== document.body) {
        document.body.appendChild(modalEl);
    }

    // Décode les entités HTML (&#039; → ', &amp; → &, etc.)
    function decodeHtml(str) {
        var ta = document.createElement('textarea');
        ta.innerHTML = str;
        return ta.value;
    }

    function openModal(card) {
        document.getElementById('fm-title').textContent    = decodeHtml(card.dataset.title       || '');
        document.getElementById('fm-category').textContent = decodeHtml(card.dataset.category    || '');
        document.getElementById('fm-price').textContent    = decodeHtml(card.dataset.price       || '');
        document.getElementById('fm-desc').textContent     = decodeHtml(card.dataset.description || '');
        document.getElementById('fm-cta').href             = card.dataset.contact || '#';

        document.getElementById('fm-badge').style.display = card.dataset.featured === '1' ? 'inline-block' : 'none';

        var img = document.getElementById('fm-img');
        var ph  = document.getElementById('fm-placeholder');
        var src = card.dataset.image || '';
        if (src) {
            img.src = src; img.style.display = 'block'; ph.style.display = 'none';
        } else {
            img.style.display = 'none'; ph.style.display = 'block';
        }

        var stars  = document.getElementById('fm-stars');
        var rating = parseInt(card.dataset.rating) || 0;
        stars.innerHTML = '';
        for (var i = 1; i <= 5; i++) {
            var s = document.createElement('i');
            s.className = 'fa-solid fa-star';
            s.style.opacity = i <= rating ? '1' : '0.22';
            stars.appendChild(s);
        }

        // Pauser le ScrollSmoother le temps que le modal soit ouvert
        if (typeof ScrollSmoother !== 'undefined' && ScrollSmoother.get) {
            var smoother = ScrollSmoother.get();
            if (smoother) smoother.paused(true);
        }

        var bsModal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        bsModal.show();
    }

    // Reprendre le ScrollSmoother à la fermeture
    modalEl.addEventListener('hidden.bs.modal', function () {
        if (typeof ScrollSmoother !== 'undefined' && ScrollSmoother.get) {
            var smoother = ScrollSmoother.get();
            if (smoother) smoother.paused(false);
        }
    });

    document.querySelectorAll('.formation-card').forEach(function (card) {
        card.addEventListener('click', function (e) {
            e.stopPropagation();
            openModal(card);
        });
    });

    modalEl.querySelector('[data-bs-dismiss="modal"]').addEventListener('click', function () {
        var inst = bootstrap.Modal.getInstance(modalEl);
        if (inst) inst.hide();
    });
})();
</script>
@endsection
