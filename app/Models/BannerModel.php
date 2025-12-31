<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerModel extends Model
{
    protected $table = 'banner';

    protected $fillable = ['title', 'is_publish', 'is_delete'];

}
