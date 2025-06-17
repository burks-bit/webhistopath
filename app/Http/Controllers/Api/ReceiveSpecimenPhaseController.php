<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\ReceiveSpecimenService;
use Illuminate\Support\Facades\Log;
use Exception;

class ReceiveSpecimenPhaseController extends Controller
{
    protected $receiveSpecimenService;

    public function __construct(ReceiveSpecimenService $receiveSpecimenService)
    {
        $this->receiveSpecimenService = $receiveSpecimenService;
    }

    public function receiveSpecimen(Request $request){
        try {
            
            Log::info('accessing receiveSpecimen ctrlr');
            $data = $request->all();
            $test_orders = $this->receiveSpecimenService->save_specimens($data);
            return response()->json([
                'success' => true,
                // 'test_orders' => $test_orders
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error saving specimens'
            ], 500);
        }
    }

    public function getReceivedSpecimens(Request $request){
        try {
            Log::info('accessing getReceivedSpecimens method');
            $data = $request->all();
            Log::info($data);
            $received_specimens = $this->receiveSpecimenService->get_received_specimens();
            return response()->json([
                'success' => true,
                'received_specimens' => $received_specimens
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching specimens'
            ], 500);
        }
    }
}