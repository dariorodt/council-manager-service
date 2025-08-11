<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'assembly_id',
        'meeting_id',
        'title',
        'proposed_by',
        'description',
        'state',
    ];
}
