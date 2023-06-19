<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
{
    use HasFactory;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */

     protected $fillable = [
        'title', 'slug',
    ];

    ############################## Relations ################################
    public function articles(){
        return  $this -> hasMany("App\Models\Article") ;
    }


}
