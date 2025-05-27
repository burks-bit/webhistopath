<?php

namespace App\Services;

use Exception;
use App\Models\Physician;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PhysicianService
{
    public function get_all_physicians()
    {
        $physicians = Physician::select(
            'id',
            DB::raw("CONCAT(first_name, ' ', LEFT(middle_name, 1), '. ', last_name, ', ', diplomat) as name")
        )
        ->orderBy('last_name', 'asc')
        ->get();

        return $physicians;
    }

}