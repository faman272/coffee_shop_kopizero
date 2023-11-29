<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'kategori_id',
        'H_Hot',
        'H_Ice',
        'gambar',
        'deskripsi'
    ];

    public function detail_orders()
    {
        return $this->hasMany(DetailOrder::class, 'menu_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    use HasFactory;
}
