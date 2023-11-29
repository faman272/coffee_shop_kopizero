<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $primaryKey = 'no_order';

    protected $fillable = [
        'no_order',
        'user_id',
        'tgl_order',
        'nomor_meja',
        'status',
        'catatan',
        'metode_pembayaran_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function detail_orders()
    {
        return $this->hasMany(DetailOrder::class, 'no_order');
    }

    public function pembayarans()
    {
        return $this->hasOne(Pembayaran::class, 'no_order');
    }

    public function metode_pembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class);
    }

    public function notifications()
    {
        return $this->hasOne(Notification::class, 'no_order');
    }

    use HasFactory;
}
