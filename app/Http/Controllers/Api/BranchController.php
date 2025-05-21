<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\BranchService;
use Illuminate\Support\Facades\Log;
use Exception;

class BranchController extends Controller
{
    protected $branchService;

    public function __construct(BranchService $branchService)
    {
        $this->branchService = $branchService;
    }

    public function getBranch(Request $request)
    {
        try {
            $branch = $this->branchService->get_branch();

            return response()->json([
                'success' => true,
                'branch' => $branch
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Error fetching branch.'
            ], 500);
        }
    }

}
