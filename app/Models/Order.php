<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [

        'user_id',

        'translator_id',

        'service_id',

        'field',

        'title',

        'description',

        'source_language',

        'target_language',

        'journal_file',

        'translated_file',

        'price',

        'status'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    public function translator()
    {
        return $this->belongsTo(
            User::class,
            'translator_id'
        );
    }

    public function service()
    {
        return $this->belongsTo(
            Service::class,
            'service_id'
        );
    }
    public function review()
    {
        return $this->hasOne(
            Review::class
        );
    }
    public function requests()
    {
        return $this->hasMany(
            TranslatorRequest::class
        );
    }
}