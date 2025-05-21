<?php

namespace App\Services;

use App\Models\TestGroup;
use Illuminate\Support\Facades\Log;
use Exception;

class TestGroupService
{
    public function get_testgroups()
    {
        try {
            return TestGroup::get();
        } catch (Exception $e) {
            Log::error('Error fetching units: ' . $e->getMessage());
            throw $e;
        }
    }
}