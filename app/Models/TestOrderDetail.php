<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestOrderDetail extends Model
{
    protected $fillable = [
        'test_result_id',
        'specimen_id',
        'order_status',
        'test_id'
    ];

    public function test_orders()
    {
        return $this->belongsTo(TestOrder::class, 'id');
    }

    public function test_order_results()
    {
        return $this->hasMany(TestOrderResult::class, 'test_order_detail_id');
    }

    public function test_code()
    {
        return $this->belongsTo(TestCode::class, 'test_id');
    }
}
