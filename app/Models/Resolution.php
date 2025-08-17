<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    protected $fillable = [
        'assembly_id',
        'subject_id',
        'title',
        'description',
        'resolution',
    ];

    public function assembly()
    {
        return $this->belongsTo(Assembly::class);
    }
}
