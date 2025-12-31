<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamsHeadingHModel extends Model
{
    protected $table = 'teams_heading';

    protected $fillable = [
        'small_heading',
        'heading',
        'heading_description',
        'seo_title',
        'seo_image',
        'seo_description',
        'seo_keywords'
    ];
}
