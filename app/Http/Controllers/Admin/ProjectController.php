<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.projects.index', [
            'projects' => Project::with('categories')->orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.projects.form', [
            'categories' => ProjectCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'year'        => 'nullable|integer|min:2000|max:2099',
            'image'       => 'required|image|max:5120',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
            'categories'  => 'nullable|array',
            'categories.*'=> 'exists:project_categories,id',
        ]);

        $data['image'] = $request->file('image')->store('uploads/projects', 'public');

        $project = Project::create($data);
        $project->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet créé avec succès.');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', ['project' => $project->load('categories')]);
    }

    public function edit(Project $project)
    {
        return view('admin.projects.form', [
            'project'    => $project->load('categories'),
            'categories' => ProjectCategory::all(),
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'location'    => 'nullable|string|max:255',
            'year'        => 'nullable|integer|min:2000|max:2099',
            'image'       => 'nullable|image|max:5120',
            'is_featured' => 'boolean',
            'is_active'   => 'boolean',
            'order'       => 'integer|min:0',
            'categories'  => 'nullable|array',
            'categories.*'=> 'exists:project_categories,id',
        ]);

        if ($request->hasFile('image')) {
            if ($project->image && !str_starts_with($project->image, 'template/')) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('uploads/projects', 'public');
        } else {
            unset($data['image']);
        }

        $project->update($data);
        $project->categories()->sync($request->input('categories', []));

        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet mis à jour.');
    }

    public function destroy(Project $project)
    {
        if ($project->image && !str_starts_with($project->image, 'template/')) {
            Storage::disk('public')->delete($project->image);
        }
        $project->categories()->detach();
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Projet supprimé.');
    }
}
