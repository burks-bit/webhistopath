<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\TestGroupService;
use Illuminate\Support\Facades\Log;
use Exception;

class TestGroupController extends Controller
{
    protected $testgroupService;

    public function __construct(TestGroupService $testgroupService)
    {
        $this->testgroupService = $testgroupService;
    }

    public function getTestgroups()
    {
        try {
            $test_groups = $this->testgroupService->get_testgroups();
            return response()->json([
                'success' => true,
                'test_groups' => $test_groups
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching test_groups.'
            ], 500);
        }
    }
}