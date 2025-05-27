<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhysicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('physicians')->insert([
            [
                'first_name' => 'Juan',
                'middle_name' => 'Santos',
                'last_name' => 'Dela Cruz',
                'suffix' => NULL,
                'diplomat' => 'MD, FPCP',
                'sex' => 'Male',
                'civil_status' => 'Single',
                'license_no' => 'PH123456',
                'ptr_no' => 'PTR001',
                'clinic_name' => 'St. Luke’s Medical Center',
                'clinic_address' => '279 E. Rodriguez Sr. Ave, Quezon City',
                'clinic_contact_no' => '09171234567',
                'clinic_contact_person' => 'Ana Ramos',
                'created_at' => now()
            ],
            [
                'first_name' => 'Maria',
                'middle_name' => 'Lopez',
                'last_name' => 'Reyes',
                'suffix' => NULL,
                'diplomat' => 'MD, FPCP',
                'sex' => 'Female',
                'civil_status' => 'Married',
                'license_no' => 'PH654321',
                'ptr_no' => 'PTR002',
                'clinic_name' => 'Medical City Clinic',
                'clinic_address' => 'Ortigas Ave, Pasig City',
                'clinic_contact_no' => '09181112222',
                'clinic_contact_person' => 'Carmela Cruz',
                'created_at' => now()
            ],
            [
                'first_name' => 'Jose',
                'middle_name' => 'Manalo',
                'last_name' => 'Ramos',
                'suffix' => NULL,
                'diplomat' => 'MD, FPCP',
                'sex' => 'Male',
                'civil_status' => 'Married',
                'license_no' => 'PH112233',
                'ptr_no' => 'PTR003',
                'clinic_name' => 'Asian Hospital',
                'clinic_address' => '2205 Civic Drive, Filinvest City, Muntinlupa',
                'clinic_contact_no' => '09228889999',
                'clinic_contact_person' => 'Lea Antonio',
                'created_at' => now()
            ],
            [
                'first_name' => 'Catherine',
                'middle_name' => 'Garcia',
                'last_name' => 'Tan',
                'suffix' => NULL,
                'diplomat' => 'MD, FPCP',
                'sex' => 'Female',
                'civil_status' => 'Single',
                'license_no' => 'PH445566',
                'ptr_no' => 'PTR004',
                'clinic_name' => 'Makati Medical Center',
                'clinic_address' => '2 Amorsolo Street, Legaspi Village, Makati',
                'clinic_contact_no' => '09190001234',
                'clinic_contact_person' => 'Feliza Lim',
                'created_at' => now()
            ],
            [
                'first_name' => 'Ramon',
                'middle_name' => 'Torres',
                'last_name' => 'Bautista',
                'suffix' => NULL,
                'diplomat' => 'MD, FPCP',
                'sex' => 'Male',
                'civil_status' => 'Widowed',
                'license_no' => 'PH778899',
                'ptr_no' => 'PTR005',
                'clinic_name' => 'UST Hospital',
                'clinic_address' => 'España Blvd, Sampaloc, Manila',
                'clinic_contact_no' => '09334445555',
                'clinic_contact_person' => 'Grace Mercado',
                'created_at' => now()
            ],
        ]);
    }
}
