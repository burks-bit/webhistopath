<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user_roles')->insert([
            [
                'role_name' => 'admin',
                'status' => '1'
            ],
            [
                'role_name' => 'histotech',
                'status' => '1'
            ],
            [
                'role_name' => 'pathologist',
                'status' => '1'
            ],
            [
                'role_name' => 'clerk',
                'status' => '1'
            ]
        ]);
    }
}
