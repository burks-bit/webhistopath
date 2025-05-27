<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\PhysicianService;
use Illuminate\Support\Facades\Log;
use Exception;

class PhysicianController extends Controller
{
    protected $physicianService;

    public function __construct(PhysicianService $physicianService)
    {
        $this->physicianService = $physicianService;
    }

    public function getPhysicians()
    {
        try {
            $physicians = $this->physicianService->get_all_physicians();
            return response()->json([
                'message' => 'physicians fetched successfully!',
                'physicians' => $physicians
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching physicians.'
            ], 500);
        }
    }
}