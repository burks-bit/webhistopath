<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPhaseAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $phases = [
            '1',
            '1',
            '1',
            '1',
            '1',
            '1',
            '1',
            '1',
            '1',
            '1',
            '1'
        ];

        foreach ($phases as $index => $phase) {
            DB::table('user_phase_accesses')->insert([
                'user_account_id' => 1,
                'phase_access_id' => $index + 1,
                'enabled' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
