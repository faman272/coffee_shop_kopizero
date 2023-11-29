<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'menu_id';


    protected $fillable = [
        'no_order',
        'menu_id',
        'qty',
        'harga',
        'jenis_harga',
        'subtotal'
    ];

    public function menus()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
    public function orders()
    {
        return $this->belongsTo(Order::class, 'no_order');
    }
    use HasFactory;
}
