<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Physician extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'diplomat',
        'sex',
        'civil_status',
        'license_no',
        'ptr_no',
        'clinic_name',
        'clinic_address',
        'clinic_contact_no',
        'clinic_contact_person',
    ];

    public function patient_order_physicians()
    {
        return $this->hasMany(PatientOrderPhysician::class, 'physician_id'); // Fix: was using belongsToMany incorrectly
    }
}
