<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerModel extends Model
{
    protected $table = 'careers';

    protected $fillable = [
            'is_publish',
            'job_descriptions',
            'start_date', 'end_date',
           'title',
           'is_delete',

        ];
}
