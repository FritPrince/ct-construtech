<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormationCategory extends Model
{
    protected $fillable = ['name', 'slug'];

    public function formations()
    {
        return $this->hasMany(Formation::class, 'formation_category_id');
    }
}
