<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokBarang extends Model
{
    public $timestamps = false;

    protected $table = 'stok_barang';

    protected $primaryKey = 'id_barang';

    protected $fillable = [
        'nama_barang',
        'type_barang',
        'volume',
        'satuan'
    ];

    use HasFactory;
}
