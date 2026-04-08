<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryItem extends Model
{
    protected $fillable = ['image', 'alt', 'order', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
