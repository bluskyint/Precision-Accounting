<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxCenter extends Model
{
    use SoftDeletes, HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'summary',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_robots',
        'og_title',
        'og_type',
        'content',
        'author_id',
        'visibility',
        'img'
    ];

    protected $casts = [
        'img' => 'array'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
