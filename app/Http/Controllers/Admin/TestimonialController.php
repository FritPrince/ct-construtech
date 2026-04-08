<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonialController extends Controller
{
    public function index()
    {
        return view('admin.testimonials.index', [
            'testimonials' => Testimonial::latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.testimonials.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'author_name'  => 'required|string|max:255',
            'author_role'  => 'nullable|string|max:255',
            'content'      => 'required|string',
            'author_photo' => 'nullable|image|max:5120',
            'rating'       => 'numeric|min:0|max:5',
            'is_active'    => 'boolean',
        ]);

        if ($request->hasFile('author_photo')) {
            $data['author_photo'] = $request->file('author_photo')->store('uploads/testimonials', 'public');
        } else {
            unset($data['author_photo']);
        }

        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage créé avec succès.');
    }

    public function show(Testimonial $testimonial)
    {
        return view('admin.testimonials.show', compact('testimonial'));
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'author_name'  => 'required|string|max:255',
            'author_role'  => 'nullable|string|max:255',
            'content'      => 'required|string',
            'author_photo' => 'nullable|image|max:5120',
            'rating'       => 'numeric|min:0|max:5',
            'is_active'    => 'boolean',
        ]);

        if ($request->hasFile('author_photo')) {
            if ($testimonial->author_photo && !str_starts_with($testimonial->author_photo, 'template/')) {
                Storage::disk('public')->delete($testimonial->author_photo);
            }
            $data['author_photo'] = $request->file('author_photo')->store('uploads/testimonials', 'public');
        } else {
            unset($data['author_photo']);
        }

        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Témoignage supprimé.');
    }
}
