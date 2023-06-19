<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;



    protected $fillable = [
        'head_title',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'address' ,
        'location',
        'email',
        'phone' ,
        'sms',
        'whatsapp',
        'linkedin' ,
        'facebook',
        'twitter',
        'youtube' ,
    ];
}
