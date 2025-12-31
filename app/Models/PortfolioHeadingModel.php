<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PortfolioHeadingModel extends Model
{

    protected $table = 'portfolio_heading'; // Ensure this matches your database table name
    protected $fillable = [

        'heading',
        'heading_description',
        'small_heading',
        'slug',
        'seo_title',
        'seo_image',
        'seo_description',
        'seo_keywords',


    ];
}
