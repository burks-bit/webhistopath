<?php

namespace App\Services;

use App\Models\Patient;
use App\Models\TestGroup;
use Illuminate\Support\Facades\Log;
use Exception;

class TestOrderService
{
    public function save_testorder($data)
    {
        $testIds = array_column($data['tests'], 'id');

        $testGroupsWithDetails = TestGroup::with('test_group_details')
            ->whereIn('id', $testIds)
            ->get();


        Log::info($testGroupsWithDetails);
    }

}