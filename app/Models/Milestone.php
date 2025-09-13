<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'task_id',
        'name',
        'description',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
