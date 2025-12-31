<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeModel extends Model
{
    use HasFactory;

    protected $table = 'home'; // Specify the table name

    protected $fillable = [
        'hot_heading_section',
        'heading',
        'heading_description',
        'hero_background_image',
        'is_publish',
        'is_delete',
        'slug',
        'seo_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
    ];
  

}
