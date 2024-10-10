<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labs')->insert([
            [
                'name' => 'Lab 1',
                'building' => 'Building A',
                'lab_status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab 2',
                'building' => 'Building B',
                'lab_status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lab 3',
                'building' => 'Building C',
                'lab_status' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
