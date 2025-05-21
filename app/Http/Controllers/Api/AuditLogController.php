<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\AuditLogsService;
use Illuminate\Support\Facades\Log;
use Exception;

class AuditLogController extends Controller
{
    protected $auditlogsService;

    public function __construct(AuditLogsService $auditlogsService)
    {
        $this->auditlogsService = $auditlogsService;
    }

    public function getAuditLogs(Request $request)
    {
        try {
            $audit_logs = $this->auditlogsService->get_AuditLogs();
            return response()->json([
                'success' => true,
                'audit_logs' => $audit_logs
            ]);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching audit_logs.'
            ], 500);
        }
    }

    public function searchAuditLogs(Request $request)
    {
        try {
            $query = $request->input('item');
            $audit_logs = $this->auditlogsService->searchAuditLogs($query);
            return response()->json([
                'success' => true,
                'audit_logs' => $audit_logs
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error searching audit_logs.'], 500);
        }
    }
}
