<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@ctconstructtech.com'],
            [
                'name'     => 'Admin CT',
                'password' => bcrypt('CT@Admin2025!'),
            ]
        );

        $this->call([
            SliderSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            FormationSeeder::class,
            TestimonialSeeder::class,
            CounterSeeder::class,
            ProcessStepSeeder::class,
            SponsorSeeder::class,
            GalleryItemSeeder::class,
            CompanySettingSeeder::class,
        ]);
    }
}
