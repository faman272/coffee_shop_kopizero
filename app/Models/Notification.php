<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'no_order',
        'message',
        'is_read',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'no_order', 'no_order');
    }

    use HasFactory;
}
