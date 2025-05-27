<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPhaseAccess extends Model
{
    protected $fillable = [
        'user_account_id',
        'phase_access',
        'enabled'
    ];
}
