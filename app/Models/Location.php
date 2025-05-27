<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'name',
        'description'
    ];

    public function patient_orders()
    {
        return $this->hasMany(PatientOrder::class, 'location_id');
    }
}
