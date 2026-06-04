<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslatorProfile extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'academic_title',

        'university',

        'expertise',

        'languages',

        'hourly_rate',

        'publication_count',

        'verification_status',

        'bio'
    ];

    protected $casts = [

        'publication_count' => 'integer',

        'hourly_rate' => 'decimal:2'
    ];

    public function user()
    {
        return $this->belongsTo(
            User::class
        );
    }

    public function scopeApproved($query)
    {
        return $query->where(
            'verification_status',
            'approved'
        );
    }

    public function getStatusColorAttribute()
    {
        return match($this->verification_status)
        {
            'approved' => 'green',

            'pending' => 'yellow',

            'rejected' => 'red',

            default => 'gray'
        };
    }
}