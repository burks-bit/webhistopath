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
}
