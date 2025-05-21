<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use DateTime;
use Exception;

class PatientService
{
    public function save_patient($data)
    {
        try {
            $birthdate = new DateTime($data['birthdate']);
            $today = new DateTime();
            $age = $today->diff($birthdate)->y;
            $patients = Patient::create([
                'branch_id' => 1,
                'first_name' => $data['first_name'],
                'middle_name' => $data['middle_name'],
                'last_name' => $data['last_name'],
                'birthdate' => $data['birthdate'],
                'age' => $age,
                'address' => $data['address'],
                'religion' => $data['religion'],
                'sex' => $data['sex'],
                'civil_status' => $data['civil_status'],
                'contact_no' => $data['contact_no'],
            ]);

            return $patients;
        } catch (Exception $e) {
            Log::error('Error creating patient: ' . $e->getMessage());
            throw new Exception('Failed to create patient.');
        }
    }

    public function update_patient($data)
    {
        Log::info($data);
        $birthdate = new DateTime($data['birthdate']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;
        $patient = Patient::find($data['id']);

        if ($patient) {
            $patient->branch_id = $data['branch_id'];
            $patient->first_name = $data['first_name'];
            $patient->middle_name = $data['middle_name'];
            $patient->last_name = $data['last_name'];
            $patient->birthdate = $data['birthdate'];
            $patient->age = $age;
            $patient->address = $data['address'];
            $patient->religion = $data['religion'];
            $patient->sex = $data['sex'];
            $patient->civil_status = $data['civil_status'];
            $patient->contact_no = $data['contact_no'];
            $patient->updated_at = now();

            $patient->save();

            return $patient;
        }
    }

    public function search_patient($query)
    {
        try {
            return Patient::where(function ($q) use ($query) {
                    $q->where('last_name', 'LIKE', "%{$query}%")
                    ->orWhere('first_name', 'LIKE', "%{$query}%")
                    ->orWhere('middle_name', 'LIKE', "%{$query}%");
                })
                ->get();
        } catch (\Exception $e) {
            Log::error("Patient search failed: {$e->getMessage()}", [
                'query' => $query,
                'exception' => $e
            ]);
            throw $e;
        }
    }


}