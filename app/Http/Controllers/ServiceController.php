<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        return view('pages.services', [
            'services' => Service::where('is_active', true)->orderBy('order')->get(),
        ]);
    }

    public function show(Service $service)
    {
        abort_if(!$service->is_active, 404);

        $otherServices = Service::where('is_active', true)
            ->where('id', '!=', $service->id)
            ->orderBy('order')
            ->get();

        return view('pages.service-details', compact('service', 'otherServices'));
    }
}
