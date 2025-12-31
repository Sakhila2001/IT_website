<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class AboutModel extends Model
{
    use HasFactory;

    protected $table = 'about';

    protected $fillable = [
        'title',
        'is_publish',
        'banner_image',
        'counter_image',
        'description',
        'core_description',
        'mission_description',
        'vision_description',
        'is_delete',
        'years_of_experience',
        'no_of_employees',
        'no_of_users',
        'image1',
        'image2',
        'no_of_satisfied_clients',
        'slug',
        'seo_image',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'small_heading',
        'heading'
    ];

}
