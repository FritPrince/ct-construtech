<?php

namespace Database\Seeders;

use App\Models\CompanySetting;
use Illuminate\Database\Seeder;

class CompanySettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'company_name'    => 'CT ConstructTech',
            'tagline'         => 'Nous façonnons des espaces intemporels et inspirants',
            'address'         => 'Adresse, Ville, Pays',
            'phone'           => '+(000) 000-0000',
            'email'           => 'contact@example.com',
            'facebook_url'    => '#',
            'instagram_url'   => '#',
            'twitter_url'     => '#',
            'about_text'      => "Que ce soit pour votre maison, bureau ou un projet commercial, nous sommes toujours dédiés à donner vie à votre vision.",
            'years_founded'   => '2003',
            'vip_clients'     => '75000',
        ];

        foreach ($settings as $key => $value) {
            CompanySetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
