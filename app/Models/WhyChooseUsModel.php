<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUsModel extends Model
{
    protected $table = 'why_choose_us'; // Ensure this matches your database table name
    protected $fillable = [
        'title', 'description', 'icon_image', 'is_publish', 'is_delete',
        
    ];
}
