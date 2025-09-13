<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeFunction extends Model
{
    protected $fillable = [
        'committee_id',
        'nombre',
        'descripcion',
        'ref_act'
    ];

    public function committee()
    {
        return $this->belongsTo(Committee::class);
    }
}
