<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'summary', 'slug', 'seo_title', 'seo_description', 'seo_keywords', 'parent_id' , 'content', 'visibility' , 'icon', 'img'
    ];
}
