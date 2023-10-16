<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_robots',
        'heading',
        'og_title',
        'og_type'
    ];
}
