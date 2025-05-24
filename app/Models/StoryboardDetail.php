<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoryboardDetail extends Model
{
    protected $fillable = [
        'story_board_id',
        'stage_id',
        'phase_id',
        'sequence',
        'status',
        'user_id'
    ];
}
