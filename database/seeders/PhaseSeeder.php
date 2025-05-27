<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       
        $phases = [
            'Create Order',
            'Receiving',
            'Histopath Receiving',
            'Specimen Processing',
            'Slide Release',
            'Grossing',
            'Initial Result',
            'Initial Read',
            'Final Read',
            'Validation',
            'Releasing',
        ];

        foreach ($phases as $index => $phase) {
            DB::table('phases')->insert([
                'name' => $phase,
                'description' => $phase . ' phase description',
                'sequence' => $index + 1,
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
