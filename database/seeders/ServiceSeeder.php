<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'title'       => 'Design Architectural',
                'description' => "De la grande vision aux moindres détails, notre expertise architecturale donne vie à vos idées avec créativité et précision. Nous concevons des structures qui allient esthétique et fonctionnalité.",
                'icon'        => 'template/assets/img/icon/service-icon-1.png',
                'image'       => 'template/assets/img/service/service-img-1.png',
                'image_text'  => "Services de design personnalisés pour maisons privées, incluant rénovations de pièces et transformations complètes.",
                'order'       => 1,
                'is_active'   => true,
            ],
            [
                'title'       => 'Design Intérieur & Planification',
                'description' => "Nous transformons chaque espace en un environnement harmonieux et fonctionnel. De la conception des plans à la sélection des matériaux, nous gérons chaque étape avec soin et précision.",
                'icon'        => 'template/assets/img/icon/service-icon-2.png',
                'image'       => 'template/assets/img/service/service-img-2.png',
                'image_text'  => "Planification intérieure sur mesure pour espaces résidentiels et commerciaux.",
                'order'       => 2,
                'is_active'   => true,
            ],
            [
                'title'       => 'Services de Conseil',
                'description' => "Nos experts vous accompagnent à chaque étape de votre projet. Conseils en concepts, palettes de couleurs, sélection de matériaux et optimisation de l'espace pour un résultat à la hauteur de vos ambitions.",
                'icon'        => 'template/assets/img/icon/service-icon-3.png',
                'image'       => 'template/assets/img/service/service-img-3.png',
                'image_text'  => "Conseils professionnels sur les concepts, palettes de couleurs & sélection de matériaux.",
                'order'       => 3,
                'is_active'   => true,
            ],
            [
                'title'       => 'Gestion de Projet',
                'description' => "Nous prenons en charge la coordination complète de votre projet de construction ou de rénovation : suivi des délais, gestion des équipes et contrôle qualité pour une livraison dans les règles de l'art.",
                'icon'        => 'template/assets/img/icon/service-icon-4.png',
                'image'       => 'template/assets/img/service/service-img-4.png',
                'image_text'  => "Coordination complète de vos projets de A à Z, dans les délais et le budget convenus.",
                'order'       => 4,
                'is_active'   => true,
            ],
            [
                'title'       => 'Rénovation et Réaménagement',
                'description' => "Nous redonnons vie à vos espaces existants en les modernisant pour améliorer leur fonctionnalité et leur esthétique. Chaque rénovation est pensée pour maximiser la valeur et le confort de votre bien.",
                'icon'        => 'template/assets/img/icon/service-icon-1.png',
                'image'       => 'template/assets/img/service/service-img-5.png',
                'image_text'  => "Rénovation et transformation d'espaces existants pour moderniser votre cadre de vie.",
                'order'       => 5,
                'is_active'   => true,
            ],
        ];

        foreach ($services as $data) {
            Service::updateOrCreate(
                ['title' => $data['title']],
                $data
            );
        }
    }
}
