<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('location_details')->insert([
            [
                'location_id' => '3',
                'name' => 'RM 1',
                'description' => 'RM 1',
                'enabled' => '1',
            ],
            [
                'location_id' => '3',
                'name' => 'RM 2',
                'description' => 'RM 2',
                'enabled' => '1',
            ],
            [
                'location_id' => '3',
                'name' => 'RM 3',
                'description' => 'RM 3',
                'enabled' => '1',
            ],
        ]);
    }
}
