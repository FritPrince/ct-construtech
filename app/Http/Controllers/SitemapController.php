<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Service;
use App\Models\Formation;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        $urls = [];

        // Pages statiques
        $staticPages = [
            ['loc' => route('home'),      'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('services'),  'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => route('portfolio'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('formation'), 'priority' => '0.8', 'changefreq' => 'weekly'],
            ['loc' => route('contact'),   'priority' => '0.6', 'changefreq' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = array_merge($page, ['lastmod' => Carbon::now()->toDateString()]);
        }

        // Projets
        $projects = Project::where('is_active', true)->get();
        foreach ($projects as $project) {
            $urls[] = [
                'loc'        => route('portfolio.show', $project),
                'lastmod'    => $project->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.7',
            ];
        }

        // Services
        $services = Service::where('is_active', true)->get();
        foreach ($services as $service) {
            $urls[] = [
                'loc'        => route('services.show', $service),
                'lastmod'    => $service->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.7',
            ];
        }

        // Formations
        $formations = Formation::where('is_active', true)->get();
        foreach ($formations as $formation) {
            $urls[] = [
                'loc'        => route('formation') . '?q=' . urlencode($formation->title),
                'lastmod'    => $formation->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority'   => '0.6',
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($urls as $url) {
            $xml .= "  <url>\n";
            $xml .= '    <loc>' . e($url['loc']) . "</loc>\n";
            if (!empty($url['lastmod']))    $xml .= '    <lastmod>'    . $url['lastmod']    . "</lastmod>\n";
            if (!empty($url['changefreq'])) $xml .= '    <changefreq>' . $url['changefreq'] . "</changefreq>\n";
            if (!empty($url['priority']))   $xml .= '    <priority>'   . $url['priority']   . "</priority>\n";
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>';

        return response($xml, 200, ['Content-Type' => 'application/xml']);
    }
}
