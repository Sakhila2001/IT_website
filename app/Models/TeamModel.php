<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TeamModel extends Model
{
    protected $table = 'teams'; // Ensure this matches your database table name
    protected $fillable = [
        'name',
        'designation',
        'image',
        'order',
        'facebook_link',
        'instagram_link',
        'Linkedin_link',
        'twitter_link',
        'whatsapp_link',
        'is_publish',
        'is_delete',
    ];
}