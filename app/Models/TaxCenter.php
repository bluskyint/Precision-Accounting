<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxCenter extends Model
{
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'summary',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'content',
        'visibility',
        'img'
    ];
}
