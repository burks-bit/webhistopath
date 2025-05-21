<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\PatientService;
use Illuminate\Support\Facades\Log;
use Exception;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function savePatient(Request $request)
    {
        Log::info('savePatient controller');
        try {
            $data = $request->all();
            Log::info($data);
            $patients = $this->patientService->save_patient($data);
            return response()->json([
                'success' => true,
                'patients' => $patients
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error saving patient.'
            ], 500);
        }
    }

    public function updatePatient(Request $request)
    {
        Log::info('updatePatient accessed');
        try {
            $data = $request->all();
            $patient = $this->patientService->update_patient($data);
            return response()->json([
                'success' => true,
                'patient' => $patient
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error updating patient.'
            ], 500);
        }
    }

    public function searchPatient(Request $request)
    {
        Log::info('searchPatient controller');
        try {
            $query = $request->input('patient');
            $patients = $this->patientService->search_patient($query);

            return response()->json([
                'success' => true,
                'patients' => $patients
            ]);
        } catch (Exception $e) {
            Log::error('Patient search failed: ' . $e->getMessage());
            return response()->json(['error' => 'Search failed.'], 500);
        }
    }

}