<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Member extends Model
{
    use HasFactory, Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

     protected $fillable = [
        'name',
        'slug',
        'job_title',
        'linkedin',
        'info',
        'slider_show',
        'img',
         'seo_title',
         'seo_description',
         'seo_keywords',
         'seo_robots',
         'og_title',
         'og_type',
    ];

    protected $casts = [
        'img' => 'array'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

}
