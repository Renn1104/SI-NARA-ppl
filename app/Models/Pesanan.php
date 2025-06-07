<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'total_harga',
        'status',
        'ongkir', 


    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function detailPesanan()
    {
        return $this->hasMany(DetailPesanan::class, 'pesanan_id');
    }

}
