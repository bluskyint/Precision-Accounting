<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'author_id',
        'visibility',
        'img'
    ];


    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
