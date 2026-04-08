<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'description', 'location', 'year', 'image', 'is_featured', 'is_active', 'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProjectCategory::class, 'project_project_category');
    }
}
