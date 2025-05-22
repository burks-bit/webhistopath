<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientOrder extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'specimen_id',
        'external_specimen_id',
        'branch_id',
        'patient_id',
        'patient_type',
        'location_id',
        'date_requested',
        'time_requested',
        'user_id',
        'status',
    ];

    public function patients()
    {
        return $this->belongsTo(Patient::class, 'id');
    }
}
