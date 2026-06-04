<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslatorRequest extends Model
{
    use HasFactory;

    protected $fillable = [

        'order_id',

        'translator_id',

        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(
            Order::class
        );
    }

    public function translator()
    {
        return $this->belongsTo(
            User::class,
            'translator_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopePending($query)
    {
        return $query->where(
            'status',
            'pending'
        );
    }

    public function scopeAccepted($query)
    {
        return $query->where(
            'status',
            'accepted'
        );
    }

    public function scopeRejected($query)
    {
        return $query->where(
            'status',
            'rejected'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getStatusColorAttribute()
    {
        return match($this->status)
        {
            'pending' => 'yellow',

            'accepted' => 'green',

            'rejected' => 'red',

            default => 'gray'
        };
    }
}