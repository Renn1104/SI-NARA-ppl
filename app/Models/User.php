<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tambahan properti yang umum dipakai
    protected $fillable = [
        'username',
        'password',
        'namalengkap',
        'email',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
