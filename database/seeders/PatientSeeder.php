<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'branch_id'    => 1,
                'first_name'   => 'Juan',
                'middle_name'  => 'Santos',
                'last_name'    => 'Dela Cruz',
                'birthdate'    => '1990-04-15',
                'age'          => '34',
                'address'      => '123 Mabini St., Manila',
                'religion'     => 'Catholic',
                'sex'          => 'M',
                'civil_status' => 'Single',
                'contact_no'   => '09171234567',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Maria',
                'middle_name'  => 'Lopez',
                'last_name'    => 'Garcia',
                'birthdate'    => '1987-11-22',
                'age'          => '36',
                'address'      => '456 Rizal Ave., Quezon City',
                'religion'     => 'Christian',
                'sex'          => 'F',
                'civil_status' => 'Married',
                'contact_no'   => '09281234568',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Jose',
                'middle_name'  => 'Reyes',
                'last_name'    => 'Martinez',
                'birthdate'    => '1975-07-10',
                'age'          => '48',
                'address'      => '789 Bonifacio Blvd., Cebu',
                'religion'     => 'Catholic',
                'sex'          => 'M',
                'civil_status' => 'Married',
                'contact_no'   => '09331234569',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Ana',
                'middle_name'  => 'Cruz',
                'last_name'    => 'Santos',
                'birthdate'    => '1995-01-18',
                'age'          => '28',
                'address'      => '101 Mabuhay St., Davao',
                'religion'     => 'Christian',
                'sex'          => 'F',
                'civil_status' => 'Single',
                'contact_no'   => '09441234570',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Pedro',
                'middle_name'  => 'Garcia',
                'last_name'    => 'Lopez',
                'birthdate'    => '1980-03-30',
                'age'          => '43',
                'address'      => '202 Lapu-Lapu St., Iloilo',
                'religion'     => 'Catholic',
                'sex'          => 'M',
                'civil_status' => 'Married',
                'contact_no'   => '09551234571',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Liza',
                'middle_name'  => 'Martinez',
                'last_name'    => 'Reyes',
                'birthdate'    => '1992-06-05',
                'age'          => '31',
                'address'      => '303 Mabini St., Baguio',
                'religion'     => 'Christian',
                'sex'          => 'F',
                'civil_status' => 'Single',
                'contact_no'   => '09661234572',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Carlos',
                'middle_name'  => 'Dela Cruz',
                'last_name'    => 'Santos',
                'birthdate'    => '1988-12-12',
                'age'          => '35',
                'address'      => '404 Rizal Blvd., Zamboanga',
                'religion'     => 'Catholic',
                'sex'          => 'M',
                'civil_status' => 'Single',
                'contact_no'   => '09771234573',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Grace',
                'middle_name'  => 'Lopez',
                'last_name'    => 'Garcia',
                'birthdate'    => '1997-09-25',
                'age'          => '26',
                'address'      => '505 Quezon St., Bacolod',
                'religion'     => 'Christian',
                'sex'          => 'F',
                'civil_status' => 'Single',
                'contact_no'   => '09881234574',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Miguel',
                'middle_name'  => 'Santos',
                'last_name'    => 'Dela Cruz',
                'birthdate'    => '1983-08-08',
                'age'          => '40',
                'address'      => '606 Bonifacio St., Taguig',
                'religion'     => 'Catholic',
                'sex'          => 'M',
                'civil_status' => 'Married',
                'contact_no'   => '09991234575',
            ],
            [
                'branch_id'    => 1,
                'first_name'   => 'Cecilia',
                'middle_name'  => 'Reyes',
                'last_name'    => 'Martinez',
                'birthdate'    => '1991-02-14',
                'age'          => '32',
                'address'      => '707 Mabuhay St., Pasig',
                'religion'     => 'Christian',
                'sex'          => 'F',
                'civil_status' => 'Married',
                'contact_no'   => '09001234576',
            ],
        ];

        DB::table('patients')->insert($patients);
    }
}
