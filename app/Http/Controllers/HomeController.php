<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\GalleryItem;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Sponsor;
use App\Models\Testimonial;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'sliders'      => Slider::where('is_active', true)->orderBy('order')->get(),
            'services'     => Service::where('is_active', true)->orderBy('order')->get(),
            'projects'     => Project::where('is_active', true)->where('is_featured', true)->orderBy('order')->limit(8)->get(),
            'counters'     => Counter::orderBy('order')->get(),
            'processSteps' => ProcessStep::orderBy('order')->get(),
            'testimonials' => Testimonial::where('is_active', true)->get(),
            'sponsors'     => Sponsor::where('is_active', true)->orderBy('order')->get(),
            'gallery'      => GalleryItem::where('is_active', true)->orderBy('order')->get(),
        ]);
    }
}
