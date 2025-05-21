<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    
    public function run(): void
    {
        DB::table('configurations')->insert([
            [
                'name' => 'AutoLogout',
                'description' => 'AutoLogout',
                'value' => '10',
                'status' => '0',
                'user_id' => '1',
            ]
        ]);
    }
}
