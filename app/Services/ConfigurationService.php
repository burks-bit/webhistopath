<?php

namespace App\Services;

use Exception;
use App\Models\Configuration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConfigurationService
{
    // Method to get paginated configurations
    public function get_all_configurations()
    {
        $configurations = Configuration::orderBy('id', 'asc')->paginate(16);
        return $configurations;
    }

    public function create_config($data)
    {
        try {
            Log::info('Attempting to create configuration');
            Log::info($data);

            $configurations = Configuration::create([
                'name' => $data['name'],
                'description' => $data['description'],
                'value' => $data['value'],
                'status' => $data['status'],
                'user_id' => 1
            ]);

            Log::info('Configuration created successfully', ['id' => $configurations->id]);

            return $configurations;
        } catch (\Exception $e) {
            Log::error('Error creating configuration: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'input' => $data,
            ]);

            return response()->json([
                'message' => 'Failed to create configuration.',
                'error' => $e->getMessage()
            ], 500);
        }
    }




    public function update_configuration($data)
    {
        Log::info($data);

        // Find the configuration by ID
        $configurations = Configuration::find($data['id']);

        if ($configurations) {
            $configurations->name = $data['name'];
            $configurations->description = $data['description'];
            $configurations->value = $data['value'];
            $configurations->status = $data['status'];
            $configurations->user_id = 1;
            $configurations->updated_at = now();

            $configurations->save();

            return $configurations;
        }
    }

    public function delete_configuration($data)
    {
        
        Log::info('delete_configuration service accessed');
        Log::info($data);
        $configurations = Configuration::find($data['config_id']);

            if (!$configurations) {
                return response()->json(['message' => 'Configuration not found.'], 404);
            }

            $configurations->delete();

            return $configurations;
    }



}