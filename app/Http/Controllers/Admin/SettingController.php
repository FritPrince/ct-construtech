<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = CompanySetting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings'   => 'array',
            'settings.*' => 'nullable|string|max:500',
            'logo'       => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
        ]);

        foreach (($data['settings'] ?? []) as $key => $value) {
            CompanySetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        if ($request->hasFile('logo')) {
            $old = CompanySetting::get('logo');
            if ($old && Storage::disk('public')->exists($old)) {
                Storage::disk('public')->delete($old);
            }

            $path = $request->file('logo')->store('uploads/logos', 'public');
            CompanySetting::updateOrCreate(['key' => 'logo'], ['value' => $path]);
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Paramètres enregistrés avec succès.');
    }
}
