<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konten extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_konten',
        'deskripsi_konten',
        'file_konten',
        'tanggal_unggah',
    ];
}

