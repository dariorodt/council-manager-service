<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendee extends Model
{
    protected $fillable = [
        'assembly_id',
        'meeting_id',
        'is_member',
        'name',
        'position',
        'attended',
    ];

    protected $casts = [
        'is_member' => 'boolean',
        'attended' => 'boolean',
    ];
}
