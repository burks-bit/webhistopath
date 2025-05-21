<?php
namespace App\Services;

use Exception;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BranchService
{
    public function get_branch()
    {
        // Just return the data, not a response object
        return DB::table('branches')->where('id', 1)->get();
    }
}