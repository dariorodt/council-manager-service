<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    /** @use HasFactory<\Database\Factories\MemberFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'id_document',
        'date_of_birth',
        'email',
        'phone',
        'address',
        'unit',
        'membership_start_date',
        'membership_end_date',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date',
        'membership_start_date' => 'date',
        'membership_end_date' => 'date',
    ];
}
