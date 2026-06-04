<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'translator_id',
        'rating',
        'comment'
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function translator()
    {
        return $this->belongsTo(User::class, 'translator_id');
    }
}
