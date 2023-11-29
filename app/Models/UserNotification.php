<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    protected $fillable = [
        'user_id',
        'no_order',
        'message',
    ];
     
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    use HasFactory;
}
