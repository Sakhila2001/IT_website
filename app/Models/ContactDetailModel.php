<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContactDetailModel extends Model
{
    protected $table = 'contact_details'; // Ensure this matches your database table name
    protected $fillable = [
        'heading',
        'heading_description',
        
        'fav_image',
        'address_info',
        'phone',
        'email',
        'phone2', 
        'email2', 
        'branch_office',
        'head_office',
                'facebook_link', 
                'instagram_link',
                'Linkedin_link', 
                'twitter_link', 
                'whatsapp_link', 
                'map',
                'company_logo',
                'subscription',
                'company_description',
                'seo_image', 
                'seo_title',
                'seo_description',
                'seo_keywords',
                'company_name',

    ];
}



