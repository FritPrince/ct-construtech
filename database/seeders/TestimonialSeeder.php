<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'author_name'  => 'Morgan Dufresne',
                'author_role'  => "Propriétaire d'entreprise",
                'content'      => '"Une expérience merveilleuse ! Ils savaient exactement ce qu\'ils faisaient et étaient incroyablement compétents tout au long du processus."',
                'author_photo' => 'template/assets/img/testi/testi-author-1.png',
                'rating'       => 5.0,
                'is_active'    => true,
            ],
            [
                'author_name'  => 'Sophie Lemaire',
                'author_role'  => 'Architecte',
                'content'      => '"CT ConstructTech a transformé notre espace de bureau en un environnement moderne et fonctionnel. Le résultat dépasse toutes nos attentes."',
                'author_photo' => 'template/assets/img/testi/testi-author-1.png',
                'rating'       => 5.0,
                'is_active'    => true,
            ],
            [
                'author_name'  => 'Julien Marchand',
                'author_role'  => 'Chef de projet',
                'content'      => '"Équipe professionnelle, créative et à l\'écoute. Notre rénovation a été livrée dans les délais et le budget convenus. Je recommande vivement."',
                'author_photo' => 'template/assets/img/testi/testi-author-1.png',
                'rating'       => 5.0,
                'is_active'    => true,
            ],
            [
                'author_name'  => 'Isabelle Fontaine',
                'author_role'  => 'Directrice commerciale',
                'content'      => '"Design élégant, matériaux de qualité et suivi impeccable. Notre nouvelle boutique reflète parfaitement l\'image de notre marque."',
                'author_photo' => 'template/assets/img/testi/testi-author-1.png',
                'rating'       => 5.0,
                'is_active'    => true,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::updateOrCreate(
                ['author_name' => $data['author_name']],
                $data
            );
        }
    }
}
