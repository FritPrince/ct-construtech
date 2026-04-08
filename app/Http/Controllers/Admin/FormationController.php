<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Formation;
use App\Models\FormationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FormationController extends Controller
{
    public function index()
    {
        return view('admin.formations.index', [
            'formations' => Formation::with('category')->orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.formations.form', [
            'categories' => FormationCategory::all(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'nullable|string',
            'formation_category_id'=> 'nullable|exists:formation_categories,id',
            'price'                => 'required|numeric|min:0',
            'image'                => 'nullable|image|max:5120',
            'average_rating'       => 'numeric|min:0|max:5',
            'is_featured'          => 'boolean',
            'is_active'            => 'boolean',
            'order'                => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/formations', 'public');
        } else {
            unset($data['image']);
        }

        Formation::create($data);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation créée avec succès.');
    }

    public function show(Formation $formation)
    {
        return view('admin.formations.show', ['formation' => $formation->load('category')]);
    }

    public function edit(Formation $formation)
    {
        return view('admin.formations.form', [
            'formation'  => $formation,
            'categories' => FormationCategory::all(),
        ]);
    }

    public function update(Request $request, Formation $formation)
    {
        $data = $request->validate([
            'title'                => 'required|string|max:255',
            'description'          => 'nullable|string',
            'formation_category_id'=> 'nullable|exists:formation_categories,id',
            'price'                => 'required|numeric|min:0',
            'image'                => 'nullable|image|max:5120',
            'average_rating'       => 'numeric|min:0|max:5',
            'is_featured'          => 'boolean',
            'is_active'            => 'boolean',
            'order'                => 'integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($formation->image && !str_starts_with($formation->image, 'template/')) {
                Storage::disk('public')->delete($formation->image);
            }
            $data['image'] = $request->file('image')->store('uploads/formations', 'public');
        } else {
            unset($data['image']);
        }

        $formation->update($data);

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation mise à jour.');
    }

    public function destroy(Formation $formation)
    {
        $formation->delete();

        return redirect()->route('admin.formations.index')
            ->with('success', 'Formation supprimée.');
    }
}
