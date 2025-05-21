<?php

namespace App\Models;
use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Configuration extends Model
{
    use LogsActivity;
    use HasFactory;
    protected $fillable = ['name', 'description', 'value', 'status', 'user_id'];

}
