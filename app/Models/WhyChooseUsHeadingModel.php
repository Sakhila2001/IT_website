<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhyChooseUsHeadingModel extends Model
{
    protected $table = 'why_choose_us_heading';

    protected $fillable = ['small_heading', 'heading', 'heading_description', 'banner_image'];
}
