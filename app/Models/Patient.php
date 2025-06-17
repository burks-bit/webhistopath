<?php

namespace App\Models;
use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use LogsActivity;
    protected $fillable = [
        'branch_id',
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
        'user_id',
    ];

    public function patient_orders()
    {
        return $this->hasMany(PatientOrder::class, 'patient_id');
    }

    public function patient_order_details()
    {
        return $this->hasMany(PatientOrderDetail::class, 'patient_id');
    }
}
