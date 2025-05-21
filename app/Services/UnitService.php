<?php

namespace App\Services;

use App\Models\Unit;
use Illuminate\Support\Facades\Log;
use Exception;

class UnitService
{
    public function getAllUnits()
    {
        try {
            return Unit::paginate(12);
        } catch (Exception $e) {
            Log::error('Error fetching units: ' . $e->getMessage());
            throw $e;
        }
    }

    public function create_unit($data)
    {
        try {
            $units = Unit::create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'status' => $data['status'] ?? null,
                'user_id' => 1,
            ]);

            return $units;
        } catch (Exception $e) {
            Log::error('Error creating product: ' . $e->getMessage());
            throw new Exception('Failed to create product.');
        }
    }
}