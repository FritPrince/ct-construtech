<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $residential = ProjectCategory::firstOrCreate(['slug' => 'residentiel'], ['name' => 'Résidentiel']);
        $individual  = ProjectCategory::firstOrCreate(['slug' => 'maison-individuelle'], ['name' => 'Maison individuelle']);

        $projects = [
            ['title' => 'Luxury Skyline',          'location' => 'Berlin, Germany',   'year' => 2025, 'image' => 'template/assets/img/project/project-img-1.png', 'is_featured' => true],
            ['title' => 'Bohemian Rhapsody',        'location' => 'Paris, France',     'year' => 2025, 'image' => 'template/assets/img/project/project-img-2.png', 'is_featured' => true],
            ['title' => 'Vintage Glamour',          'location' => 'Lyon, France',      'year' => 2024, 'image' => 'template/assets/img/project/project-img-3.png', 'is_featured' => true],
            ['title' => 'Titan Office Interior',    'location' => 'Bruxelles, Belgique','year' => 2024, 'image' => 'template/assets/img/project/project-img-4.png', 'is_featured' => true],
            ['title' => 'Living Innovation',        'location' => 'Genève, Suisse',    'year' => 2025, 'image' => 'template/assets/img/project/project-img-5.png', 'is_featured' => true],
            ['title' => 'Coastal Harmony Home',     'location' => 'Nice, France',      'year' => 2024, 'image' => 'template/assets/img/project/project-1.png',     'is_featured' => false],
            ['title' => 'Urban Loft Redesign',      'location' => 'Bordeaux, France',  'year' => 2023, 'image' => 'template/assets/img/project/project-2.png',     'is_featured' => false],
            ['title' => 'Modern Villa Project',     'location' => 'Marseille, France', 'year' => 2023, 'image' => 'template/assets/img/project/project-4.png',     'is_featured' => false],
        ];

        foreach ($projects as $i => $data) {
            $project = Project::updateOrCreate(
                ['title' => $data['title']],
                array_merge($data, [
                    'is_active' => true,
                    'order'     => $i + 1,
                ])
            );
            if ($project->categories()->count() === 0) {
                $project->categories()->attach([$residential->id, $individual->id]);
            }
        }
    }
}
