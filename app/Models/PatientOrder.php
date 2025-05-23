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

    // public function patients()
    // {
    //     return $this->belongsTo(Patient::class, 'id');
    // }

    public function patient() {
        return $this->belongsTo(Patient::class);
    }

    public function test_orders()
    {
        return $this->hasMany(TestOrder::class, 'specimen_id', 'specimen_id');
    }

    public function test_results()
    {
        return $this->hasManyThrough(
            TestResult::class,
            TestOrder::class,
            'specimen_id',     // Foreign key on TestOrder
            'test_order_id',   // Foreign key on TestResult
            'specimen_id',     // Local key on PatientOrder
            'id'               // Local key on TestOrder
        );
    }
}
