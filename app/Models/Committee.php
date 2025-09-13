<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'responsible_id',
        'status',
        'creation_date'
    ];

    protected $casts = [
        'creation_date' => 'date'
    ];

    public function responsible()
    {
        return $this->belongsTo(Member::class, 'responsible_id');
    }

    public function functions()
    {
        return $this->hasMany(CommitteeFunction::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'committee_member');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'committee_document');
    }
}
