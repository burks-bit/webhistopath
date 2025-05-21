<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestGroupDetail extends Model
{
    // protected $fillable = [

    // ];
    
    public function test_group()
    {
        return $this->belongsTo(TestGroup::class);
    }
}
