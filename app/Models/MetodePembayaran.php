<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{

    protected $table = 'metode_pembayaran';

    protected $guarded = ['id'];
    public function orders()
    {
        return $this->hasOne(Order::class, 'metode_pembayaran_id');
    }

    use HasFactory;
}
