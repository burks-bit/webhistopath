<?php
namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            AuditLog::create([
                'action_type' => 'CREATE',
                'action_description' => 'Created ' . class_basename($model) . ' with ID ' . $model->id,
                'performed_by' => 2,
                // 'performed_by' => 2,
                'performed_at' => now(),
            ]);
        });

        static::updated(function ($model) {
            AuditLog::create([
                'action_type' => 'UPDATE',
                'action_description' => 'Updated ' . class_basename($model) . ' with ID ' . $model->id,
                'performed_by' => 2,
                // 'performed_by' => 2,
                'performed_at' => now(),
            ]);
        });

        static::deleted(function ($model) {
            AuditLog::create([
                'action_type' => 'DELETE',
                'action_description' => 'Deleted ' . class_basename($model) . ' with ID ' . $model->id,
                'performed_by' => 2,
                // 'performed_by' => 2,
                'performed_at' => now(),
            ]);
        });
    }
}
