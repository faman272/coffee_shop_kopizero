<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $guarded = ['id'];


    public function orders()
    {
        return $this->belongsTo(Order::class, 'no_order');
    }
    
    use HasFactory;
}
