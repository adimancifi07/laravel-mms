<?php

namespace Database\Seeders;

// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Super Admin',
                'username' => 'root',
                'email' => 'root@vlara.dev',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'AdminVlara',
                'username' => 'admin',
                'email' => 'admin@vlara.dev',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123456'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Adiman',
                'username' => 'adiman',
                'email' => 'adiman@vlara.dev',
                'email_verified_at' => now(),
                'password' => Hash::make('adiman123456'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        User::factory(5)->create();
    }
}
