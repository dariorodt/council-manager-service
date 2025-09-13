<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'task_id',
        'number',
        'invoice_date',
        'description',
        'provider',
        'total',
        'status',
        'document_id'
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'total' => 'decimal:2'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
