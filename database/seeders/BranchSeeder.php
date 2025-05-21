<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'name' => 'IT EASY SOFTWARE SOLUTIONS, INC.',
                'description' => 'IT EASY SOFTWARE SOLUTIONS, INC.',
                'code' => 'ITEASY',
                'address' => '5E Mahiyain, Teachers Village West, Diliman Quezon City',
                'status' => '1',
            ]
        ]);
    }
}
