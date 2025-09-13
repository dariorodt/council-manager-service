<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
        'task_id',
        'name',
        'type',
        'description',
        'quantity',
        'unity',
        'unity_cost',
        'total_cost',
        'status'
    ];

    protected $casts = [
        'quantity' => 'decimal:2',
        'unity_cost' => 'decimal:2',
        'total_cost' => 'decimal:2'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
