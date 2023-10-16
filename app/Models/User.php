<?php

namespace App\Models;

//use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'password',
        'active',
        'job_title',
        'linkedin',
        'info',
        'img',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_robots',
        'og_title',
        'og_type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'img' => 'array'
    ];

    public function articles(): HasMany {
        return $this->hasMany(Article::class, 'author_id');
    }
}
