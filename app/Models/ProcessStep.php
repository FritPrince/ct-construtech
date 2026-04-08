<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProcessStep extends Model
{
    protected $fillable = ['number', 'title', 'description', 'image', 'order'];
}
