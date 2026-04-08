<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    protected $fillable = [
        'title', 'description', 'formation_category_id', 'price', 'image',
        'average_rating', 'is_featured', 'is_active', 'order',
    ];

    protected $casts = [
        'price'          => 'decimal:2',
        'average_rating' => 'decimal:1',
        'is_featured'    => 'boolean',
        'is_active'      => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(FormationCategory::class, 'formation_category_id');
    }
}
