<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPesanan extends Model
{
    use HasFactory;
    protected $fillable = [
            'pesanan_id',
            'bibit_id',
            'jumlah',
            'harga_satuan',

    ];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }
    public function bibit()
    {
        return $this->belongsTo(Bibit::class, 'bibit_id');
    }
}
