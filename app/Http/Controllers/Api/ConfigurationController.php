<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\ConfigurationService;
use Illuminate\Support\Facades\Log;
use Exception;

class ConfigurationController extends Controller
{
    protected $configurationService;

    public function __construct(ConfigurationService $configurationService)
    {
        $this->configurationService = $configurationService;
    }

    public function get_configurations()
    {
        try {
            $configurations = $this->configurationService->get_all_configurations();
            return response()->json([
                'message' => 'Configurations fetched successfully!',
                'configurations' => $configurations
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching configurations.'
            ], 500);
        }
    }

    public function createConfiguration(Request $request){
        try {
            
            Log::info('accessing configuration ctrlr');
            $data = $request->all();
            $configurations = $this->configurationService->create_config($data);
            return response()->json([
                'success' => true,
                'message' => 'Config created successfully!',
                'configurations' => $configurations
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error creating Config.'
            ], 500);
        }
    }

    public function edit($id){
        try {
            $configurations = $this->configurationService->createProduct($id);
            return response()->json([
                'message' => 'Config updated!',
                'configurations' => $configurations
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error updating Config.'
            ], 500);
        }
    }

    public function updateConfiguration(Request $request)
    {
        Log::info('updateConfiguration accessed');
        try {
            $data = $request->all();
            $configurations = $this->configurationService->update_configuration($data);
            return response()->json([
                'success' => 'true',
                'message' => 'Config updated!',
                'configurations' => $configurations
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error updating Config.'
            ], 500);
        }
    }

    public function deleteConfig(Request $request)
    {
        Log::info('deleteConfig accessed'); 
        try {
            $data = $request->all();
            $configurations = $this->configurationService->delete_configuration($data);
            return response()->json([
                'success' => 'true',
                'message' => 'Config deleted!'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error updating Config.'
            ], 500);
        }
    }

}
