<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('locations')->insert([
            [
                'name' => 'None',
                'description' => 'None',
                'enabled' => '1',
            ],
            [
                'name' => 'OPD',
                'description' => 'OPD',
                'enabled' => '1',
            ],
            [
                'name' => 'ER',
                'description' => 'ER',
                'enabled' => '1',
            ],
            [
                'name' => 'IPD',
                'description' => 'IPD',
                'enabled' => '1',
            ],
        ]);
    }
}
