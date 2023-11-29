<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $primaryKey = 'id_keranjang';

    protected $fillable = [
        'user_id',
        'menu_id',
        'qty',
        'jenis_harga',
        'harga',
        'subtotal',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id_menu');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    use HasFactory;
}
