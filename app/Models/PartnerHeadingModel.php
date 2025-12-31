<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerHeadingModel extends Model
{
    protected $table = 'partners_heading';

    protected $fillable = ['small_heading', 'heading', 'heading_description'];
}
