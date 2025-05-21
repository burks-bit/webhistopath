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
            $test_order = $this->testorderService->save_testorder($data);
            // return response()->json([
            //     'success' => true,
            //     'message' => 'Config created successfully!',
            //     'configurations' => $configurations
            // ], 201);
        } catch (Exception $e) {
            // return response()->json([
            //     'error' => 'Error creating Config.'
            // ], 500);
        }
    }

}