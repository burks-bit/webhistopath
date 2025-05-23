<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\PatientOrderDetail;
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
            
            //  if($patient->save()){
            //      $patient_order_details = PatientOrderDetail::where('patient_id', $patient->id)->get();
            //      Log::info($patient_order_details);
            //      $patient_order_details->branch_id = $data['branch_id'];
            //      $patient_order_details->first_name = $data['first_name'];
            //      $patient_order_details->middle_name = $data['middle_name'];
            //      $patient_order_details->last_name = $data['last_name'];
            //      $patient_order_details->birthdate = $data['birthdate'];
            //      $patient_order_details->age = $age;
            //      $patient_order_details->address = $data['address'];
            //      $patient_order_details->religion = $data['religion'];
            //      $patient_order_details->sex = $data['sex'];
            //      $patient_order_details->civil_status = $data['civil_status'];
            //      $patient_order_details->contact_no = $data['contact_no'];
            //      $patient_order_details->updated_at = now();
            //      $patient_order_details->save();
            //  }

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