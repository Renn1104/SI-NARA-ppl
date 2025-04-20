<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderEvent extends Model
{
    use HasFactory;

    protected $table = 'event'; // Sesuaikan dengan nama tabel di database kamu
    protected $primaryKey = 'id_event'; // Sesuaikan dengan primary key tabel
    public $timestamps = false; // Kalau tidak pakai created_at / updated_at

    protected $fillable = [
        'judul_event',
        'deskripsi_event',
        'file_event',
        'tanggal_event',
        'waktu_event'
    ];
}
