<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SequentialSpecimenId extends Model
{
    protected $fillable = [
        'date_generated',
        'user_id'
    ];
}
