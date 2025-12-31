<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerHeadingModel extends Model
{


    protected $table = 'career_headings';

    protected $fillable = [
        'small_heading',
        'heading',
        'heading_description',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image'
    ];



}
