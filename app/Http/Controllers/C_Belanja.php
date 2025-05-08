<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class C_Belanja extends Controller
{
    public function index()
    {
        // Contoh data produk statis (nanti bisa diganti dari database)
        $produk = [
            [
                'nama' => 'Anggur hitam K189',
                'harga' => 80000,
                'harga_asli' => 120000,
                'diskon' => 25,
                'rating' => 4.8,
                'terjual' => 100,
                'gambar' => 'anggur-hitam.jpg',
            ],
            [
                'nama' => 'Anggur hijau K256',
                'harga' => 100000,
                'harga_asli' => 120000,
                'diskon' => 20,
                'rating' => 4.9,
                'terjual' => 300,
                'gambar' => 'anggur-hijau.jpg',
            ],
            [
                'nama' => 'Anggur pink K378',
                'harga' => 90000,
                'harga_asli' => 110000,
                'diskon' => 18,
                'rating' => 4.7,
                'terjual' => 150,
                'gambar' => 'anggur-pink.jpg',
            ],
            [
                'nama' => 'Anggur ungu K449',
                'harga' => 110000,
                'harga_asli' => 130000,
                'diskon' => 15,
                'rating' => 4.9,
                'terjual' => 258,
                'gambar' => 'anggur-ungu.jpg',
            ],
        ];

        return view('belanja', compact('produk'));

    }
}
