<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'user_type' => 'admin',
                'name' => 'Admin Bert',
                'email' => 'bert',
                'password' => Hash::make('1'), // Default password
                'role' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'admin',
                'name' => 'Admin Nicks',
                'email' => 'nicks',
                'password' => Hash::make('1'),
                'role' => '0',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'histotech',
                'name' => 'Histotech',
                'email' => 'histotech',
                'password' => Hash::make('1'),
                'role' => '1',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_type' => 'pathologist',
                'name' => 'Pathologist',
                'email' => 'pathologist',
                'password' => Hash::make('1'),
                'role' => '2',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
