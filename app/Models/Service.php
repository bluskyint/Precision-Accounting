<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'title',
        'summary',
        'slug',
        'subtitle',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_robots',
        'og_title',
        'og_type',
        'parent_id',
        'content',
        'author_id',
        'visibility',
        'icon',
        'img'
    ];

    protected $casts = [
        'icon' => 'array',
        'img' => 'array'
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
