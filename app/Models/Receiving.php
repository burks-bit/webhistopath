<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Receiving extends Model
{
    use HasFactory;

    protected $fillable = [
        'specimen_id',
        'received_at',
        'received_by_user_id',
        'submitted_by',
        'source_location_id',
        'condition',
        'remarks',
        'status',
    ];

    public function receivedSpecimens()
    {
        return $this->hasMany(ReceivedSpecimen::class, 'specimen_code', 'specimen_id');
    }
    
    public function receivedBy()
    {
        return $this->belongsTo(User::class, 'received_by_user_id');
    }

    public function specimen()
    {
        return $this->belongsTo(PatientOrder::class, 'specimen_id');
    }

    public function source_location()
    {
        return $this->belongsTo(Location::class, 'source_location_id');
    }

}
