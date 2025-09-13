<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'project_id',
        'master_task_id',
        'name',
        'description',
        'planned_start',
        'real_start',
        'duration',
        'expiration',
        'planned_end',
        'real_end',
        'budget',
        'status',
        'responsible_id',
        'advance'
    ];

    protected $casts = [
        'planned_start' => 'datetime',
        'real_start' => 'datetime',
        'expiration' => 'datetime',
        'planned_end' => 'datetime',
        'real_end' => 'datetime',
        'budget' => 'decimal:2',
        'advance' => 'decimal:2'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function masterTask()
    {
        return $this->belongsTo(Task::class, 'master_task_id');
    }

    public function subtasks()
    {
        return $this->hasMany(Task::class, 'master_task_id');
    }

    public function responsible()
    {
        return $this->belongsTo(Member::class, 'responsible_id');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }
}
