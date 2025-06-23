<?php

// database/seeders/AdminUserSeeder.php
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@bookstore.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
    }
}
