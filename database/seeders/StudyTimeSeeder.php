<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudyTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('study_times')->insert([
            [
                'time' => '07:00 - 08:30',
                'number' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '08:40 - 10:20',
                'number' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '10:30 - 12:00',
                'number' => '3',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '01:00 - 02:30',
                'number' => '4',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '02:40 - 03:20',
                'number' => '5',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'time' => '03:30 - 05:00',
                'number' => '6',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
