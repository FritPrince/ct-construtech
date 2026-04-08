<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('pages.portfolio', [
            'projects'   => Project::with('categories')->where('is_active', true)->orderBy('order')->get(),
            'categories' => ProjectCategory::all(),
        ]);
    }

    public function show(Project $project)
    {
        abort_if(!$project->is_active, 404);
        $otherProjects = Project::with('categories')
            ->where('is_active', true)
            ->where('id', '!=', $project->id)
            ->orderBy('order')
            ->take(4)
            ->get();
        return view('pages.portfolio-details', compact('project', 'otherProjects'));
    }
}
