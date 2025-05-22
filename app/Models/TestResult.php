<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResult extends Model
{
    protected $fillable = [
        'test_order_id',
        'test_group_id'
    ];

    public function test_order_details()
    {
        return $this->hasMany(TestOrderDetail::class, 'id');
    }
}
