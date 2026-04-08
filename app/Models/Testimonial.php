<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'author_name', 'author_role', 'content', 'author_photo', 'rating', 'is_active',
    ];

    protected $casts = [
        'rating'    => 'decimal:1',
        'is_active' => 'boolean',
    ];
}
