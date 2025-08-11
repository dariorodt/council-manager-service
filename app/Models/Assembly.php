<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assembly extends Model
{
    /** @use HasFactory<\Database\Factories\AssemblyFactory> */
    use HasFactory;

    protected $fillable = [
        'correlative',
        'type',
        'reason',
        'status',
        'scheduled_date',
        'actual_date',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
        'actual_date' => 'datetime',
    ];

    public function attendees()
    {
        return $this->hasMany(Attendee::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function resolutions()
    {
        return $this->hasMany(Resolution::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'assembly_documents');
    }
}
