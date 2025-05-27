<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phase extends Model
{
    protected $fillable = [
        'stage_id',
        'type',
        'status',
        'user_id',
        'sequence',
        'function_id',
        'custom_function_id',
        'significance',
        'name',
        'description',
        'sequential',
        'view_function_id',
        'transaction_type',
        'sub_type',
        'quick_function_id',
        'password_protected',
        'single_user',
        'performed_datetime',
        'locked',
        'performed_by',
        'release_heirarchy',
        'multilevel',
        'physician',
        'required_release_level',
        'auto_assign'
    ];
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_phase_accesses', 'phase_access_id', 'user_account_id');
    }
}
