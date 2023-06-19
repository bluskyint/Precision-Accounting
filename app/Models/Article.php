<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

    protected $fillable = [
        'title', 'slug', 'content', 'seo_title', 'seo_description', 'seo_keywords', 'author', 'pinned', 'category_id' , 'img'
    ];


    ############################## Relations ################################
    public function category(){
        return  $this -> belongsTo("App\Models\Category") ;
    }

}
