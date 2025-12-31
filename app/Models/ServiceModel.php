<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ServiceModel extends Model
{
    protected $table = 'services'; // Ensure this matches your database table name
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'is_publish',
        'is_delete',
        'seo_title',
        'seo_image',
        'seo_description',
        'seo_keywords',
    ];
}