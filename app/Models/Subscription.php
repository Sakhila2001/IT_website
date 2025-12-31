<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $table = 'subscriptions'; // Ensure this matches your database table name
    protected $fillable = [
        'email', 'is_delete',
        
    ];
}
