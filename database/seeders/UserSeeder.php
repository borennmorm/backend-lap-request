<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'role' => 'admin',
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => 'password123',
                'gender' => 'male',
                'phone' => '1234567890',
                'department' => 'IT',
                'faculty' => 'Science and Technology',
                'position' => 'Administrator',
                'image' => 'admin_profile.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'user',
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => 'password123',
                'gender' => 'female',
                'phone' => '0987654321',
                'department' => 'Business',
                'faculty' => 'Commerce',
                'position' => 'Student',
                'image' => 'user_profile.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role' => 'user',
                'name' => 'John Smith',
                'email' => 'john@example.com',
                'password' => 'password123',
                'gender' => 'male',
                'phone' => '5678901234',
                'department' => 'Engineering',
                'faculty' => 'Science and Technology',
                'position' => 'Lecturer',
                'image' => 'user_profile.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
