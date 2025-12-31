<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class Helper
{
    /**
     * Get configuration value from database
     */
    public static function getInfoValue($key)
    {
        return DB::connection('mysql')
            ->table('site_settings')
            ->where('key', $key)
            ->value('value');
    }
    
    // Add more helper methods as needed
}