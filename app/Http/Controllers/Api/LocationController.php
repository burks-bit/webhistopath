<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\LocationService;
use Illuminate\Support\Facades\Log;
use Exception;

class LocationController extends Controller
{
    protected $locationService;

    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    public function getLocations()
    {
        try {
            $locations = $this->locationService->get_all_locations();
            return response()->json([
                'message' => 'locations fetched successfully!',
                'locations' => $locations
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching locations.'
            ], 500);
        }
    }
}