<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        DB::table('test_groups')->insert([
            [
                'id' => 'surgical',
                'name' => 'Surgical',
                'description' => 'Surgical',
                'department' => '1',
                'status' => '1',
            ],
            [
                'id' => 'papsmear',
                'name' => 'Papsmear',
                'description' => 'Papsmear',
                'department' => '2',
                'status' => '1',
            ],
            [
                'id' => 'ihc',
                'name' => 'Immunohistochemistry',
                'description' => 'Immunohistochemistry',
                'department' => '3',
                'status' => '1',
            ],
            [
                'id' => 'cytology',
                'name' => 'Cytology',
                'description' => 'Cytology',
                'department' => '4',
                'status' => '1',
            ],
        ]);
    }
}
