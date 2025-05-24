<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReleaseLevel extends Model
{
    protected $fillable = [
        'name',
        'description',
        'sequence',
        'release_status',
        'order_status',
        'result_status',
        'dashboard_view',
        'for_release',
        'enabled',
        'user_id',
        'parent_id'
    ];
}
