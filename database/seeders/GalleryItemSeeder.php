<?php

namespace Database\Seeders;

use App\Models\GalleryItem;
use Illuminate\Database\Seeder;

class GalleryItemSeeder extends Seeder
{
    public function run(): void
    {
        $images = [6, 7, 8, 9, 10, 11, 12, 13];

        foreach ($images as $i => $num) {
            GalleryItem::create([
                'image'     => "template/assets/img/project/project-img-{$num}.png",
                'alt'       => "Galerie image {$num}",
                'order'     => $i + 1,
                'is_active' => true,
            ]);
        }
    }
}
