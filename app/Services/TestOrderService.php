<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\TestGroup;
use App\Models\PatientOrder;
use App\Models\PatientOrderDetail;
use App\Models\TestOrder;
use App\Models\TestResult;
use App\Models\TestOrderDetail;
use App\Models\TestOrderResult;
use App\Models\SequentialSpecimenId;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;
use DateTime;

class TestOrderService
{
    public function save_testorder($data)
    {
        Log::info('======= save_testorder =======');
        Log::info($data);

        $birthdate = new DateTime($data['patient']['birthdate']);
        $today = new DateTime();
        $age = $today->diff($birthdate)->y;

        $lastSpecimen = SequentialSpecimenId::latest('id')->first();
        $lastSequence = $lastSpecimen ? (int) $lastSpecimen->id : 0;

        $generated_specimen_id = $lastSequence;

        DB::beginTransaction();

        try {
            foreach ($data['tests'] as $dataKey => $test) {
                $generated_specimen_id++;
                $specimen_id = str_pad($generated_specimen_id, 10, '0', STR_PAD_LEFT);

                SequentialSpecimenId::create([
                    'date_generated' => now(),
                    'user_id' => 1
                ]);

                $patientOrder = PatientOrder::create([
                    'specimen_id' => $specimen_id,
                    'external_specimen_id' => $dataKey ?? null,
                    'branch_id' => 1,
                    'patient_id' => $data['patient']['id'],
                    'patient_type' => 1,
                    'location_id' => 1,
                    'date_requested' => date('Y-m-d'),
                    'time_requested' => date('H:i:s'),
                    'user_id' => 1,
                    'status' => 1
                ]);
                Log::info('Patient order created');

                PatientOrderDetail::create([
                    'specimen_id' => $specimen_id,
                    'patient_id' => $data['patient']['id'],
                    'first_name' => $data['patient']['first_name'],
                    'middle_name' => $data['patient']['middle_name'],
                    'last_name' => $data['patient']['last_name'],
                    'birthdate' => $data['patient']['birthdate'],
                    'age' => $age,
                    'address' => $data['patient']['address'],
                    'religion' => $data['patient']['religion'],
                    'sex' => $data['patient']['sex'],
                    'civil_status' => $data['patient']['civil_status'],
                    'contact_no' => $data['patient']['contact_no'],
                ]);
                Log::info('Patient order detail created');

                $testOrder = TestOrder::create([
                    'specimen_id' => $specimen_id,
                    'order_status' => 1,
                    'branch_id' => 1,
                    'release_level_id' => NULL,
                    'release_date' => NULL,
                    'release_time' => NULL,
                    'cancel_date' => NULL,
                    'cancel_time' => NULL,
                    'cancelling_comment' => NULL
                ]);
                Log::info('Test order created');

                $testResult = TestResult::create([
                    'test_order_id' => $testOrder->id,
                    'test_group_id' => $test['id']
                ]);
                Log::info('Test result created');

                $testGroup = TestGroup::with('test_group_details')
                    ->where('id', $test['id'])
                    ->first();

                if (!$testGroup) {
                    throw new Exception("Test group not found for ID: " . $test['id']);
                }

                Log::info('Test group fetched: ' . $testGroup->name);

                foreach ($testGroup->test_group_details as $detail) {
                    $testOrderDetail = TestOrderDetail::create([
                        'test_result_id' => $testResult->id,
                        'specimen_id' => $specimen_id,
                        'order_status' => 1,
                        'test_id' => $detail->test_id,
                    ]);

                    Log::info("Test order detail created for test_id: " . $detail->test_id);

                    TestOrderResult::create([
                        'test_order_detail_id' => $testOrderDetail->id,
                        'value' => NULL,
                        'status' => 1,
                        'user_id' => 1,
                    ]);
                }
            }

            DB::commit();
            Log::info('All records saved successfully.');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed to save test order: ' . $e->getMessage());
            throw $e;
        }
    }

    public function get_test_orders()
    {
        // $test_orders = Patient::with([
        //     'patient_orders',
        //     'patient_order_details',
        //     'patient_orders.test_results',
        //     'patient_orders.test_results.test_group',
        //     'patient_orders.test_results.test_order_details',
        //     'patient_orders.test_results.test_order_details.test_order_results',
        // ])->paginate(6);
        
        $test_orders = PatientOrder::with([
            'patient',
            'test_results.test_group',
            'test_results.test_order_details.test_order_results',
        ])->orderByRaw('TIMESTAMPDIFF(SECOND, date_requested, time_requested) DESC')->paginate(6);

        Log::info($test_orders);

        return $test_orders;   
    }
}
