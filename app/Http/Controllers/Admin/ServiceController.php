<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.services.index', [
            'services' => Service::orderBy('order')->get(),
        ]);
    }

    public function create()
    {
        return view('admin.services.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|max:5120',
            'image'       => 'nullable|image|max:5120',
            'image_text'  => 'nullable|string|max:500',
            'order'       => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('uploads/services', 'public');
        } else {
            unset($data['icon']);
        }

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('uploads/services', 'public');
        } else {
            unset($data['image']);
        }

        Service::create($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service créé avec succès.');
    }

    public function show(Service $service)
    {
        return view('admin.services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'icon'        => 'nullable|image|max:5120',
            'image'       => 'nullable|image|max:5120',
            'image_text'  => 'nullable|string|max:500',
            'order'       => 'integer|min:0',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('icon')) {
            if ($service->icon && !str_starts_with($service->icon, 'template/')) {
                Storage::disk('public')->delete($service->icon);
            }
            $data['icon'] = $request->file('icon')->store('uploads/services', 'public');
        } else {
            unset($data['icon']);
        }

        if ($request->hasFile('image')) {
            if ($service->image && !str_starts_with($service->image, 'template/')) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('uploads/services', 'public');
        } else {
            unset($data['image']);
        }

        $service->update($data);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service mis à jour.');
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.services.index')
            ->with('success', 'Service supprimé.');
    }
}
