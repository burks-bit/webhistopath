<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
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
    ];
}
