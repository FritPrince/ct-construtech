<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\FormationCategory;
use Illuminate\Database\Seeder;

class FormationSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'architecture'      => FormationCategory::firstOrCreate(['slug' => 'architecture'],      ['name' => 'Architecture']),
            'design-interieur'  => FormationCategory::firstOrCreate(['slug' => 'design-interieur'],  ['name' => 'Design Intérieur']),
            'construction'      => FormationCategory::firstOrCreate(['slug' => 'construction'],      ['name' => 'Construction']),
            'modelisation-3d'   => FormationCategory::firstOrCreate(['slug' => 'modelisation-3d'],   ['name' => 'Modélisation 3D']),
            'gestion-projet'    => FormationCategory::firstOrCreate(['slug' => 'gestion-projet'],    ['name' => 'Gestion de projet']),
            'renovation'        => FormationCategory::firstOrCreate(['slug' => 'renovation'],        ['name' => 'Rénovation']),
        ];

        $formations = [
            ['title' => 'Architecture Moderne',        'category' => 'architecture',     'price' => 157.00, 'image' => 'template/assets/img/shop/shop-1.png', 'average_rating' => 5.0, 'order' => 1],
            ['title' => 'Design Intérieur Avancé',     'category' => 'design-interieur', 'price' => 157.00, 'image' => 'template/assets/img/shop/shop-2.png', 'average_rating' => 5.0, 'order' => 2],
            ['title' => 'Gestion de Projet BTP',       'category' => 'gestion-projet',   'price' => 157.00, 'image' => 'template/assets/img/shop/shop-3.png', 'average_rating' => 5.0, 'order' => 3],
            ['title' => 'Visualisation 3D',            'category' => 'modelisation-3d',  'price' => 157.00, 'image' => 'template/assets/img/shop/shop-4.png', 'average_rating' => 5.0, 'order' => 4],
            ['title' => 'Rénovation & Réaménagement',  'category' => 'renovation',       'price' => 157.00, 'image' => 'template/assets/img/shop/shop-5.png', 'average_rating' => 5.0, 'order' => 5],
            ['title' => 'Planification Urbaine',       'category' => 'architecture',     'price' => 157.00, 'image' => 'template/assets/img/shop/shop-6.png', 'average_rating' => 5.0, 'order' => 6],
            ['title' => 'Dessin Technique',            'category' => 'architecture',     'price' => 157.00, 'image' => 'template/assets/img/shop/shop-7.png', 'average_rating' => 5.0, 'order' => 7],
            ['title' => 'Matériaux de Construction',   'category' => 'construction',     'price' => 157.00, 'image' => 'template/assets/img/shop/shop-8.png', 'average_rating' => 5.0, 'order' => 8],
            ['title' => 'Droit de la Construction',    'category' => 'construction',     'price' => 157.00, 'image' => 'template/assets/img/shop/shop-9.png', 'average_rating' => 5.0, 'order' => 9],
        ];

        foreach ($formations as $data) {
            Formation::updateOrCreate(
                ['title' => $data['title']],
                [
                    'formation_category_id'=> $categories[$data['category']]->id,
                    'price'                => $data['price'],
                    'image'                => $data['image'],
                    'average_rating'       => $data['average_rating'],
                    'is_active'            => true,
                    'order'                => $data['order'],
                ]
            );
        }
    }
}
