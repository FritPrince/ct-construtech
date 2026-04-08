<?php

namespace Database\Seeders;

use App\Models\Counter;
use Illuminate\Database\Seeder;

class CounterSeeder extends Seeder
{
    public function run(): void
    {
        $counters = [
            ['value' => 22,  'label' => "Années d'expérience",    'description' => "Améliorer les maisons avec un savoir-faire expert depuis des années", 'order' => 1],
            ['value' => 189, 'label' => 'Projets réalisés',       'description' => "Améliorer les maisons avec un savoir-faire expert depuis des années", 'order' => 2],
            ['value' => 265, 'label' => 'Professionnels qualifiés','description' => "Améliorer les maisons avec un savoir-faire expert depuis des années", 'order' => 3],
            ['value' => 328, 'label' => 'Clients satisfaits',     'description' => "Améliorer les maisons avec un savoir-faire expert depuis des années", 'order' => 4],
        ];

        foreach ($counters as $counter) {
            Counter::create($counter);
        }
    }
}
