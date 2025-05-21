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