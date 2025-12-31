<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'usertype' => 'admin',
            'password' => Hash::make('12345678'),
        ]);
    }
}
