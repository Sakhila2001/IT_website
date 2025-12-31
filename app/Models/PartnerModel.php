<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerModel extends Model
{

    protected $table = 'partners';

    protected $fillable = ['name','is_publish', 'image',  'is_delete'];

}
