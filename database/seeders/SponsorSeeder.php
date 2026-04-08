<?php

namespace Database\Seeders;

use App\Models\Sponsor;
use Illuminate\Database\Seeder;

class SponsorSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            Sponsor::create([
                'name'      => "Sponsor $i",
                'logo'      => "template/assets/img/sponsor/sponsor-{$i}.png",
                'url'       => null,
                'order'     => $i,
                'is_active' => true,
            ]);
        }
    }
}
