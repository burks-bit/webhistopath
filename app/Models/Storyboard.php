<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Storyboard extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id',
        'default'
    ];
}
