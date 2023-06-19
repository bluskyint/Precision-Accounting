<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Resource extends Model
{
    use HasFactory;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

     protected $fillable = [
        'title', 'content', 'img'
    ];


}
