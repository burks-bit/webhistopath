<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    protected $fillable = [
        'action_type',
        'action_description',
        'performed_by',
        'performed_at',
    ];

    public $timestamps = true;

    protected $casts = [
        'performed_at' => 'datetime',
    ];

    public function performed_by()
    {
        return $this->belongsTo(User::class, 'performed_by');
    }
}
