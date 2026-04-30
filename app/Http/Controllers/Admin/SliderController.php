<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        return view('admin.sliders.index', [
            'sliders' => Slider::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.sliders.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'required|image|max:5120',
            'cta_label'   => 'nullable|string|max:100',
            'cta_url'     => 'nullable|string|max:255',
            'order'       => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        $data['image'] = $request->file('image')->store('uploads/sliders', 'public');

        Slider::create($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider créé avec succès.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:5120',
            'cta_label'   => 'nullable|string|max:100',
            'cta_url'     => 'nullable|string|max:255',
            'order'       => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image && !str_starts_with($slider->image, 'template/')) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('uploads/sliders', 'public');
        } else {
            unset($data['image']);
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider mis à jour.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && !str_starts_with($slider->image, 'template/')) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider supprimé.');
    }
}
