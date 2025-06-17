<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReceivedSpecimen extends Model
{
    use HasFactory;

    protected $fillable = [
        'receiving_id',
        'patient_order_id',
        'specimen_code',
        'specimen_type',
        'anatomical_site',
        'container_count',
        'test_requested',
        'notes',
    ];

    public function patientOrder()
    {
        return $this->belongsTo(PatientOrder::class, 'patient_order_id', 'specimen_id');
    }

    // public function receiving()
    // {
    //     return $this->belongsTo(Receiving::class, 'specimen_code', 'specimen_id');
    // }
    public function receiving()
    {
        return $this->belongsTo(Receiving::class);
    }
}
