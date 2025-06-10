<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KalenderEvent extends Model
{
    use HasFactory;

    protected $table = 'kalenderevents'; 
    public $timestamps = false;

    protected $fillable = [
        'judul_event',
        'deskripsi_event',
        'file_event',
        'tanggal_event',
        'waktu_event'
    ];
}
