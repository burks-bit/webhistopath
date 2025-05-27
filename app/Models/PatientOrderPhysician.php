<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientOrderPhysician extends Model
{
    protected $fillable = [
        'specimen_id',
        'physician_id',
        'user_id',
    ];

    public function patient_order()
    {
        return $this->belongsTo(PatientOrder::class, 'specimen_id', 'specimen_id'); // Fix: singular, correct keys
    }

    public function physician()
    {
        return $this->belongsTo(Physician::class, 'physician_id'); // Fix: added missing relationship
    }
}
