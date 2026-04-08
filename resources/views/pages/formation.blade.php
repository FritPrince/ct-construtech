@extends('layouts.app')

@section('title', 'Formations - CT ConstructTech')

@section('styles')
<style>
    /* ── Pagination propre ───────────────────────────── */
    .ct-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 40px;
    }
    .ct-pagination a,
    .ct-pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        font-size: 14px;
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
    .ct-pagination a:hover {
        border-color: #fd0100;
        color: #fd0100;
    }
    .ct-pagination span.disabled {
        opacity: 0.35;
        cursor: default;
    }
    /* Masquer les flèches «Previous / Next» textuelles */
    .ct-pagination [rel="prev"] svg,
    .ct-pagination [rel="next"] svg { display:none; }

    /* ── Vue liste ───────────────────────────────────── */
    .formation-list-item {
        display: flex;
        gap: 20px;
        padding: 20px;
        border-radius: 12px;
        border: 1px solid rgba(0,0,0,0.07);
        background: var(--ct-card, #fff);
        margin-bottom: 16px;
        transition: border-color 0.2s;
    }
    .formation-list-item:hover { border-color: #fd0100; }
    .formation-list-item .list-img {
        width: 140px;
        min-width: 140px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
    }
    .formation-list-item .list-body { flex: 1; }
    .formation-list-item .list-title {
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 4px;
    }
    .formation-list-item .list-cat {
        font-size: 12px;
        color: #aaa;
        margin-bottom: 6px;
    }
    .formation-list-item .list-desc {
        font-size: 13px;
        color: #777;
        margin-bottom: 10px;
        line-height: 1.5;
    }
    .formation-list-item .list-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
    }
    [data-theme="dark"] .formation-list-item {
        border-color: var(--ct-border);
        background: var(--ct-card);
    }
    [data-theme="dark"] .formation-list-item .list-title { color: var(--ct-text); }
    [data-theme="dark"] .formation-list-item .list-desc  { color: var(--ct-text-muted); }

    /* ── Active filter badge ─────────────────────────── */
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

                    {{-- ── SIDEBAR ─────────────────────────────────── --}}
                    <div class="col-lg-3 col-md-12" style="margin-bottom:30px">

                        {{-- Recherche --}}
                        <div class="shop-sidebar">
                            <h3 class="sidebar-header">Recherche</h3>
                            <form action="{{ route('formation') }}" method="GET" class="search-form">
                                @if(request('cat'))<input type="hidden" name="cat" value="{{ request('cat') }}">@endif
                                @if(request('sort'))<input type="hidden" name="sort" value="{{ request('sort') }}">@endif
                                <input type="text" name="q" class="form-control" placeholder="Rechercher..." value="{{ request('q') }}">
                                <button class="search-btn" type="submit">
                                    <i class="fa-regular fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>

                        {{-- Catégories --}}
                        <div class="shop-sidebar">
                            <h3 class="sidebar-header">Catégories</h3>
                            <ul class="sidebar-list" style="list-style:none;padding:0;margin:0">
                                @foreach($categories as $cat)
                                <li style="margin-bottom:8px">
                                    <a href="{{ route('formation', array_merge(request()->except(['cat','page']), request('cat') === $cat->slug ? [] : ['cat' => $cat->slug])) }}"
                                       style="display:flex;align-items:center;justify-content:space-between;text-decoration:none;color:inherit;font-size:14px;padding:6px 0;border-bottom:1px solid rgba(0,0,0,0.05)">
                                        <span style="{{ request('cat') === $cat->slug ? 'color:#fd0100;font-weight:700' : '' }}">
                                            {{ $cat->name }}
                                        </span>
                                        <span style="font-size:11px;background:rgba(0,0,0,0.06);border-radius:10px;padding:2px 8px;{{ request('cat') === $cat->slug ? 'background:#fd010015;color:#fd0100' : '' }}">
                                            {{ $cat->formations_count }}
                                        </span>
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

                        {{-- Formations récentes --}}
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

                    {{-- ── GRILLE / LISTE ───────────────────────────── --}}
                    <div class="col-lg-9 col-md-12">
                        <div class="shop-grid-left">

                            {{-- Barre du haut --}}
                            <div class="top-grid-content">
                                <div class="shop-tab-nav">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab"
                                                    data-bs-toggle="tab" data-bs-target="#nav-grid"
                                                    type="button" role="tab" title="Vue grille">
                                                <svg width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="15" width="5" height="3" fill="currentColor"/>
                                                    <rect x="15" y="7" width="5" height="3" fill="currentColor"/>
                                                    <rect x="15" y="14" width="5" height="3" fill="currentColor"/>
                                                    <rect x="7.71875" width="5" height="3" fill="currentColor"/>
                                                    <rect x="7.71875" y="7" width="5" height="3" fill="currentColor"/>
                                                    <rect x="7.71875" y="14" width="5" height="3" fill="currentColor"/>
                                                    <rect width="5" height="3" fill="currentColor"/>
                                                    <rect y="7" width="5" height="3" fill="currentColor"/>
                                                    <rect y="14" width="5" height="3" fill="currentColor"/>
                                                </svg>
                                            </button>
                                            <button class="nav-link" id="nav-list-tab"
                                                    data-bs-toggle="tab" data-bs-target="#nav-list"
                                                    type="button" role="tab" title="Vue liste">
                                                <svg width="20" height="17" viewBox="0 0 20 17" xmlns="http://www.w3.org/2000/svg">
                                                    <rect x="5.71875" width="14.2857" height="3" fill="currentColor"/>
                                                    <rect x="5.71875" y="7" width="14.2857" height="3" fill="currentColor"/>
                                                    <rect x="5.71875" y="14" width="14.2857" height="3" fill="currentColor"/>
                                                    <rect width="3.80952" height="3" fill="currentColor"/>
                                                    <rect y="7" width="3.80952" height="3" fill="currentColor"/>
                                                    <rect y="14" width="3.80952" height="3" fill="currentColor"/>
                                                </svg>
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

                                {{-- Tri --}}
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
                            <div style="margin-bottom:4px">
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

                                {{-- Vue GRILLE --}}
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
                                            <div class="shop-item">
                                                <div class="shop-thumb">
                                                    @if($formation->image)
                                                    <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->title }}">
                                                    @else
                                                    <div style="height:180px;background:var(--ct-bg-alt,#f2f2f2);display:flex;align-items:center;justify-content:center">
                                                        <i class="fa-regular fa-graduation-cap" style="font-size:40px;color:#ccc"></i>
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="shop-content">
                                                    @if($formation->is_featured)
                                                    <span style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#fd0100;display:block;margin-bottom:4px">★ Mis en avant</span>
                                                    @endif
                                                    <h3 class="title">{{ $formation->title }}</h3>
                                                    @if($formation->category)
                                                    <div style="font-size:12px;color:#aaa;margin-bottom:6px">{{ $formation->category->name }}</div>
                                                    @endif
                                                    @if($formation->description)
                                                    <p style="font-size:13px;color:#777;margin-bottom:10px;line-height:1.5">{{ Str::limit($formation->description, 90) }}</p>
                                                    @endif
                                                    <div class="review-wrap">
                                                        <ul class="review">
                                                            @for($i = 1; $i <= 5; $i++)
                                                            <li><i class="fa-solid fa-star" style="{{ $i <= round($formation->average_rating) ? '' : 'opacity:0.25' }}"></i></li>
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <div style="display:flex;align-items:center;justify-content:space-between;margin-top:12px;flex-wrap:wrap;gap:8px">
                                                        <span class="price">€{{ number_format($formation->price, 2) }}</span>
                                                        <a href="{{ route('contact') }}?formation={{ urlencode($formation->title) }}"
                                                           class="tl-primary-btn"
                                                           style="font-size:12px;padding:8px 16px">
                                                            Je suis intéressé <span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endif
                                </div>

                                {{-- Vue LISTE --}}
                                <div class="tab-pane fade" id="nav-list" role="tabpanel">
                                    @if($formations->isEmpty())
                                    <div style="text-align:center;padding:60px 20px;color:#aaa">
                                        <i class="fa-regular fa-folder-open" style="font-size:40px;display:block;margin-bottom:12px"></i>
                                        Aucune formation trouvée.
                                    </div>
                                    @else
                                    @foreach($formations as $formation)
                                    <div class="formation-list-item">
                                        @if($formation->image)
                                        <img src="{{ asset('storage/' . $formation->image) }}" alt="{{ $formation->title }}" class="list-img">
                                        @else
                                        <div class="list-img" style="display:flex;align-items:center;justify-content:center;background:var(--ct-bg-alt,#f2f2f2);border-radius:8px">
                                            <i class="fa-regular fa-graduation-cap" style="font-size:30px;color:#ccc"></i>
                                        </div>
                                        @endif
                                        <div class="list-body">
                                            <div style="display:flex;align-items:flex-start;justify-content:space-between;gap:10px;flex-wrap:wrap">
                                                <div>
                                                    @if($formation->is_featured)
                                                    <span style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:1px;color:#fd0100">★ Mis en avant · </span>
                                                    @endif
                                                    @if($formation->category)
                                                    <span class="list-cat">{{ $formation->category->name }}</span>
                                                    @endif
                                                    <h3 class="list-title">{{ $formation->title }}</h3>
                                                </div>
                                                <span class="price" style="font-size:18px;font-weight:700;white-space:nowrap">€{{ number_format($formation->price, 2) }}</span>
                                            </div>
                                            @if($formation->description)
                                            <p class="list-desc">{{ Str::limit($formation->description, 150) }}</p>
                                            @endif
                                            <div class="list-footer">
                                                <ul class="review" style="display:flex;gap:3px;list-style:none;padding:0;margin:0">
                                                    @for($i = 1; $i <= 5; $i++)
                                                    <li><i class="fa-solid fa-star" style="{{ $i <= round($formation->average_rating) ? '' : 'opacity:0.25' }}"></i></li>
                                                    @endfor
                                                </ul>
                                                <a href="{{ route('contact') }}?formation={{ urlencode($formation->title) }}"
                                                   class="tl-primary-btn"
                                                   style="font-size:12px;padding:8px 18px">
                                                    Je suis intéressé <span class="icon"><i class="fa-regular fa-arrow-right"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>

                        {{-- Pagination propre --}}
                        @if($formations->hasPages())
                        <div class="ct-pagination">
                            {{-- Précédent --}}
                            @if($formations->onFirstPage())
                            <span class="disabled" aria-disabled="true">‹</span>
                            @else
                            <a href="{{ $formations->previousPageUrl() }}" rel="prev">‹</a>
                            @endif

                            {{-- Pages --}}
                            @foreach($formations->links()->elements as $element)
                                @if(is_string($element))
                                    <span>…</span>
                                @endif
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

                            {{-- Suivant --}}
                            @if($formations->hasMorePages())
                            <a href="{{ $formations->nextPageUrl() }}" rel="next">›</a>
                            @else
                            <span class="disabled" aria-disabled="true">›</span>
                            @endif
                        </div>
                        @endif

                    </div>
                </div>
            </div>
        </section>

@endsection
