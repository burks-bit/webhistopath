<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestOrder extends Model
{
    protected $fillable = [
        'specimen_id',
        'order_status',
        'branch_id',
        'release_level_id',
        'release_date',
        'release_time',
        'cancel_date',
        'cancel_time',
        'cancelling_comment'
    ];

    public function test_order_details()
    {
        return $this->hasMany(TestOrderDetail::class, 'test_order_id');
    }
}
