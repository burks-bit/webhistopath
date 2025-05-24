<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\TestOrderService;
use Illuminate\Support\Facades\Log;
use Exception;

class TestOrderController extends Controller
{
    protected $testorderService;

    public function __construct(TestOrderService $testorderService)
    {
        $this->testorderService = $testorderService;
    }

    public function saveTestOrder(Request $request){
        try {
            
            Log::info('accessing saveTestOrder ctrlr');
            $data = $request->all();
            Log::info($data);
            $test_orders = $this->testorderService->save_testorder($data);
            return response()->json([
                'success' => true,
                'test_orders' => $test_orders
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error creating test order'
            ], 500);
        }
    }

    public function getTestOrders(Request $request)
    {
        try {
            $data = $request->all();
            Log::info('============= public function getTestOrders ====');
            Log::info($data);
            $test_orders = $this->testorderService->get_test_orders($data);
            return response()->json([
                'success' => true,
                'test_orders' => $test_orders
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching test order'
            ], 500);
        }
    }

}