<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Exception;

class PatientService
{
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