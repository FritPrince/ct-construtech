<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Service;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $prefillFormation = $request->query('formation');

        return view('pages.contact', [
            'services'         => Service::where('is_active', true)->orderBy('order')->pluck('title'),
            'prefillFormation' => $prefillFormation,
        ]);
    }

    public function send(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone'     => 'nullable|string|max:50',
            'email'     => 'required|email|max:255',
            'service'   => 'nullable|string|max:255',
            'message'   => 'required|string',
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Votre message a bien été envoyé. Nous vous répondrons dans les plus brefs délais.');
    }
}
