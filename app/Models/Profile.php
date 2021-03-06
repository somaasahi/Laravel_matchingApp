<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';

    protected $fillable = [
        'user_id',
        'age',
        'income',
        'introduce',
    ];

    public function toUser()
    {
        return $this->belongsTo('\App\Models\User', 'to_user_id', 'id');

    }

}
