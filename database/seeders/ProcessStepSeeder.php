<?php

namespace Database\Seeders;

use App\Models\ProcessStep;
use Illuminate\Database\Seeder;

class ProcessStepSeeder extends Seeder
{
    public function run(): void
    {
        $steps = [
            ['number' => 1, 'title' => 'Consultation initiale', 'description' => "Nous commençons par comprendre votre vision, vos objectifs et besoins.", 'image' => 'template/assets/img/images/process-img-1.png', 'order' => 1],
            ['number' => 2, 'title' => 'Design & Planification', 'description' => "Nous commençons par comprendre votre vision, vos objectifs et besoins.", 'image' => 'template/assets/img/images/process-img-2.png', 'order' => 2],
            ['number' => 3, 'title' => 'Mise en œuvre',          'description' => "Nous commençons par comprendre votre vision, vos objectifs et besoins.", 'image' => 'template/assets/img/images/process-img-3.png', 'order' => 3],
            ['number' => 4, 'title' => 'Remise du projet',       'description' => "Nous commençons par comprendre votre vision, vos objectifs et besoins.", 'image' => 'template/assets/img/images/process-img-4.png', 'order' => 4],
        ];

        foreach ($steps as $step) {
            ProcessStep::create($step);
        }
    }
}
