<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'correlative',
        'type',
        'unit',
        'committee_id',
        'reason',
        'status',
        'scheduled_date',
        'actual_date',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'actual_date' => 'datetime',
    ];
}
