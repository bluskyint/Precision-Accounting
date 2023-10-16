<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use SoftDeletes, HasFactory;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'summary',
        'content',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_robots',
        'og_title',
        'og_type',
        'author_id',
        'pinned',
        'category_id' ,
        'img'
    ];

    protected $casts = [
        'img' => 'array'
    ];


    ############################## Relations ################################
    public function category(){
        return  $this -> belongsTo(Category::class) ;
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
