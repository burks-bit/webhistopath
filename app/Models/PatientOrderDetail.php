<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientOrderDetail extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'specimen_id',
        'patient_id',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'age',
        'address',
        'religion',
        'sex',
        'civil_status',
        'contact_no',
    ];

    public function patients()
    {
        return $this->belongsTo(Patient::class, 'id');
    }
}
