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

    public function test_result()
    {
        return $this->hasOne(TestResult::class, 'test_order_id');
    }

    public function test_results()
    {
        return $this->hasMany(TestResult::class, 'test_order_id');
    }
}
