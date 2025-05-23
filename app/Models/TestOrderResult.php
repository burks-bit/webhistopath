<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestOrderResult extends Model
{
    protected $fillable = [
        'test_order_detail_id',
        'value',
        'status',
        'user_id'
    ];

    public function test_order_detail()
    {
        return $this->belongsTo(TestOrderDetail::class);
    }
}
