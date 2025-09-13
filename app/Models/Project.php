<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'committee_id',
        'function_id',
        'name',
        'description',
        'status',
        'planned_start',
        'real_start',
        'planned_end',
        'duration',
        'real_end',
        'advance'
    ];

    protected $casts = [
        'planned_start' => 'datetime',
        'real_start' => 'datetime',
        'planned_end' => 'datetime',
        'real_end' => 'datetime',
        'advance' => 'decimal:2'
    ];

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }

    public function function()
    {
        return $this->belongsTo(CommitteeFunction::class, 'function_id');
    }

    public function responsibles()
    {
        return $this->belongsToMany(Member::class, 'project_member');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
