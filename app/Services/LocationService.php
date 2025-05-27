<?php

namespace App\Services;

use Exception;
use App\Models\Location;
use Illuminate\Support\Facades\Log;

class LocationService
{
    public function get_all_locations()
    {
        $locations = Location::select('id', 'name')
        ->orderBy('id', 'asc')
        ->get();

        return $locations;
    }

}