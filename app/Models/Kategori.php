<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{

    protected $primaryKey = 'id_kategori';

    public function menu()
    {
        return $this->hasMany(Menu::class);
    }



    use HasFactory;
}
