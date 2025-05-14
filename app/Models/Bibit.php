<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bibit extends Model
{
    use HasFactory;
        protected $fillable = [
        'judul_bibit',
        'deskripsi_bibit',
        'foto_bibit',
        'jumlah_bibit',
        'harga_bibit',
    ];
}
