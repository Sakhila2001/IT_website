<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceHeadingModel extends Model
{
    protected $table = 'service_heading'; // Ensure this matches your database table name
    protected $fillable = [
        'small_heading',
        'heading',
        'heading_description',
        'slug',
        'seo_title',
        'seo_description',
        'seo_image',
        'seo_keywords',

    ];
}
