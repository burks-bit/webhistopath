<?php

namespace App\Services;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Log;
use Exception;

class AuditLogsService
{
    public function get_AuditLogs()
    {
        try {
            return AuditLog::with('performed_by')->latest()->paginate(12);
        } catch (\Exception $e) {
            \Log::error('Error fetching audit_logs: ' . $e->getMessage());
            throw $e;
        }
    }

    public function searchAuditLogs($query)
    {
        try {
            return AuditLog::with('performed_by')
                ->where('action_type', 'LIKE', "%{$query}%")
                ->orWhere('action_description', 'LIKE', "%{$query}%")
                ->orWhereHas('performed_by', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                    ->orWhere('email', 'LIKE', "%{$query}%");
                })
                ->paginate(12);
        } catch (Exception $e) {
            Log::error('Error searching for audit logs: ' . $e->getMessage());
            throw $e;
        }
    }
}