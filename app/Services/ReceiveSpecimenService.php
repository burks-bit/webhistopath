<?php

namespace App\Services;

use App\Models\PatientOrder;
use App\Models\Receiving;
use App\Models\ReceivedSpecimen;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;

class ReceiveSpecimenService
{
    public function save_specimens($data)
    {
        Log::info('======= save_specimens =======');
        Log::info($data);
        Log::info('=================auth id ===========');
        Log::info(Auth::id());

        DB::beginTransaction();

        try {
            $receiving = Receiving::create([
                'specimen_id' => $data['patient_order_specimen_id'],
                'received_at' => now(),
                'received_by_user_id' => Auth::id(),
                'submitted_by' => 1, // Default to 1 if unauthenticated
                'source_location_id' => $data['patient_order_location_id'],
                'condition' => 'Intact',
                'remarks' => $data['remarks'] ?? null,
                'status' => 'received',
            ]);

            Log::info('Receiving created successfully.', ['receiving_id' => $receiving->id]);

            foreach ($data['specimen_details'] as $specimen) {
                ReceivedSpecimen::create([
                    'receiving_id' => $receiving->id,
                    'patient_order_id' => $data['patient_order_specimen_id'],
                    'specimen_code' => $specimen['specimen_code'] ?? null,
                    'specimen_type' => $specimen['specimen_type'] ?? null,
                    'anatomical_site' => $specimen['anatomical_site'] ?? null,
                    'container_count' => $specimen['container_count'] ?? 1,
                    'test_requested' => $specimen['test_requested'] ?? null,
                    'notes' => $specimen['notes'] ?? null,
                    'created_at' => now(),
                    'updated_at' => NULL
                ]);
            }

            DB::commit();
            Log::info('All specimens saved successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to save receiving: ' . $e->getMessage());
            throw $e;
        }
    }

    public function get_test_orders($data)
    {
        if(isset($data['filter_parameter'])){
            Log::info('get_test_orders With filter');
            $test_orders = PatientOrder::with([
                'patient',
                'location',
                'patient_order_physicians', 
                'test_results.test_group',
                'test_results.test_order_details.test_order_results',
            ])
            ->whereBetween('date_requested', [
                $data['filter_parameter']['start_date'],
                $data['filter_parameter']['end_date']
            ])
            ->orderByRaw('TIMESTAMPDIFF(SECOND, date_requested, time_requested) DESC')
            ->paginate(5);
        } else {
            Log::info('get_test_orders Without filter');
            $test_orders = PatientOrder::with([
                'patient',
                'location',
                'patient_order_physicians.physician', 
                'test_results.test_group',
                'test_results.test_order_details.test_order_results',
            ])
            ->where('date_requested', date('Y-m-d'))
            ->orderByRaw('TIMESTAMPDIFF(SECOND, date_requested, time_requested) DESC')
            ->paginate(5);
        }

        Log::info($test_orders);

        return $test_orders;   
    }

    public function get_received_specimens($limit = 10)
    {
        try {
            $specimens = ReceivedSpecimen::with(['receiving', 'receiving.specimen', 'receiving.source_location']) // Adjust relationships as needed
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();

            Log::info('Fetched recently received specimens', ['count' => $specimens->count()]);

            return $specimens;
        } catch (Exception $e) {
            Log::error('Failed to fetch received specimens: ' . $e->getMessage());
            throw $e;
        }
    }

}
