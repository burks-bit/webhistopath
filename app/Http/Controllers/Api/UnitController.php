<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UnitService;
use Illuminate\Support\Facades\Log;
use Exception;

class UnitController extends Controller
{
    protected $unitService;

    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    public function getUnits(Request $request)
    {
        try {
            $units = $this->unitService->getAllunits();
            return response()->json([
                'success' => true,
                'units' => $units
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching units.'
            ], 500);
        }
    }

    public function createUnit(Request $request)
    {
        Log::info('=============create unit controller ----------');
        try {
            $data = $request->all();
            Log::info($data);
            $units = $this->unitService->create_unit($data);
            return response()->json([
                'success' => true,
                'units' => $units
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching units.'
            ], 500);
        }
    }
}
