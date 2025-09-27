<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Milestone extends Model
{
    protected $fillable = [
        'task_id',
        'project_id',
        'name',
        'description',
        'date'
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
