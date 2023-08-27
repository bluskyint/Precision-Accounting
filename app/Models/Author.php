<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'linkedin',
        'job_title',
        'info',
        'img'
    ];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function TaxCenters(): HasMany
    {
        return $this->hasMany(TaxCenter::class);
    }
}
