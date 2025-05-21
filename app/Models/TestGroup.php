<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestGroup extends Model
{
    public $incrementing = false;

    protected $keyType = 'string';

    public function test_group_details()
    {
        return $this->hasMany(TestGroupDetail::class);
    }

}
