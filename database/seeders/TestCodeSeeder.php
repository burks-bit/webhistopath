<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testCodes = [];

        for ($i = 1; $i <= 50; $i++) {
            $testCodes[] = [
                'id' => 'testcode' . $i,
                'name' => 'Testcode ' . $i,
                'description' => 'Testcode ' . $i,
                'status' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('test_codes')->insert($testCodes);
    }
}
