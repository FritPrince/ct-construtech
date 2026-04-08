<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\FormationCategory;

class FormationController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = Formation::with('category')->where('is_active', true);

        // Recherche
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('description', 'like', '%' . $request->q . '%');
            });
        }

        // Filtre catégorie
        if ($request->filled('cat')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $request->cat));
        }

        // Tri
        match ($request->sort) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'rating'     => $query->orderBy('average_rating', 'desc'),
            'featured'   => $query->orderBy('is_featured', 'desc')->orderBy('order'),
            default      => $query->orderBy('order'),
        };

        return view('pages.formation', [
            'formations' => $query->paginate(9)->withQueryString(),
            'categories' => FormationCategory::withCount(['formations' => fn($q) => $q->where('is_active', true)])->get(),
        ]);
    }
}
