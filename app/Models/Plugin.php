<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'plguin',
        'class',
        'method',
        'construct_classes',
        'enabled',
        'user_id',
        'is_phase'
    ];
}
