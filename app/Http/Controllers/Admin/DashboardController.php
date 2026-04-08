<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Formation;
use App\Models\Project;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'stats' => [
                'services'     => Service::count(),
                'projects'     => Project::count(),
                'formations'   => Formation::count(),
                'testimonials' => Testimonial::count(),
                'messages'     => ContactMessage::count(),
                'unread'       => ContactMessage::where('is_read', false)->count(),
            ],
            'recentMessages' => ContactMessage::latest()->take(8)->get(),
        ]);
    }
}
