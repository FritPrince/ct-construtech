<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    public function run(): void
    {
        $sliders = [
            [
                'title'       => "L'Art du Design Intérieur Exceptionnel",
                'subtitle'    => 'RAPIDE ET FIABLE',
                'description' => "Que ce soit pour votre maison, bureau ou un projet commercial, nous sommes dédiés à donner vie à votre vision.",
                'image'       => 'template/assets/img/bg-img/slider-img-1.png',
                'cta_label'   => 'Prendre conseil',
                'cta_url'     => '/contact',
                'order'       => 1,
                'is_active'   => true,
            ],
            [
                'title'       => "L'Art du Design Intérieur Exceptionnel",
                'subtitle'    => 'RAPIDE ET FIABLE',
                'description' => "Que ce soit pour votre maison, bureau ou un projet commercial, nous sommes dédiés à donner vie à votre vision.",
                'image'       => 'template/assets/img/bg-img/slider-img-2.png',
                'cta_label'   => 'Prendre conseil',
                'cta_url'     => '/contact',
                'order'       => 2,
                'is_active'   => true,
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
