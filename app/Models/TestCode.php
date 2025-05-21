<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestCode extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'description',
        'status',
    ];
}
